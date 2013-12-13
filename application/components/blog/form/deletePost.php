<?php
/**
 * UMI.Framework (http://umi-framework.ru/)
 *
 * @link      http://github.com/Umisoft/framework for the canonical source repository
 * @copyright Copyright (c) 2007-2013 Umisoft ltd. (http://umisoft.ru/)
 * @license   http://umi-framework.ru/license/bsd-3 BSD-3 License
 */

use umi\form\element\CSRF;
use umi\form\element\Hidden;

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
            'type' => Hidden::TYPE_NAME
        ],
        'csrf' => [
            'type' => CSRF::TYPE_NAME
        ]
    ]
];
