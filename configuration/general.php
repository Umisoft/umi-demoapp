<?php
/**
 * UMI.Framework (http://umi-framework.ru/)
 *
 * @link      http://github.com/Umisoft/framework for the canonical source repository
 * @copyright Copyright (c) 2007-2013 Umisoft ltd. (http://umisoft.ru/)
 * @license   http://umi-framework.ru/license/bsd-3 BSD-3 License
 */


use umi\authentication\IAuthenticationFactory;
use umi\authentication\toolbox\AuthenticationTools;
use umi\dbal\toolbox\DbalTools;
use umi\orm\collection\ICollectionFactory;
use umi\orm\toolbox\ORMTools;

return [
    /**
     * Конфигурация тулкита для тестового окружения
     */
    'toolkit'     => [
        AuthenticationTools::NAME => [
            'factories' => [
                'authentication' => [
                    'defaultAdapter' => [
                        'type' => IAuthenticationFactory::ADAPTER_ORM,
                        'options' => [
                            'collection' => 'users',
                            'loginFields' => ['login', 'email'],
                            'passwordField' => 'password'
                        ]
                    ],
                    'defaultStorage' => [
                        'type' => IAuthenticationFactory::STORAGE_ORM_SESSION
                    ]
                ]
            ]
        ],

        DbalTools::NAME => [
            'servers' => [
                [
                    'id'     => 'sqliteMaster',
                    'type'   => 'master',
                    'connection' => [
                        'type'    => DbalTools::CONNECTION_TYPE_PDOSQLITE,
                        'options' => [
                            'path' => __DIR__ . '/../demo.db'
                        ]
                    ]
                ]
            ],
        ],
        ORMTools::NAME  => [
            'metadata'   => [
                'posts'    => '{#lazy:~/metadata/posts.config.php}',
                'users'    => '{#lazy:~/metadata/users.config.php}',
                'tags'     => '{#lazy:~/metadata/tags.config.php}',
                'postTags' => '{#lazy:~/metadata/post_tags.config.php}'
            ],
            'collections' => [
                'posts'    => ['type' => ICollectionFactory::TYPE_SIMPLE],
                'users'    => ['type' => ICollectionFactory::TYPE_SIMPLE],
                'tags'     => ['type' => ICollectionFactory::TYPE_SIMPLE],
                'postTags' => ['type' => ICollectionFactory::TYPE_SIMPLE]
            ]
        ]
    ],

    'application' => '{#lazy:~/application/component.config.php}'
];
