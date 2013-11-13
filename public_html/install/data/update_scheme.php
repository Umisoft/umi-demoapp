<?php
use umi\dbal\driver\IColumnScheme;
use umi\dbal\driver\ITableScheme;
use umi\orm\object\IObject;

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
