<?php

return [
    'merchant_id' => env('MIDTRANS_MERCHANT_ID', 'G679240815'),
    'client_key' => env('MIDTRANS_CLIENT_KEY', 'SB-Mid-client-QL9rbZhYGDW-BDNV'),
    'server_key' => env('MIDTRANS_SERVER_KEY', 'SB-Mid-server-KKyjnD3TtjMaK0Bm6LMWfZmf'),
    'is_production' => env('MIDTRANS_IS_PRODUCTION', false),
    'is_sanitized' => env('MIDTRANS_IS_SANITIZED', true),
    'is_3ds' => env('MIDTRANS_IS_3DS', true),
];
