<?php

return [

    //Service credentials settings
    'wsdl' => env('PLACE_TO_PAY_WSDL', null),
    'identificator' => env('PLACE_TO_PAY_IDENTIFICATOR', null),
    'trankey' => env('PLACE_TO_PAY_TRANS_KEY',null),

    //Buyer data settings
    'buyer_document' => env('PLACE_TO_PAY_BUYER_DOCUMENT', 24414988),
    'buyer_document_type' => env('PLACE_TO_PAY_BUYER_DOCUMENT_TYPE', 'CC'),
    'buyer_first_name' => env('PLACE_TO_PAY_BUYER_FIRST_NAME', 'Metopay'),
    'buyer_last_name' => env('PLACE_TO_PAY_BUYER_LAST_NAME', ' IN.'),
    'buyer_email' => env('PLACE_TO_PAY_BUYER_EMAIL', 'metopay@gmail.com'),

    //Shopping data settings
    'shipping_document' => env('PLACE_TO_PAY_SHIPPING_DOCUMENT', 14414988),
    'shipping_document_type' => env('PLACE_TO_PAY_SHIPPING_DOCUMENT_TYPE', 'CC'),
    'shipping_first_name' => env('PLACE_TO_PAY_SHIPPING_FIRST_NAME', 'Metopay store'),
    'shipping_last_name' => env('PLACE_TO_PAY_SHIPPING_LAST_NAME', ' IN.'),
    'shipping_email_name' => env('PLACE_TO_PAY_SHIPPING_EMAIL', 'metopaystore@gmail.com')
];