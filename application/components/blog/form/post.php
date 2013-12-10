<?php
/**
 * UMI.Framework (http://umi-framework.ru/)
 *
 * @link      http://github.com/Umisoft/framework for the canonical source repository
 * @copyright Copyright (c) 2007-2013 Umisoft ltd. (http://umisoft.ru/)
 * @license   http://umi-framework.ru/license/bsd-3 BSD-3 License
 */

use umi\filter\IFilterFactory;
use umi\form\element\CSRF;
use umi\form\element\Text;
use umi\form\element\Textarea;
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
            'type'       => Text::TYPE_NAME,
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
            'type'       => Textarea::TYPE_NAME,
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
            'type'       => Text::TYPE_NAME,
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
            'type' => CSRF::TYPE_NAME
        ],
    ]
];
