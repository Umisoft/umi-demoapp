<?php
/**
 * UMI.Framework (http://umi-framework.ru/)
 *
 * @link      http://github.com/Umisoft/framework for the canonical source repository
 * @copyright Copyright (c) 2007-2013 Umisoft ltd. (http://umisoft.ru/)
 * @license   http://umi-framework.ru/license/bsd-3 BSD-3 License
 */

use umi\filter\IFilterFactory;
use umi\form\element\Text;
use umi\form\element\Textarea;
use umi\validation\IValidatorFactory;

return [
    'name'     => 'contact',
    'method'   => 'post',
    // элементы формы
    'elements' => [
        // элемент Фамилия Имя
        'name'    => [
            // тип элемента
            'type'       => Text::TYPE_NAME,
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
            'type'       => Text::TYPE_NAME,
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
            'type'       => Text::TYPE_NAME,
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
            'type'       => Textarea::TYPE_NAME,
            'label'      => 'Message',
            'attributes' => [
                'id'   => 'contact_content',
                'rows' => 5
            ],
        ],
    ]
];