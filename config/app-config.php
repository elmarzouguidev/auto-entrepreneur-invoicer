<?php

return [

    'cache' => [

        'use-cache' => false,

        'cache-live-time' => 30,

        'clients_cache' => false,
    ],

    'api-cache' => [
        'use-cache' => false,

        'cache-live-time' => 30,
    ],
    
    'clients' => [

        'prefix' => 'CLT',
    ],

    'invoices' => [
        'prefix' => 'FACTURE-',
        'start_from' => 800,
        'due_date_after' => 60,
    ],

    'estimates' => [
        'prefix' => 'DEVIS-',
        'start_from' => 1501,
        'due_date_after' => 15,
        'default_condition' => 'Délai 2 semaines après la réception de bon de commande',
    ],
];
