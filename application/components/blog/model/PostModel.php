<?php
/**
 * UMI.Framework (http://umi-framework.ru/)
 *
 * @link      http://github.com/Umisoft/framework for the canonical source repository
 * @copyright Copyright (c) 2007-2013 Umisoft ltd. (http://umisoft.ru/)
 * @license   http://umi-framework.ru/license/bsd-3 BSD-3 License
 */

namespace application\components\blog\model;

use umi\hmvc\model\IModel;
use umi\orm\collection\ICollectionManagerAware;
use umi\orm\collection\TCollectionManagerAware;
use umi\orm\object\IObject;
use umi\orm\selector\ISelector;

/**
 * Модель для работы с постами блога.
 */
class PostModel implements ICollectionManagerAware, IModel
{
    use TCollectionManagerAware;

    /**
     * Получает список всех постов блога.
     * @return ISelector
     */
    public function getPosts()
    {
        return $this->getCollectionManager()
            ->getCollection('posts')
            ->select()
            ->orderBy('publishTime', ISelector::ORDER_DESC);
    }

    /**
     * Получает пост блога по его идентификатору.
     * @param int $postGuid идентификатор поста
     * @return IObject пост
     */
    public function getPost($postGuid)
    {
        return $this->getCollectionManager()
            ->getCollection('posts')
            ->get($postGuid);
    }

    /**
     * Помечает пост на удаление
     * @param $postGuid идентификатор поста
     * @return void
     */
    public function deletePost($postGuid)
    {
        $posts = $this->getCollectionManager()
            ->getCollection('posts');
        $post = $posts->get($postGuid);

        $posts->delete($post);
    }

    /**
     * Создает новый пост.
     * @param string $ownerGuid владелец
     * @return IObject
     */
    public function addPost($ownerGuid)
    {
        $owner = $this->getCollectionManager()
            ->getCollection('users')
            ->get($ownerGuid);

        $post = $this->getCollectionManager()
            ->getCollection('posts')
            ->add();
        $post->setValue('publishTime', time());
        $post->setValue('owner', $owner);

        return $post;
    }
}
