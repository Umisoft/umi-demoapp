<?php
/**
 * UMI.Framework (http://umi-framework.ru/)
 *
 * @link      http://github.com/Umisoft/framework for the canonical source repository
 * @copyright Copyright (c) 2007-2013 Umisoft ltd. (http://umisoft.ru/)
 * @license   http://umi-framework.ru/license/bsd-3 BSD-3 License
 */

/**
 * Локальная конифгурация загрузчика приложения
 */

use umi\config\toolbox\ConfigTools;
use umi\i18n\toolbox\I18nTools;

$applicationPath = dirname(__DIR__);
$vendorDirectory = $applicationPath . '/vendor';
$libraryPath = $vendorDirectory . '/umi/framework/library/umi';

return [
    /**
     * Конфигурация для регистрации наборов инструментов.
     */
    Bootstrap::OPTION_TOOLKIT  => [
        require($libraryPath . '/authentication/toolbox/config.php'),
        require($libraryPath . '/i18n/toolbox/config.php'),
        require($libraryPath . '/event/toolbox/config.php'),
        require($libraryPath . '/config/toolbox/config.php'),
        require($libraryPath . '/http/toolbox/config.php'),
        require($libraryPath . '/route/toolbox/config.php'),
        require($libraryPath . '/session/toolbox/config.php'),
        require($libraryPath . '/hmvc/toolbox/config.php'),
        require($libraryPath . '/templating/toolbox/config.php'),
        require($libraryPath . '/dbal/toolbox/config.php'),
        require($libraryPath . '/orm/toolbox/config.php'),
        require($libraryPath . '/form/toolbox/config.php'),
        require($libraryPath . '/pagination/toolbox/config.php'),
        require($libraryPath . '/filter/toolbox/config.php'),
        require($libraryPath . '/validation/toolbox/config.php'),
    ],
    /**
     * Конфигурация встроенных иснтрументов
     */
    Bootstrap::OPTION_SETTINGS => [
        ConfigTools::NAME       => [
            'aliases' => [
                '~'             => [__DIR__, __DIR__ . '/local'],
                '~/application' => [dirname(__DIR__) . '/application']
            ]
        ],
        I18nTools::NAME => [
            'currentLocale' => 'ru-RU',

            'translatorDictionaries' => require('i18n.php')
        ]
    ]
];
