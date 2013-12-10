<?php
/**
 * UMI.Framework (http://umi-framework.ru/)
 *
 * @link      http://github.com/Umisoft/framework for the canonical source repository
 * @copyright Copyright (c) 2007-2013 Umisoft ltd. (http://umisoft.ru/)
 * @license   http://umi-framework.ru/license/bsd-3 BSD-3 License
 */

use umi\filter\IFilterFactory;
use umi\form\element\Password;
use umi\form\element\Text;
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
            'type'       => Text::TYPE_NAME,
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
                IValidatorFactory::TYPE_REQUIRED => []
            ]
        ],
        // элемента Password
        'password' => [
            'type'       => Password::TYPE_NAME,
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