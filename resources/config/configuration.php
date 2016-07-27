<?php

return [
    'mode' => [
        'required' => true,
        'type'     => 'anomaly.field_type.select',
        'config'   => [
            'default_value' => 'count',
            'options'       => [
                'count'    => 'anomaly.extension.top_products_widget::configuration.mode.option.count',
                'grossing' => 'anomaly.extension.top_products_widget::configuration.mode.option.grossing',
            ]
        ]
    ]
];
