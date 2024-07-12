<?php

namespace App\Utils;

use Greenter\Model\Company\Address;
use Greenter\Model\Company\Company;
use Greenter\Model\DocumentInterface;
use Greenter\Model\Response\CdrResponse;
use Greenter\Report\HtmlReport;
use Greenter\Report\PdfReport;
use Greenter\See;
use Greenter\XMLSecLibs\Certificate\X509Certificate;
use Greenter\XMLSecLibs\Certificate\X509ContentType;
use Greenter\Ws\Services\SunatEndpoints;
use Illuminate\Support\Facades\Log;

class FactUtil
{
    private static $current;

    protected $datos_empresa;
    protected $datos_fact_elect;

    private function __construct()
    {
        $this->datos_empresa = \Session::get('datos_empresa');
        $this->datos_fact_elect = \Session::get('datos_fact_elect');
    }

    public static function getInstance()
    {
        if (!self::$current instanceof self) {
            self::$current = new self();
        }

        return self::$current;
    }

    /**
     * @param string $endpoint
     * @return See
     */
    public function getSee()
    { 
        $see = new See();
        $basePath = $this->datos_empresa->path;
        $path = public_path() . $basePath;
        $pathToPfx = escapeshellarg($path . $this->datos_fact_elect->certificate_name);
        $outputPem = escapeshellarg($path . 'default.pem');
        $password = escapeshellarg($this->datos_fact_elect->certificate_pass);
        $command = "openssl pkcs12 -in $pathToPfx -out $outputPem -nodes -passin pass:$password";

        exec($command . ' 2>&1', $output, $returnVar);

        if ($returnVar !== 0) {
            // Log detailed error
            Log::error("Command execution failed with return code $returnVar. Output: " . implode("\n", $output));
            throw new \Exception("Error executing command: " . implode("\n", $output));
        }
        

        // $see = new See();

        $basePath = $this->datos_empresa->path;
        $path = public_path() . $basePath;
        $certificate = file_get_contents($path . 'default.pem');
        
        if ($certificate === false) {
            throw new Exception('No se pudo cargar el certificado');
        }

        

        // Set the certificate in $see object
        $see->setCertificate($certificate);

        if($this->datos_empresa->status_electronic_billing == 0){
            $see->setService(SunatEndpoints::FE_BETA);
        }else {
            $see->setService(SunatEndpoints::FE_PRODUCCION);
        }

        $see->setClaveSOL($this->datos_fact_elect->ruc, $this->datos_fact_elect->sol_user, $this->datos_fact_elect->sol_password);

        return $see;
    }

    public function showResponse(DocumentInterface $document, CdrResponse $cdr)
    {
        $filename = $document->getName();
        
        require __DIR__.'/../views/response.php';
    }

    public function getErrorResponse(\Greenter\Model\Response\Error $error)
    {
        $result = array("status"=>"false","message"=> "Código de error:".$error->getCode()."-"."   Descripción de error: ".$error->getMessage());
        
        return $result;
    }

    public function writeXml(DocumentInterface $document, $xml)
    {
        $this->writeFile($document->getName().'.xml', $xml);
    }

    public function writeCdr(DocumentInterface $document, $zip)
    {
        $this->writeFile('R-'.$document->getName().'.zip', $zip);
    }

    public function writeFile($filename, $content)
    {
        if (getenv('GREENTER_NO_FILES')) {
            return;
        }
        $basePath = $this->datos_empresa->path.'pdf/';
        $path = public_path().$basePath;
        file_put_contents($path.$filename, $content);
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

    public function getPdfA4(DocumentInterface $document, $tipodocumento, $saleInvoice = null){
        $html = new HtmlReport(__DIR__.'/../templates', [
            'cache' => __DIR__ . '/../cache',
            'strict_variables' => true,
        ]);

        if($tipodocumento == '2' || $tipodocumento == '3') {
            $html->setTemplate('invoice.html.twig');
        }
        else {
            $html->setTemplate('invoiceNotaVenta.html.twig'); 
        }

        $render = new PdfReport($html);
        $render->setOptions( [
            'no-outline',
            'viewport-size' => '1280x1024',
            'page-width' => '21cm',
            'page-height' => '29.7cm',
            //'footer-html' => __DIR__.'/../resources/views/footer.html',
        ]);
        $binPath = self::getPathBin();
        if (file_exists($binPath)) {
            $render->setBinPath($binPath);
        }
        
        $hash = $tipodocumento =='1' ? null : $this->getHash($document);
        $params = self::getParametersPdf($tipodocumento);
        $params['system']['hash'] = $hash;
        
        $footer = $tipodocumento =='1' ? '' : '<div> <center><span>Verifica la validez de este documento en: <a href="https://ww1.sunat.gob.pe/ol-ti-itconsvalicpe/ConsValiCpe.htm" style="color: black; text-decoration:none;">https://ww1.sunat.gob.pe/ol-ti-itconsvalicpe/ConsValiCpe.htm</a></span></center></div>';
        $params['user']['footer'] = $footer;
        // telefono
        $params['user']['telefono'] = $this->datos_fact_elect->phone;
        $params['user']['mensajeImpresion'] = $this->datos_fact_elect->message_print;
        $params['sale'] = $saleInvoice;

        $pdf = $render->render($document, $params);

        if ($pdf === false) {
            $error = $render->getExporter()->getError();
            echo 'Error: '.$error;
            exit();
        }

        // Write html
        //$this->writeFile($document->getName().'.html', $render->getHtml());

        return $pdf;
    }

    public function generator($item, $count)
    {
        $items = [];

        for ($i = 0; $i < $count; $i++) {
            $items[] = $item;
        }

        return $items;
    }

    public function showPdf($content, $filename)
    {
        $this->writeFile($filename, $content);   
    }

    public function getPathBin()
    {
        $path = __DIR__.'/../vendor/bin/wkhtmltopdf';
        if (self::isWindows()) {
            $path .= '.exe';
        }
        if(PHP_OS == "Darwin") {
            $path .= '-osx';
        }

        return $path;
    }

    public function isWindows()
    {
        return strtoupper(substr(PHP_OS, 0, 3)) === 'WIN';
    }

    public function inPath($command) {
        $whereIsCommand = self::isWindows() ? 'where' : 'which';

        $process = proc_open(
            "$whereIsCommand $command",
            array(
                0 => array("pipe", "r"), //STDIN
                1 => array("pipe", "w"), //STDOUT
                2 => array("pipe", "w"), //STDERR
            ),
            $pipes
        );
        if ($process !== false) {
            $stdout = stream_get_contents($pipes[1]);
            stream_get_contents($pipes[2]);
            fclose($pipes[1]);
            fclose($pipes[2]);
            proc_close($process);

            return $stdout != '';
        }

        return false;
    }

    private function getHash(DocumentInterface $document)
    {
        $see = $this->getSee('');
        $xml = $see->getXmlSigned($document);

        $hash = (new \Greenter\Report\XmlUtils())->getHashSign($xml);

        return $hash;
    }

    private  function getParametersPdf($tipodocumento)
    {
        $basePath = $this->datos_empresa->path;
        $path = public_path() . $basePath;
        $logo = file_get_contents(public_path() . $this->datos_empresa->logo);

        return [
            'system' => [
                'logo' => $logo,
                'hash' => ''
            ],
            'user' => [
                'resolucion' => '155-2017',
                'header' => '<b>Telf:</b>'.$this->datos_fact_elect->phone
            ],
            'sale' => ''
        ];
    }
}