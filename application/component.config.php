<?php
namespace application;

use umi\hmvc\component\IComponent;
use umi\route\IRouteFactory;

return [
    // класс MVC-компонента
    'componentClass'               => __NAMESPACE__ . '\Application',
    // конфигурация дочерних компонент
    IComponent::OPTION_COMPONENTS  => [
        'auth'     => '{#lazy:~/application/components/auth/component.config.php}',
        'blog'     => '{#lazy:~/application/components/blog/component.config.php}',
        'feedback' => '{#lazy:~/application/components/feedback/component.config.php}',
    ],
    // зарегистрированные контроллеры
    IComponent::OPTION_CONTROLLERS => [
        IComponent::ERROR_CONTROLLER   => __NAMESPACE__ . '\controller\ErrorController',
        Application::LAYOUT_CONTROLLER => __NAMESPACE__ . '\controller\LayoutController',
        'index'                        => __NAMESPACE__ . '\controller\IndexController'
    ],
    // зарегистрированные модели
    IComponent::OPTION_MODELS      => [
        'user' => __NAMESPACE__ . '\model\UserModel'
    ],
    // настройки шаблонизатора
    IComponent::OPTION_VIEW        => [
        // тип шаблонизатора
        'type'      => 'php',
        'extension' => 'phtml',
        // путь до шаблонов компонента
        'directory' => __DIR__ . '/view',
        'helpers'   => [
            'getCurrentUser' => __NAMESPACE__ . '\view\helper\CurrentUserViewHelper',
            'componentUrl'   => __NAMESPACE__ . '\view\helper\ComponentUrlViewHelper'
        ]
    ],
    // маршруты текущего компонента
    IComponent::OPTION_ROUTES      => [
        'home' => [
            // тип маршрута - на основе simple-выражений
            'type'      => IRouteFactory::ROUTE_EXTENDED,
            // путь(маска) маршрута
            'route'     => '/{lang}',
            'rules'     => [
                'lang' => '[a-z]{2}-[A-Z]{2}'
            ],
            'defaults'  => [
                'lang'       => 'ru-RU',
                'controller' => 'index'
            ],
            'subroutes' => [
                'component' => [
                    // тип маршрута - на основе simple-выражений
                    'type'     => IRouteFactory::ROUTE_SIMPLE,
                    // путь(маска) маршрута
                    'route'    => '/{component}',
                    'defaults' => [
                        'controller' => ''
                    ],
                ],
            ]
        ]
    ]
];