<?php

return [
    // метод формы
    'method'     => 'post',
    'action'     => '/blog/post/delete/',
    'attributes' => [
        'style' => 'display: inline; float:right; font-size: 36px',
        'class' => 'delete'
    ],
    // элементы формы
    'elements'   => [
        'id'   => [
            // тип элемента
            'type' => 'hidden'
        ],
        'csrf' => [
            'type' => 'csrf'
        ]
    ]
];
