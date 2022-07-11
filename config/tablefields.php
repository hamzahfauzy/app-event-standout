<?php

return [
    'tblname'    => [
        'field1','field2'
    ],
    'events' => [
        'name',
        'event_date' => [
            'label' => 'Event Date',
            'type'  => 'datetime-local'
        ]
    ],
    'stands' => [
        'name',
        'price' => [
            'label' => 'price',
            'type'  => 'number'
        ]
    ]
];