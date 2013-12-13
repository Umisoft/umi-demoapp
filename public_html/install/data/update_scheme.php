<?php
/**
 * UMI.Framework (http://umi-framework.ru/)
 *
 * @link      http://github.com/Umisoft/framework for the canonical source repository
 * @copyright Copyright (c) 2007-2013 Umisoft ltd. (http://umisoft.ru/)
 * @license   http://umi-framework.ru/license/bsd-3 BSD-3 License
 */

use umi\dbal\driver\IColumnScheme;

if (!isset($dbDriver)) {
    exit;
}

/**
 * Add "posts" table.
 */
$postsTable = $dbDriver->addTable('posts');

prepareCollectionTable($postsTable);
$postsTable->addColumn('title', IColumnScheme::TYPE_TEXT);
$postsTable->addColumn('title_en', IColumnScheme::TYPE_TEXT);
$postsTable->addColumn('publish_time', IColumnScheme::TYPE_TEXT);
$postsTable->addColumn('content', IColumnScheme::TYPE_TEXT);
$postsTable->addColumn('content_en', IColumnScheme::TYPE_TEXT);
$postsTable->addColumn('owner_id', IColumnScheme::TYPE_INT);

/**
 * Add "tags" table.
 */
$tagsTable = $dbDriver->addTable('tags');

prepareCollectionTable($tagsTable);
$tagsTable->addColumn('name', IColumnScheme::TYPE_TEXT);
$tagsTable->addColumn('name_en', IColumnScheme::TYPE_TEXT);

/**
 * Add "users" table.
 */
$usersTable = $dbDriver->addTable('users');

prepareCollectionTable($usersTable);
$usersTable->addColumn('name', IColumnScheme::TYPE_VARCHAR);
$usersTable->addColumn('name_en', IColumnScheme::TYPE_VARCHAR);
$usersTable->addColumn('login', IColumnScheme::TYPE_VARCHAR);
$usersTable->addColumn('email', IColumnScheme::TYPE_VARCHAR);
$usersTable->addColumn('password', IColumnScheme::TYPE_VARCHAR);
$usersTable->addColumn('is_active', IColumnScheme::TYPE_BOOL, [IColumnScheme::OPTION_DEFAULT_VALUE => 1]);

/**
 * Add "post_tags" table.
 */
$postTagsTable = $dbDriver->addTable('post_tags');

prepareCollectionTable($postTagsTable);
$postTagsTable->addColumn('post_id', IColumnScheme::TYPE_INT);
$postTagsTable->addColumn('tag_id', IColumnScheme::TYPE_INT);

/**
 * Add constraints.
 */
$postsTable->addConstraint(
    'userPosts',
    'owner_id',
    'users',
    'id'
);

$postTagsTable->addConstraint(
    'posts',
    'post_id',
    'posts',
    'id',
    'CASCADE',
    'CASCADE'
);

$postTagsTable->addConstraint(
    'tags',
    'tag_id',
    'tags',
    'id'
);

$dbDriver->applyMigrations();
