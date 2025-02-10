<?php

namespace App\Http\Controllers;

use App\Models\Transaccion;
use Illuminate\Http\Request;

class TransactionsController extends Controller
{
    public function store(Request $request)
    {
        $data = $request->all();

        Transaccion::create([
            'amount'                => $data['amount'] ?? null,
            'plan_id'               => $data['plan_id'] ?? null,
            'currency'              => $data['currency'] ?? null,
            'customer_name'         => $data['customer_name'] ?? null,
            'customer_email'        => $data['customer_email'] ?? null,
            'customer_phone_number' => $data['customer_phone_number'] ?? null,
            'description'           => $data['description'] ?? null,
            'tipo_usuario_id'       => $data['tipo_usuario_id'] ?? null,
            'status'                => $data['status'] ?? null,

            'card_bank_code'   => $data['card_bank_code'] ?? null,
            'card_bank_name'   => $data['card_bank_name'] ?? null,
            'card_holder_name' => $data['card_holder_name'] ?? null,
            'card_type'        => $data['card_type'] ?? null,

            'creation_date' => now(),

            'error_description' => $data['error_description'] ?? null,
            'error_code'        => $data['error_code'] ?? null,
            'request_id'        => $data['request_id'] ?? null,
        ]);

        return response()->json([
            'status' => 'success',
            'message' => 'Transacción procesada',
        ]);
    }
}
