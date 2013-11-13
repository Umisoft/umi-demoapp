<?php
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