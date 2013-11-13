<?php
use umi\filter\IFilterFactory;
use umi\validation\IValidatorFactory;

return [
    // имя формы
    'name'       => 'contact',
    // метод формы
    'method'     => 'post',
    // аттрибуты формы
    'attributes' => [
        'class' => 'form-horizontal'
    ],
    // элементы формы
    'elements'   => [
        // элемент Email
        'email'    => [
            // тип элемента
            'type'       => 'text',
            // label элемента
            'label'      => 'E-mail',
            // аттрибуты элемента
            'attributes' => [
                'id'    => 'login_email',
                'class' => 'input-xlarge',
            ],
            // фильтры значения элемента
            'filters'    => [
                IFilterFactory::TYPE_STRING_TRIM => []
            ],
            // валидаторы значения элемента
            'validators' => [
                IValidatorFactory::TYPE_REQUIRED => [],
                IValidatorFactory::TYPE_EMAIL    => []
            ]
        ],
        // элемента Password
        'password' => [
            'type'       => 'password',
            'label'      => 'Password',
            'attributes' => [
                'id'    => 'login_password',
                'class' => 'input-xlarge',
            ],
            'validators' => [
                IValidatorFactory::TYPE_REQUIRED => [],
            ]
        ],
    ]
];