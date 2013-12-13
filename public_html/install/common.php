<?php
/**
 * UMI.Framework (http://umi-framework.ru/)
 *
 * @link      http://github.com/Umisoft/framework for the canonical source repository
 * @copyright Copyright (c) 2007-2013 Umisoft ltd. (http://umisoft.ru/)
 * @license   http://umi-framework.ru/license/bsd-3 BSD-3 License
 */

use umi\dbal\driver\IColumnScheme;
use umi\dbal\driver\ITableScheme;
use umi\orm\object\IObject;

/**
 * @param ITableScheme $table
 */
function prepareCollectionTable(ITableScheme $table)
{
    $table->addColumn(IObject::FIELD_IDENTIFY, IColumnScheme::TYPE_SERIAL);
    $table->addColumn(IObject::FIELD_TYPE, IColumnScheme::TYPE_VARCHAR);
    $table->addColumn(IObject::FIELD_GUID, IColumnScheme::TYPE_VARCHAR);
    $table->addColumn(IObject::FIELD_VERSION, IColumnScheme::TYPE_INT, [IColumnScheme::OPTION_DEFAULT_VALUE => 1]);

    $table->setPrimaryKey(IObject::FIELD_IDENTIFY);
    $table->addIndex($table->getName() . '_' . IObject::FIELD_GUID)
        ->addColumn(IObject::FIELD_GUID)
        ->setIsUnique();
}

/**
 * @param string $filename
 */
function showHtmlPage($filename)
{
    ob_start();
    require $filename;
    $content = ob_get_clean();
    require __DIR__ . '/templates/layout.phtml';
    exit();
}