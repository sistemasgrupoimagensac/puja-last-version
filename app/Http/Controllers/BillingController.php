<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Middleware\SessionData;
use App\Mail\SubscriptionMail;
use Illuminate\Http\Request;
use App\Models\SaleModel;
use App\Models\DocumentType;
use App\Models\UserSubscription;
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

    public function sendMail($path)
    {
        
        try {
            
            $pdfPath = public_path('billing/pdf/20605395181-03-B001-82-a4.pdf');
            Log::info('Iniciando el envío de correo...');
            Mail::to('pierreherreraoropeza@gmail.com')->send(new SubscriptionMail($pdfPath));
            Log::info('Correo enviado.');

            return response()->json([
                'http_code' => 200,
                'message' => 'Correo enviado.',
                'param' => $path,
            ], 200);

        } catch (\Throwable $th) {
            Log::error('Error al enviar el correo: ' . $th->getMessage());

            return response()->json([
                'http_code' => 500,
                'message' => 'Error al generar la vista de planes',
                'error' => $th->getMessage()
            ], 500);
        }
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

            $data = UserSubscription::find($id);
        
            $data->state = 1;
            $data->document_type_id = $request->document_type_id;
            $data->save();

            $data->client;

            /* return response()->json([
                'http_code' => 200,
                'message' => 'Bien',
                'data' => $data,
            ]); */

            if($data->documentType->type_doc == '02') {
                $response = $this->generarFEBoleta($request, $data);
            }
            else if($data->documentType->type_doc == '03')  {
                $response = $this->generarFEFactura($request, $data);
            }
            else {
                $response = $this->generarNotaVenta($request, $data);
            }

            // Mail::to('pierreherreraoropeza@gmail.com')->send(new SubscriptionMail);substr($cadena, 1)

            // $pdfPath = public_path($response['data']['file_name']);
            $pdfPath_fix = public_path(substr($response['data']['file_name'].'-a4.pdf', 1));
            $email = $response['data']['client']['email'];
            Log::info('Iniciando el envío de correo...');
            Mail::to($email)
                ->cc(['sistemasgrupoimagensac@gmail.com', 'grupoimagen.908883889@gmail.com', 'oechegaray@360creative.pe'])
                ->bcc(['pierreherreraoropeza@gmail.com', 'oechegaray@bustamanteromero.com.pe', 'walfaro@360creative.pe'])
            ->send(new SubscriptionMail($pdfPath_fix));
            Log::info('Correo enviado.');

            return [
                "data" => $response,
                // 'data' => $response['data'],
                // 'serie' => $response['serie'],
                // 'message' => $response['message'],
            ];

        } catch (\Throwable $th) {
            return response()->json([
                'http_code' => 500,
                'message' => 'Error al generar la factura',
                'error' => $th->getMessage() // Mensaje de error detallado
            ], 500); // Código de estado HTTP 500 (Internal Server Error)
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

        $invoice->setObservacion($data->note);

        $datos_empresa = \Session::get('datos_empresa');
        $data->physical_proof_number = $correlative->correlative;
        $data->file_name = $datos_empresa->path.'pdf/'.$invoice->getName();
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

    public function generarFEBoleta($request, $data) {
        
        $correlative = $this->generateCorrelative($data->document_type_id);
        
        $util = FactUtil::getInstance();


        // Cliente
        $client = new Client();
        $client->setTipoDoc('1')
        ->setNumDoc($data->client->dni)
        ->setRznSocial($data->client->name .' '. $data->client->last_name)
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

        $invoice->setObservacion($data->note);

        // Envío a SUNAT
        $see = $util->getSee();
        
        $result = $see->send($invoice);
        $util->writeXml($invoice, $see->getFactory()->getLastXml());
        
        // Verificamos que la conexión con SUNAT fue exitosa.
        if (!$result->isSuccess()) {
            // Mostrar error al conectarse a SUNAT.
            return $this->successResponse([
                'result'=>'error',
                'message'=> $result->getError()->getMessage()]);
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
            $data->file_name = $datos_empresa->path.'pdf/'.$invoice->getName();
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
            $data->file_name = $datos_empresa->path.'pdf/'.$invoice->getName();
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
            $data->file_name = $datos_empresa->path.'pdf/'.$invoice->getName();
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
    
    public function generarFEFactura($request, $data) {
        $correlative = $this->generateCorrelative($data->document_type_id);
        
        $util = FactUtil::getInstance();

        // Cliente
        $client = new Client();
        $client->setTipoDoc('6')
        ->setNumDoc($data->client->dni)
        ->setRznSocial($data->client->business_name)
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

        $invoice->setObservacion($data->note);

        // Envío a SUNAT
        $see = $util->getSee();
        $result = $see->send($invoice);
        $util->writeXml($invoice, $see->getFactory()->getLastXml());

        // Verificamos que la conexión con SUNAT fue exitosa.
        if (!$result->isSuccess()) {
            // Mostrar error al conectarse a SUNAT.
            return $this->successResponse([
                'result'=>'error',
                'message'=> $result->getError()->getMessage()]);
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
            $data->file_name = $datos_empresa->path.'pdf/'.$invoice->getName();
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
            $data->file_name = $datos_empresa->path.'pdf/'.$invoice->getName();
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
            $data->file_name = $datos_empresa->path.'pdf/'.$invoice->getName();
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
}