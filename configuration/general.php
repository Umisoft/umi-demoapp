<?php
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
                    'adapter' => [
                        'type' => IAuthenticationFactory::ADAPTER_ORM,
                        'options' => [
                            'collectionName' => 'users',
                            'loginFields' => ['login', 'email'],
                            'passwordField' => 'password'
                        ]
                    ],
                    'storage' => [
                        'type' => IAuthenticationFactory::STORAGE_ORM_SESSION
                    ]
                ]
            ]
        ],

        DbalTools::NAME => [
            'servers' => [
                [
                    'id'     => 'demoDB',
                    'type'   => 'master',
                    'driver' => [
                        'type'    => 'sqlite',
                        'options' => [
                            'dsn' => 'sqlite:' . __DIR__ . '/../demo.db'
                        ]
                    ]
                ]
            ],
        ],
        ORMTools::NAME  => [
            'metadataManager'   => [
                'collections' => [
                    'posts'    => '{#lazy:~/metadata/posts.config.php}',
                    'users'    => '{#lazy:~/metadata/users.config.php}',
                    'tags'     => '{#lazy:~/metadata/tags.config.php}',
                    'postTags' => '{#lazy:~/metadata/post_tags.config.php}'
                ]
            ],
            'collectionManager' => [
                'productId'   => 'demo',
                'collections' => [
                    'posts'    => ['type' => ICollectionFactory::TYPE_SIMPLE],
                    'users'    => ['type' => ICollectionFactory::TYPE_SIMPLE],
                    'tags'     => ['type' => ICollectionFactory::TYPE_SIMPLE],
                    'postTags' => ['type' => ICollectionFactory::TYPE_SIMPLE]
                ]
            ]
        ]
    ],
    'application' => '{#lazy:~/application/component.config.php}'
];