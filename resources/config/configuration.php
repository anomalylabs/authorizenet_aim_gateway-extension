<?php

return [
    'test_mode'       => [
        'type'   => 'anomaly.field_type.boolean',
        'config' => [
            'default_value' => true,
            'on_text'       => 'TEST',
            'on_color'      => 'warning',
            'off_text'      => 'LIVE',
            'off_color'     => 'success'
        ]
    ],
    'api_login_id'    => [
        'required' => true,
        'type'     => 'anomaly.field_type.encrypted'
    ],
    'transaction_key' => [
        'required' => true,
        'type'     => 'anomaly.field_type.encrypted'
    ]
];
