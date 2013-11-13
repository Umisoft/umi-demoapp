<?php
use umi\filter\IFilterFactory;
use umi\validation\IValidatorFactory;

return [
    'name'     => 'contact',
    'method'   => 'post',
    // элементы формы
    'elements' => [
        // элемент Фамилия Имя
        'name'    => [
            // тип элемента
            'type'       => 'text',
            'label'      => 'Name',
            // аттрибуты элемента
            'attributes' => [
                'id' => 'formName',
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
        // элемент Email
        'email'   => [
            'type'       => 'text',
            'label'      => 'E-mail',
            'attributes' => [
                'id' => 'contact_email',
            ],
            'filters'    => [
                IFilterFactory::TYPE_STRING_TRIM => []
            ],
            'validators' => [
                IValidatorFactory::TYPE_REQUIRED => [],
                IValidatorFactory::TYPE_EMAIL    => []
            ]
        ],
        // элемент Тема сообщения
        'subject' => [
            'type'       => 'text',
            'label'      => 'Subject',
            'attributes' => [
                'id' => 'contact_subject',
            ],
            'validators' => [
                IValidatorFactory::TYPE_REQUIRED => []
            ]
        ],
        // элемент Тело сообщения
        'content' => [
            'type'       => 'textarea',
            'label'      => 'Message',
            'attributes' => [
                'id'   => 'contact_content',
                'rows' => 5
            ],
        ],
    ]
];