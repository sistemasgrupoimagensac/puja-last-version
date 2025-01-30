<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Middleware\SessionData;
use App\Mail\SubscriptionMail;
use Illuminate\Http\Request;
use App\Models\SaleModel;
use App\Models\DocumentType;
use App\Models\PlanUser;
use App\Models\User;
use App\Utils\FactUtil;
use Greenter\Model\Client\Client;
use Greenter\Model\Company\Address;
use Greenter\Model\Sale\FormaPagos\FormaPagoContado;
use Greenter\Model\Sale\Invoice;
use Greenter\Model\Sale\SaleDetail;
use Greenter\Model\Sale\Legend;
use Luecano\NumeroALetras\NumeroALetras;
use DateTime;
use Carbon\Carbon;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;

class BillingController extends Controller
{
    public function __construct()
    {
        // $this->middleware('sessiondata');
        // $this->middleware(SessionData::class);
    }
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    public function generarFactura(Request $request, $id)
    {
        try {

            $data = PlanUser::find($id);
            $tipo_doc_electronico = $request->document_type_id;

            if ( $request->num_doc == null ) {
                $user_id = $data->user_id;
                $user = User::findOrFail($user_id);
                if ( $user->tipo_documento_id == 1 ) { // 1 = DNI, 2 = RUC
                    $tipo_doc_electronico = 2;
                } else if ( $user->tipo_documento_id == 2 ) {
                    $tipo_doc_electronico = 3;
                }
            }

            $data->num_receipt_owner = $request->num_doc;
            $data->name_receipt_owner = $request->receipt_name;
            $data->document_type_id = $tipo_doc_electronico;
            $data->save();

            $data->client;

            if ( $data->documentType->type_doc == '02' ) {
                $response = $this->generarFEBoleta($request, $data, $request->num_doc, $request->receipt_name);
            } else if ( $data->documentType->type_doc == '03' ) {
                $response = $this->generarFEFactura($request, $data, $request->num_doc, $request->receipt_name);
            } else {
                $response = $this->generarNotaVenta($request, $data);
            }
            
            $pdfPath_fix = url($response['data']['file_name'].'-a4.pdf');
            $email = $response['data']['client']['email'];

            Mail::to($email)
                ->cc(['soporte@pujainmobiliaria.com.pe'])
                ->bcc(['grupoimagen.908883889@gmail.com'])
            ->send(new SubscriptionMail($pdfPath_fix, $request->plan_name));
            
            return [
                'data' => $response['data'],
                'serie' => $response['serie'],
                'message' => $response['message'],
            ];

        } catch (\Throwable $th) {

            return response()->json([
                'http_code' => 500,
                'message' => 'Error al generar la factura',
                'error' => $th->getMessage(),
            ], 500);

        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    //Documentos
    public function generarNotaVenta($request, $data) {
        $correlative = $this->generateCorrelative($data->document_type_id);

        $util = FactUtil::getInstance();

        // Cliente
        $client = new Client();
        $client->setTipoDoc('1')
        ->setNumDoc($data->client->dni)
        ->setRznSocial($data->client->name .' '. $data->client->last_name)
        ->setEmail($data->client->email)
        ->setTelephone($data->client->phone)
        ->setAddress((new Address())
            ->setDireccion($data->client->address));

        $calculoImpuesto = $this->calcularImpuestos($request);
        $calculoExoneracion = $this->calcularExoneracion($request);

        // Venta
        $invoice = (new Invoice())
        ->setUblVersion('2.1')
        ->setTipoOperacion('0101') // Venta - Catalog. 51
        ->setTipoDoc('03') // Boleta - Catalog. 01
        ->setSerie($correlative->series)
        ->setCorrelativo($correlative->correlative)
        ->setFechaEmision(new \DateTime())
        ->setTipoMoneda('PEN') // Sol - Catalog. 02
        ->setClient($client)
        ->setCompany($util->getCompany());

        $invoice->setMtoOperExoneradas($calculoExoneracion['subTotal'])
        ->setMtoIGV(0)
        ->setTotalImpuestos(0)
        ->setValorVenta($calculoExoneracion['subTotal'])
        ->setSubTotal($calculoExoneracion['Total'])
        ->setMtoImpVenta($calculoExoneracion['Total']);

        $items = [];
        foreach ($request->details as $item){
            $detail = (new SaleDetail())
            ->setCodProducto($item['product']['id'])
            ->setUnidad($item['product']['type'] == 1 ? 'NIU' : 'ZZ') // Unidad - Catalog. 03
            ->setCantidad($item['quantity'])
            ->setDescripcion($item['product']['name']);

            $subtotal = (float)($item['price'] * $item['quantity']);
            $igv = 0;
            $importe = (float)($item['price'] * $item['quantity']);

            $detail->setMtoBaseIgv($subtotal)
            ->setPorcentajeIgv(18) // 18%
            ->setIgv($igv)
            ->setTipAfeIgv('20')
            ->setTotalImpuestos($igv)
            ->setMtoValorVenta($subtotal)
            ->setMtoValorUnitario((float)$item['price'])
            ->setMtoPrecioUnitario($item['price']);

            $items[] = $detail;
        }

        $formatter = new NumeroALetras();
        $Total = $formatter->toInvoice($calculoImpuesto['Total'], 2, '');

        $invoice->setDetails($items)
        ->setLegends([
            (new Legend())
            ->setCode('1000')
            ->setValue($Total
            )
        ]);

        $invoice->setObservacion($request->note);

        $datos_empresa = \Session::get('datos_empresa');
        $data->physical_proof_number = $correlative->correlative;
        // $data->file_name = $datos_empresa->path.'pdf/'.$invoice->getName(); // USANDO ALMACENAMIENTO LOCAL
        $data->file_name = 'pdf/'.$invoice->getName(); // USANDO ALMACENAMIENTO EXTERNO
        $data->state_et = 'PROCESADO';
        $data->state_billed = 1;
        $data->save();

        // Generar formato A4
        $pdfA4 = $util->getPdfA4($invoice, '1', $data);

        // Guardar el formato PDF tipo Ticket
        $util->showPdf($pdfA4, $invoice->getName().'-a4.pdf');

        return [
            'data' => $data,
            'serie' => $correlative->series.'-'.$correlative->correlative,
            'message' => 'Recepción finalizada correctamente.'
        ];
    }

    public function generarFEBoleta($request, $data, $num_doc, $receipt_name) {

        $correlative = $this->generateCorrelative($data->document_type_id);
        
        $util = FactUtil::getInstance();

        // Cliente
        $client = new Client();
        if ( $num_doc != "" ) {
            $num_receipt_owner = $num_doc;
            $name_receipt_owner = $receipt_name;
        } else {
            $num_receipt_owner = $data->client->dni;
            $name_receipt_owner = $data->client->name .' '. $data->client->last_name;
        }

        $client->setTipoDoc('1')
        ->setNumDoc($num_receipt_owner)
        ->setRznSocial($name_receipt_owner)
        ->setAddress((new Address())
            ->setDireccion($data->client->address));

        // Validar si esta venta se exonera
        $valueExonerated = 0;
        $isExonerated = $valueExonerated == 0 ? false : true;

        $calculoImpuesto = $this->calcularImpuestos($request);
        $calculoExoneracion = $this->calcularExoneracion($request);

        // Venta
        $invoice = (new Invoice())
        ->setUblVersion('2.1')
        ->setTipoOperacion('0101') // Venta - Catalog. 51
        ->setTipoDoc('03') // Boleta - Catalog. 01
        ->setSerie($correlative->series)
        ->setCorrelativo($correlative->correlative)
        ->setFechaEmision(new \DateTime())
        ->setTipoMoneda('PEN') // Sol - Catalog. 02
        ->setClient($client)
        ->setCompany($util->getCompany());

        if($isExonerated) {
            $invoice->setMtoOperExoneradas($calculoExoneracion['subTotal'])
            ->setMtoIGV(0)
            ->setTotalImpuestos(0)
            ->setValorVenta($calculoExoneracion['subTotal'])
            ->setSubTotal($calculoExoneracion['Total'])
            ->setMtoImpVenta($calculoExoneracion['Total']);
        } 
        else {
            $invoice->setMtoOperGravadas($calculoImpuesto['subTotal'])
            ->setMtoIGV($calculoImpuesto['Igv'])
            ->setTotalImpuestos($calculoImpuesto['Igv'])
            ->setValorVenta($calculoImpuesto['subTotal'])
            ->setSubTotal($calculoImpuesto['Total'])
            ->setMtoImpVenta($calculoImpuesto['Total']);
        }

        $items = [];
        foreach ($request->details as $item){
            $detail = (new SaleDetail())
            ->setCodProducto($item['product']['id'])
            ->setUnidad($item['product']['type'] == 1 ? 'NIU' : 'ZZ') // Unidad - Catalog. 03
            ->setCantidad($item['quantity'])
            ->setDescripcion($item['product']['name']);
            
            if($isExonerated){
                $subtotal = (float)($item['price'] * $item['quantity']);
                $igv = 0;
                $importe = (float)($item['price'] * $item['quantity']);

                $detail->setMtoBaseIgv($subtotal)
                ->setPorcentajeIgv(18) // 18%
                ->setIgv($igv)
                ->setTipAfeIgv('20')
                ->setTotalImpuestos($igv)
                ->setMtoValorVenta($subtotal)
                ->setMtoValorUnitario((float)$item['price'])
                ->setMtoPrecioUnitario($item['price']);
            }
            else {
                $subtotal = (float)($item['price'] * $item['quantity'])/1.18;
                $igv = (float)(($item['price'] * $item['quantity']) - $subtotal);
                $importe = (float)($item['price'] * $item['quantity']);

                $detail->setMtoBaseIgv($subtotal)
                ->setPorcentajeIgv(18) // 18%
                ->setIgv($igv)
                ->setTipAfeIgv('10') // Gravado Op. Onerosa - Catalog. 07
                ->setTotalImpuestos($igv)
                ->setMtoValorVenta($subtotal)
                ->setMtoValorUnitario((float)$item['price']/1.18)
                ->setMtoPrecioUnitario($item['price']);
            }

            $items[] = $detail;
        }

        $formatter = new NumeroALetras();
        $Total = $formatter->toInvoice($calculoImpuesto['Total'], 2, '');

        $invoice->setDetails($items)
        ->setLegends([
            (new Legend())
            ->setCode('1000')
            ->setValue($Total
            )
        ]);

        $invoice->setObservacion($request->note);

        // Envío a SUNAT
        $see = $util->getSee();

        $result = $see->send($invoice);
        $util->writeXml($invoice, $see->getFactory()->getLastXml());
        
        // Verificamos que la conexión con SUNAT fue exitosa.
        if (!$result->isSuccess()) {
            
            return [
                'status'=> "message",
                'message'=> $result->getError()->getMessage(),
            ];
            exit();

        }

        // Generar formato A4
        $pdfA4 = $util->getPdfA4($invoice,'2', $data);

        $cdr = $result->getCdrResponse();

        $util->writeCdr($invoice, $result->getCdrZip());
        $codigocdr = $cdr->getCode();

        // Guardar el formato PDF tipo Ticket
        $util->showPdf($pdfA4, $invoice->getName().'-a4.pdf');

        // CDR Resultado
        $cdr = $result->getCdrResponse();

        $code = (int)$cdr->getCode();

        if ($code === 0) {
            $datos_empresa = \Session::get('datos_empresa');
            $data->physical_proof_number = $correlative->correlative;
            // $data->file_name = $datos_empresa->path.'pdf/'.$invoice->getName(); // USANDO ALMACENAMIENTO LOCAL
            $data->file_name = 'pdf/'.$invoice->getName(); // USANDO ALMACENAMIENTO EXTERNO
            $data->state_et = 'PROCESADO';
            $data->state_billed = 1;
            $data->save();

            return [
                'data' => $data,
                'serie' => $correlative->series.'-'.$correlative->correlative,
                'message' => $cdr->getDescription().PHP_EOL,
            ];
        } 
        else if ($code >= 4000) {
            //echo 'ESTADO: ACEPTADA CON OBSERVACIONES:'.PHP_EOL;
            $datos_empresa = \Session::get('datos_empresa');
            $data->physical_proof_number = $correlative->correlative;
            // $data->file_name = $datos_empresa->path.'pdf/'.$invoice->getName(); // USANDO ALMACENAMIENTO LOCAL
            $data->file_name = 'pdf/'.$invoice->getName(); // USANDO ALMACENAMIENTO EXTERNO
            $data->state_et = 'PROCESADO CON OBSERVACIONES';
            $data->state_billed = 1;
            $data->save();

            return [
                'data' => $data,
                'serie' => $correlative->series.'-'.$correlative->correlative,
                'message' => $cdr->getDescription().PHP_EOL,
            ];
        } 
        else if ($code >= 2000 && $code <= 3999) {
            $datos_empresa = \Session::get('datos_empresa');
            $data->physical_proof_number = $correlative->correlative;
            // $data->file_name = $datos_empresa->path.'pdf/'.$invoice->getName(); // USANDO ALMACENAMIENTO LOCAL
            $data->file_name = 'pdf/'.$invoice->getName(); // USANDO ALMACENAMIENTO EXTERNO
            $data->state_et = 'RECHAZADO';
            $data->state_billed = 1;
            $data->save();

            return [
                'data' => 'error',
                'serie' => null,
                'message' => 'Código de error: '.$code."-"." "."Descripción de error: ".$cdr->getDescription()
            ];
        } else {
            echo 'Excepción';
        }

    }
    
    public function generarFEFactura($request, $data, $num_doc, $receipt_name) {
        $correlative = $this->generateCorrelative($data->document_type_id);
        
        $util = FactUtil::getInstance();

        // Cliente
        $client = new Client();
        if ( $num_doc != "" ) {
            $num_receipt_owner = $num_doc;
            $name_receipt_owner = $receipt_name;
        } else {
            $num_receipt_owner = $data->client->dni;
            $name_receipt_owner = $data->client->name;
        }

        $client->setTipoDoc('6')
        // ->setNumDoc($data->client->dni)
        // ->setRznSocial($data->client->business_name)
        ->setNumDoc($num_receipt_owner)
        ->setRznSocial($name_receipt_owner)
        ->setAddress((new Address())
            ->setDireccion($data->client->address));

        // Validar si esta venta se exonera
        $valueExonerated = 0;
        $isExonerated = $valueExonerated == 0 ? false : true;

        $calculoImpuesto = $this->calcularImpuestos($request);
        $calculoExoneracion = $this->calcularExoneracion($request);

        // Venta
        $invoice = (new Invoice())
        ->setUblVersion('2.1')
        ->setTipoOperacion('0101') // Venta - Catalog. 51
        ->setTipoDoc('01') // Factura - Catalog. 01
        ->setSerie($correlative->series)
        ->setCorrelativo($correlative->correlative)
        ->setFechaEmision(new \DateTime())
        ->setFormaPago(new FormaPagoContado())
        ->setTipoMoneda('PEN') // Sol - Catalog. 02
        ->setClient($client)
        ->setCompany($util->getCompany());

        if($isExonerated) {
            $invoice->setMtoOperExoneradas($calculoExoneracion['subTotal'])
            ->setMtoIGV(0)
            ->setTotalImpuestos(0)
            ->setValorVenta($calculoExoneracion['subTotal'])
            ->setSubTotal($calculoExoneracion['Total'])
            ->setMtoImpVenta($calculoExoneracion['Total']);
        } 
        else {
            $invoice->setMtoOperGravadas($calculoImpuesto['subTotal'])
            ->setMtoIGV($calculoImpuesto['Igv'])
            ->setTotalImpuestos($calculoImpuesto['Igv'])
            ->setValorVenta($calculoImpuesto['subTotal'])
            ->setSubTotal($calculoImpuesto['Total'])
            ->setMtoImpVenta($calculoImpuesto['Total']);
        }

        $items = [];
        foreach ($request->details as $item){
            $detail = (new saleDetail())
            ->setCodProducto($item['product']['id'])
            ->setUnidad($item['product']['type'] == 1 ? 'NIU' : 'ZZ') // Unidad - Catalog. 03
            ->setCantidad($item['quantity'])
            ->setDescripcion($item['product']['name']);

            if($isExonerated){
                $subtotal = (float)($item['price'] * $item['quantity']);
                $igv = 0;
                $importe = (float)($item['price'] * $item['quantity']);

                $detail->setMtoBaseIgv($subtotal)
                ->setPorcentajeIgv(18) // 18%
                ->setIgv($igv)
                ->setTipAfeIgv('20')
                ->setTotalImpuestos($igv)
                ->setMtoValorVenta($subtotal)
                ->setMtoValorUnitario((float)$item['price'])
                ->setMtoPrecioUnitario($item['price']);
            }
            else {
                $subtotal = (float)($item['price'] * $item['quantity'])/1.18;
                $igv = (float)(($item['price'] * $item['quantity']) - $subtotal);
                $importe = (float)($item['price'] * $item['quantity']);

                $detail->setMtoBaseIgv($subtotal)
                ->setPorcentajeIgv(18) // 18%
                ->setIgv($igv)
                ->setTipAfeIgv('10') // Gravado Op. Onerosa - Catalog. 07
                ->setTotalImpuestos($igv)
                ->setMtoValorVenta($subtotal)
                ->setMtoValorUnitario((float)$item['price']/1.18)
                ->setMtoPrecioUnitario($item['price']);
            }

            $items[]=$detail;
        }

        $formatter = new NumeroALetras();
        $Total = $formatter->toInvoice($calculoImpuesto['Total'], 2, '');

        $invoice->setDetails($items)
        ->setLegends([
            (new Legend())
            ->setCode('1000')
            ->setValue($Total
            )
        ]);

        $invoice->setObservacion($request->note);

        // Envío a SUNAT
        $see = $util->getSee();
        $result = $see->send($invoice);
        $util->writeXml($invoice, $see->getFactory()->getLastXml());

        // Verificamos que la conexión con SUNAT fue exitosa.
        if (!$result->isSuccess()) {
            // Mostrar error al conectarse a SUNAT.
            return [
                'status'=> "message",
                'message'=> $result->getError()->getMessage(),
            ];
            exit();
        }

        // Generar formato A4
        $pdfA4 = $util->getPdfA4($invoice,'3');

        $cdr = $result->getCdrResponse();

        $util->writeCdr($invoice, $result->getCdrZip());
        $codigocdr= $cdr->getCode();

        $filename = $invoice->getName();

        // Guardar el formato PDF tipo Ticket
        $util->showPdf($pdfA4, $invoice->getName().'-a4.pdf');

        // CDR Resultado
        $cdr = $result->getCdrResponse();

        $code = (int)$cdr->getCode();

        if ($code === 0) {
            $datos_empresa = \Session::get('datos_empresa');
            $data->physical_proof_number = $correlative->correlative;
            // $data->file_name = $datos_empresa->path.'pdf/'.$invoice->getName(); // USANDO ALMACENAMIENTO LOCAL
            $data->file_name = 'pdf/'.$invoice->getName(); // USANDO ALMACENAMIENTO EXTERNO
            $data->state_et = 'PROCESADO';
            $data->state_billed = 1;
            $data->save();

            return [
                'data' => $data,
                'serie' => $correlative->series.'-'.$correlative->correlative,
                'message' => $cdr->getDescription().PHP_EOL,
            ];
        } 
        else if ($code >= 4000) {
            //echo 'ESTADO: ACEPTADA CON OBSERVACIONES:'.PHP_EOL;
            $datos_empresa = \Session::get('datos_empresa');
            $data->physical_proof_number = $correlative->correlative;
            // $data->file_name = $datos_empresa->path.'pdf/'.$invoice->getName(); // USANDO ALMACENAMIENTO LOCAL
            $data->file_name = 'pdf/'.$invoice->getName(); // USANDO ALMACENAMIENTO EXTERNO
            $data->state_et = 'PROCESADO CON OBSERVACIONES';
            $data->state_billed = 1;
            $data->save();

            return [
                'data' => $data,
                'serie' => $correlative->series.'-'.$correlative->correlative,
                'message' => $cdr->getDescription().PHP_EOL,
            ];
        } 
        else if ($code >= 2000 && $code <= 3999) {
            $datos_empresa = \Session::get('datos_empresa');
            $data->physical_proof_number = $correlative->correlative;
            // $data->file_name = $datos_empresa->path.'pdf/'.$invoice->getName(); // USANDO ALMACENAMIENTO LOCAL
            $data->file_name = 'pdf/'.$invoice->getName(); // USANDO ALMACENAMIENTO EXTERNO
            $data->state_et = 'RECHAZADO';
            $data->state_billed = 1;
            $data->save();

            return [
                'data' => 'error',
                'serie' => null,
                'message' => 'Código de error: '.$code."-"." "."Descripción de error: ".$cdr->getDescription()
            ];
        } else {
            echo 'Excepción';
        }
    }


    private function generateCorrelative($id) {
        $data = DocumentType::find($id);
        $data->correlative = $data->correlative + 1;
        $data->save();

        return $data;
    }

    private function calcularImpuestos($request) {
        $cartSubtotal = 0;
        $cartIgv = 0;
        $cartTotal = 0;

        foreach ($request->details as $item) {
            $subtotal = (float)($item['price'] * $item['quantity'])/1.18;
            $igv = (float)(($item['price'] * $item['quantity']) - $subtotal);
            $importe = (float)($item['price'] * $item['quantity']);

            $cartSubtotal = $cartSubtotal + $subtotal;
            $cartIgv = $cartIgv + $igv;
            $cartTotal = $cartTotal + $importe;
        }

        $data = [
            'subTotal' => $cartSubtotal,
            'Igv' => $cartIgv,
            'Total' => $cartTotal
        ];

        return $data;
    }

    private function calcularExoneracion($request) {
        $cartSubtotal = 0;
        $cartIgv = 0;
        $cartTotal = 0;

        foreach ($request->details as $item) {
            $subtotal = (float)($item['price'] * $item['quantity']);
            $igv = 0;
            $importe = (float)($item['price'] * $item['quantity']);

            $cartSubtotal = $cartSubtotal +  $subtotal;
            $cartIgv = $cartIgv + $igv;
            $cartTotal = $cartTotal + $importe;
        }

        $data = [
            'subTotal' => $cartSubtotal,
            'Igv' => $cartIgv,
            'Total' => $cartTotal
        ];

        return $data;
    }


    // RECIBE DATOS DE TIPO DE DOCUMENTO Y NUMERO DE DOCUMENTO (DNI 0 RUC)
    public function recibirDatos(Request $request)
    {
        $documento = $request->input('documento');
        $tipo = $request->input('tipo');

        // Procesa los datos como necesites, por ejemplo, para generar la boleta o factura

        return response()->json(['success' => true, 'message' => $documento . $tipo]);
    }

}