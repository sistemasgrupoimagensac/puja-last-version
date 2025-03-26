<?php
namespace App\Services\Sunat;

use Greenter\Model\Client\Client;
use Greenter\Model\Company\Address;
use Greenter\Model\Company\Company;
use Greenter\Model\Sale\Legend;
use Greenter\Model\Sale\Note;
use Greenter\Model\Sale\SaleDetail;
use Greenter\Model\Summary\Summary;
use Greenter\Model\Summary\SummaryDetail;
use Greenter\Model\Voided\Voided;
use Greenter\Model\Voided\VoidedDetail;
use Greenter\Report\XmlUtils;
use Greenter\See;
use Greenter\Ws\Services\SunatEndpoints;
use Luecano\NumeroALetras\NumeroALetras;

class SunatService
{
    private static $current;

    protected $datos_empresa;
    protected $datos_fact_elect;

    public function getSee()
    {
        $this->datos_empresa    = \Session::get('datos_empresa');
        $this->datos_fact_elect = \Session::get('datos_fact_elect');

        $basePath = $this->datos_empresa->path;
        $path     = public_path() . $basePath;
        $pemPath  = $path . 'default.pem';

        $see = new See();
        $see->setCertificate(file_get_contents($pemPath));
        $see->setService($this->datos_empresa->status_electronic_billing ? SunatEndpoints::FE_PRODUCCION : SunatEndpoints::FE_BETA);
        $see->setClaveSOL($this->datos_fact_elect->ruc, $this->datos_fact_elect->sol_user, $this->datos_fact_elect->sol_password);

        return $see;
    }

    public function sunatResponse($result, $see)
    {
        $response['success'] = $result->isSuccess();

        if (! $response['success']) {
            $response['error'] = [
                'code'    => $result->getError()->getCode(),
                'message' => $result->getError()->getMessage(),
            ];

            return $response;
        }

        // Obtener XML y hash
        $response['xml']  = $see->getFactory()->getLastXml();
        $response['hash'] = (new XmlUtils())->getHashSign($response['xml']);

        if ($result instanceof \Greenter\Model\Response\SummaryResult) {
            // En caso de SummaryResult, retornar solo el ticket
            $response['ticket'] = $result->getTicket();
        } else {
            // En otros casos, procesar como documento estándar
            $response['cdrZip'] = base64_encode($result->getCdrZip());

            $cdr = $result->getCdrResponse();

            $response['cdrResponse'] = [
                'code'        => (int) $cdr->getCode(),
                'description' => $cdr->getDescription(),
                'notes'       => $cdr->getNotes(),
            ];
        }

        return $response;
    }

    public function getLegends($total)
    {
        $formatter = new NumeroALetras();
        $Total     = $formatter->toInvoice($total, 2, '');

        $legend = (new Legend())
            ->setCode('1000')
            ->setValue($Total);
        return [$legend];
    }

    public function getCompany()
    {
        return (new Company())
            ->setRuc($this->datos_fact_elect->ruc)
            ->setRazonSocial($this->datos_fact_elect->business_name)
            ->setNombreComercial($this->datos_fact_elect->tradename)
            ->setAddress((new Address())
                    ->setUbigueo($this->datos_fact_elect->ubigeo)
                    ->setDepartamento($this->datos_fact_elect->department)
                    ->setProvincia($this->datos_fact_elect->province)
                    ->setDistrito($this->datos_fact_elect->district)
                    ->setUrbanizacion('-')
                    ->setCodLocal('0000')
                    ->setDireccion($this->datos_fact_elect->address));
    }

    public function getSummary(array $data, $company, $client)
    {
        return (new Summary())
            ->setFecGeneracion(new \DateTime('-3days'))
            ->setFecResumen(new \DateTime('-1days'))
            ->setCorrelativo($data['CorrelativoSummary'])
            ->setCompany($this->getCompany($company))
            ->setDetails([$this->getSummaryDetail($data, $client)]);
    }

