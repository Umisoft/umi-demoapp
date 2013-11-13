<?php
use umi\filter\IFilterFactory;
use umi\validation\IValidatorFactory;

return [
    // имя формы
    'name'       => 'post',
    // метод формы
    'method'     => 'post',
    // аттрибуты формы
    'attributes' => [
        'class' => 'form-horizontal'
    ],
    // элементы формы
    'elements'   => [
        'title'   => [
            // тип элемента
            'type'       => 'text',
            // label элемента
            'label'      => 'Title',
            // аттрибуты элемента
            'attributes' => [
                'class' => 'input-xlarge',
            ],
            // фильтры значения элемента
            'filters'    => [
                IFilterFactory::TYPE_STRING_TRIM => []
            ],
            // валидаторы значения элемента
            'validators' => []
        ],
        'content' => [
            // тип элемента
            'type'       => 'textarea',
            // label элемента
            'label'      => 'Message',
            // аттрибуты элемента
            'attributes' => [
                'class' => 'input-xlarge',
                'rows'  => 5
            ],
            // фильтры значения элемента
            'filters'    => [
                IFilterFactory::TYPE_STRING_TRIM => []
            ],
            // валидаторы значения элемента
            'validators' => [
                IValidatorFactory::TYPE_REQUIRED => []
            ]
        ],
        'tags'    => [
            // тип элемента
            'type'       => 'text',
            // label элемента
            'label'      => 'Tags',
            // аттрибуты элемента
            'attributes' => [
                'class'        => 'input-xlarge',
                'id'           => 'typeahead',
                'data-provide' => 'typeahead',
                'autocomplete' => 'off'
            ],
            // фильтры значения элемента
            'filters'    => [
                IFilterFactory::TYPE_STRING_TRIM => []
            ],
            // валидаторы значения элемента
            'validators' => []
        ],
        'csrf'    => [
            'type' => 'csrf'
        ],
    ]
];
