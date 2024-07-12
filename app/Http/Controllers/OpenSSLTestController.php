<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class OpenSSLTestController extends Controller
{
    public function test()
    {
        // Verificar si la extensión openssl está cargada
        if (extension_loaded('openssl')) {
            return 'OpenSSL version: ' . OPENSSL_VERSION_TEXT;
        } else {
            return 'OpenSSL extension is not loaded.';
        }
    }

    public function generateRsaKey()
{
    $res = openssl_pkey_new(array(
        "private_key_bits" => 2048,
        "private_key_type" => OPENSSL_KEYTYPE_RSA,
    ));

    openssl_pkey_export($res, $privateKey);
    $publicKey = openssl_pkey_get_details($res)['key'];

    return response()->json([
        'private_key' => $privateKey,
        'public_key' => $publicKey,
    ]);
}
}
