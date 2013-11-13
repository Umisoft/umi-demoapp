<?php
namespace application\components\blog;

use umi\hmvc\component\IComponent;

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
            'type'     => 'simple',
            'route'    => '/post/{id:guid}',
            'defaults' => [
                'controller' => 'post/view'
            ]
        ],
        'author'     => [
            'type'     => 'simple',
            'route'    => '/author/{id:guid}',
            'defaults' => [
                'controller' => 'post/author'
            ]
        ],
        'tag'        => [
            'type'     => 'simple',
            'route'    => '/tag/{id:guid}',
            // параметры роутинга по умолчанию
            'defaults' => [
                'controller' => 'post/tag'
            ]
        ],
        'getTags'    => [
            'type'     => 'fixed',
            'route'    => '/getTags',
            'defaults' => [
                'controller' => 'tag/list'
            ]
        ],
        // роутинг для добавления поста
        'addPost'    => [
            // тип роута - простой
            'type'     => 'fixed',
            // путь(маска) роута
            'route'    => '/post/add',
            // параметры роутинга по умолчанию
            'defaults' => [
                'controller' => 'post/add'
            ]
        ],
        // роутинг для удаления поста
        'deletePost' => [
            // тип роута - простой
            'type'     => 'fixed',
            // путь(маска) роута
            'route'    => '/post/delete',
            // параметры роутинга по умолчанию
            'defaults' => [
                'controller' => 'post/delete'
            ]
        ],
        'index'      => [
            'type'     => 'simple',
            'route'    => '/{page:integer}',
            'defaults' => [
                'controller' => 'post/list',
                'page'       => 1
            ],
        ],
    ]
];
