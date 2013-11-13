<?php
use umi\orm\objectset\IManyToManyObjectSet;

if (!isset($collectionManager)) {
    exit;
}

/**
 * Add users.
 */
$rootUser = $collectionManager->getCollection('users')->add();
$rootUser->setGUID('71b1b43f-bd8a-445e-b388-033782f85168');
$rootUser->setValue('login', 'root');
$rootUser->setValue('email', 'root@demo.local');
$rootUser->setValue('password', 'root');
$rootUser->setValue('name', 'Administrator', 'en-US');
$rootUser->setValue('name', 'Администратор', 'ru-RU');

/**
 * Add tags.
 */
$tag1 = $collectionManager->getCollection('tags')->add();
$tag1->setValue('name', 'UMI', 'en-US');
$tag1->setValue('name', 'Юми', 'ru-RU');

$tag2 = $collectionManager->getCollection('tags')->add();
$tag2->setValue('name', 'Important', 'en-US');
$tag2->setValue('name', 'Важно', 'ru-RU');

/**
 * Add posts.
 */
$post1 = $collectionManager->getCollection('posts')->add();
$post1->setGUID('aad4233a-9652-4f7a-bf27-490bfdc7f66c');
$post1->setValue('owner', $rootUser);
$post1->setValue('title', 'Release UMI.Framework', 'en-US');
$post1->setValue('title', 'Релиз UMI.Framework', 'ru-RU');
$post1->setValue(
    'content',
    'UMI.Framework currently in alpha stage. Yo can us it "as is".',
    'en-US'
);
$post1->setValue(
    'content',
    'На данный момент UMI.Framework в стадии alpha. Вы можете использовать его на свой страх и риск.".',
    'ru-RU'
);

/**
 * @var IManyToManyObjectSet $post1Tags
 */
$post1Tags = $post1->getValue('tags');
$post1Tags->attach($tag1);
$post1Tags->attach($tag2);

$objectPersister->commit();
