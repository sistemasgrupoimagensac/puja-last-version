<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SoapTestController extends Controller
{
    public function test()
    {
        try {
            $client = new \SoapClient(null, array(
                'location' => "http://www.webservicex.net/geoipservice.asmx",
                'uri'      => "http://www.webserviceX.NET/",
                'trace'    => 1,
                'exceptions' => 1
            ));
            return 'SoapClient is available and working. PASOOOOOOO';
        } catch (\Exception $e) {
            return 'Exception: ' . $e->getMessage();
        }
    }
}
