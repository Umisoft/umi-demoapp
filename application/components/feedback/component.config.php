<?php
/**
 * UMI.Framework (http://umi-framework.ru/)
 *
 * @link      http://github.com/Umisoft/framework for the canonical source repository
 * @copyright Copyright (c) 2007-2013 Umisoft ltd. (http://umisoft.ru/)
 * @license   http://umi-framework.ru/license/bsd-3 BSD-3 License
 */

namespace application\components\feedback;

use umi\hmvc\component\IComponent;
use umi\route\IRouteFactory;

return [
    IComponent::OPTION_CONTROLLERS => [
        'index' => __NAMESPACE__ . '\controller\IndexController'
    ],
    IComponent::OPTION_MODELS      => [
        'contact' => __NAMESPACE__ . '\model\ContactModel',
        'user'    => 'application\model\UserModel',
    ],
    IComponent::OPTION_VIEW        => [
        'type'      => 'php',
        'directory' => __DIR__ . '/view',
        'extension' => 'phtml',
    ],
    IComponent::OPTION_ROUTES      => [
        'default' => [
            'type'     => IRouteFactory::ROUTE_FIXED,
            'defaults' => [
                'controller' => 'index'
            ]
        ],
    ],
];