    public function getSummaryDetail(array $data, $client)
    {
        return (new SummaryDetail())
            ->setTipoDoc($data['tipo_documento'])
            ->setSerieNro($data['serie'] . '-' . $data['correlativo'])
            ->setEstado($data['condicion'])
            ->setClienteTipo($client->IdTipoDocumento ?? 1)
            ->setClienteNro($client->NroDocumento ?? '00000000')
            ->setTotal($data['importe_total'])
            ->setMtoOperGravadas($data['op_gravadas'])
            ->setMtoOperInafectas($data['op_inafectas'])
            ->setMtoOperExoneradas($data['op_exoneradas'])
            ->setMtoOperExportacion(0)
            ->setMtoOtrosCargos(0)
            ->setMtoIGV($data['igv_total']);
    }

    public function getVoided(array $data, $company)
    {
        return (new Voided())
            ->setCorrelativo($data['CorrelativoVoided'])
            // Fecha Generacion menor que Fecha comunicacion
            ->setFecGeneracion(new \DateTime('-3days'))
            ->setFecComunicacion(new \DateTime('-1days'))
            ->setCompany($this->getCompany($company))
            ->setDetails([$this->getVoidedDetail($data)]);
    }

    public function getVoidedDetail(array $data)
    {
        return (new VoidedDetail())
            ->setTipoDoc($data['tipo_documento'])
            ->setSerie($data['serie'])
            ->setCorrelativo($data['correlativo'])
            ->setDesMotivoBaja('ERROR EN CÁLCULOS');
    }

    public function getClient(array $data)
    {

        $tipoDoc   = $data['Cliente']['IdTipoDocumento'];
        $numDoc    = $data['Cliente']['NroDocumento'];
        $rznSocial = $data['Cliente']['RazonSocial'];

        return (new Client())
            ->setTipoDoc($tipoDoc ?? '1')
            ->setNumDoc($numDoc ?? '00000000')
            ->setRznSocial($rznSocial ?? 'Cliente Genérico');
    }

    public function getDetails(array $details)
    {
        return array_map(function ($detail) {
            return (new SaleDetail())
                ->setCodProducto($detail['IdProducto'] ?? null)
                ->setUnidad($detail['UndSunat'] ?? 'NIU') // 'NIU' como valor por defecto
                ->setCantidad($detail['Cantidad'])
                ->setMtoValorUnitario($detail['ValorUnitario'])
                ->setDescripcion($detail['Producto'] ?? 'Descripción no disponible')
                ->setMtoBaseIgv($detail['Cantidad'] * $detail['ValorUnitario']) // Base IGV
                ->setPorcentajeIgv(18.00)
                ->setIgv($detail['Igv'] ?? 0)                    // IGV
                ->setTipAfeIgv($detail['IdTipoAfectacion'] ?? 0) // Gravado
                ->setTotalImpuestos($detail['Impuesto'] ?? 0)
                ->setMtoValorVenta($detail['Cantidad'] * $detail['ValorUnitario'])
                ->setMtoPrecioUnitario($detail['PrecioUnitario']);
        }, $details);
    }

    public function getNote(array $data, $company)
    {
        return (new Note())
            ->setUblVersion('2.1')
            ->setTipoDoc($data['IdTipoComprobante']) // Tipo de comprobante
            ->setSerie($data['Serie'])
            ->setCorrelativo($data['Correlativo'])
            ->setFechaEmision(new \DateTime($data['FechaEmision']))
            ->setTipDocAfectado($data['tipDocAfectado'] ?? null)
            ->setNumDocfectado($data['numDocAfectado'] ?? null)
            ->setCodMotivo($data['codMotivo'] ?? null)
            ->setDesMotivo($data['desMotivo'] ?? null)
            ->setTipoMoneda($data['IdMoneda'])
            ->setCompany($this->getCompany($company))
            ->setClient($this->getClient($data))
            ->setMtoOperGravadas($data['OpGravadas'])
            ->setMtoIGV($data['Igv'])
            ->setTotalImpuestos($data['Impuestos'])
            ->setValorVenta($data['OpGravadas'])
            ->setSubTotal($data['Total'])
            ->setMtoImpVenta($data['Total'])
            ->setDetails($this->getDetails($data['ComprobanteDetalle']))
            ->setLegends($this->getLegends($data['Total']));
    }

}
