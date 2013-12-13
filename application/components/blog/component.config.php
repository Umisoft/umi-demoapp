<?php
/**
 * UMI.Framework (http://umi-framework.ru/)
 *
 * @link      http://github.com/Umisoft/framework for the canonical source repository
 * @copyright Copyright (c) 2007-2013 Umisoft ltd. (http://umisoft.ru/)
 * @license   http://umi-framework.ru/license/bsd-3 BSD-3 License
 */

namespace application\components\blog;

use umi\hmvc\component\IComponent;
use umi\route\IRouteFactory;

return [
    // зарегистрированные контроллеры
    IComponent::OPTION_CONTROLLERS => [
        'post/add'    => __NAMESPACE__ . '\controller\AddPostController',
        'post/list'   => __NAMESPACE__ . '\controller\IndexController',
        'post/view'   => __NAMESPACE__ . '\controller\PostController',
        'post/delete' => __NAMESPACE__ . '\controller\DeletePostController',
        'post/author' => __NAMESPACE__ . '\controller\AuthorController',
        'post/tag'    => __NAMESPACE__ . '\controller\TagController',
        'tag/list'    => __NAMESPACE__ . '\controller\TagLoaderController'
    ],
    // зарегистрированные модели
    IComponent::OPTION_MODELS      => [
        'post'   => __NAMESPACE__ . '\model\PostModel',
        'author' => __NAMESPACE__ . '\model\AuthorModel',
        'tag'    => __NAMESPACE__ . '\model\TagModel',
        'user'   => 'application\model\UserModel'
    ],
    // настройки шаблонизатора
    IComponent::OPTION_VIEW        => [
        // тип шаблонизатора - TWIG
        'type'      => 'twig',
        // путь до шаблонов
        'directory' => __DIR__ . '/view',
        'extension' => 'twig',
        'helpers'   => [
            'getCurrentUser' => 'application\view\helper\CurrentUserViewHelper'
        ]
    ],
    // роутинг текущего компонента
    IComponent::OPTION_ROUTES      => [
        'post'       => [
            'type'     => IRouteFactory::ROUTE_SIMPLE,
            'route'    => '/post/{id:guid}',
            'defaults' => [
                'controller' => 'post/view'
            ]
        ],
        'author'     => [
            'type'     => IRouteFactory::ROUTE_SIMPLE,
            'route'    => '/author/{id:guid}',
            'defaults' => [
                'controller' => 'post/author'
            ]
        ],
        'tag'        => [
            'type'     => IRouteFactory::ROUTE_SIMPLE,
            'route'    => '/tag/{id:guid}',
            'defaults' => [
                'controller' => 'post/tag'
            ]
        ],
        'getTags'    => [
            'type'     => IRouteFactory::ROUTE_FIXED,
            'route'    => '/getTags',
            'defaults' => [
                'controller' => 'tag/list'
            ]
        ],
        'addPost'    => [
            'type'     => IRouteFactory::ROUTE_FIXED,
            'route'    => '/post/add',
            'defaults' => [
                'controller' => 'post/add'
            ]
        ],
        'deletePost' => [
            'type'     => IRouteFactory::ROUTE_FIXED,
            'route'    => '/post/delete',
            'defaults' => [
                'controller' => 'post/delete'
            ]
        ],
        'index'      => [
            'type'     => IRouteFactory::ROUTE_SIMPLE,
            'route'    => '/{page:integer}',
            'defaults' => [
                'controller' => 'post/list',
                'page'       => 1
            ],
        ],
    ]
];
