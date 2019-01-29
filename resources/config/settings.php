<?php

return [
    'api_login_id'    => [
        'required' => true,
        'type'     => 'anomaly.field_type.encrypted',
    ],
    'transaction_key' => [
        'required' => true,
        'type'     => 'anomaly.field_type.encrypted',
    ],
];
