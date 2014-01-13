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
use umi\orm\objectset\IManyToManyObjectSet;
use umi\orm\selector\ISelector;

/**
 * Модель для работы с тегами блога.
 */
class TagModel implements ICollectionManagerAware, IModel
{
    use TCollectionManagerAware;

    /**
     * Возвращает теги поста.
     * @param $tag
     * @return ISelector
     */
    public function getTagPosts(IObject $tag)
    {
        return $this->getCollectionManager()
            ->getCollection('posts')
            ->select()
            ->orderBy('publishTime', ISelector::ORDER_DESC)
            ->where('tags')
            ->equals($tag);
    }

    /**
     * Возвращает тег по GUID.
     * @param string $guid идентификатор
     * @return IObject
     */
    public function getTag($guid)
    {
        return $this->getCollectionManager()
            ->getCollection('tags')
            ->get($guid);
    }

    /**
     * Выставляет теги для поста
     * @param IObject $post пост
     * @param array $tagNames список тегов
     */
    public function setTagsToPost(IObject $post, array $tagNames)
    {
        /**
         * @var IManyToManyObjectSet $postTags
         */
        $postTags = $post->getValue('tags');

        foreach ($tagNames as $tagName) {
            $postTags->attach($this->getTagByName($tagName));
        }
    }

    /**
     * Добавляет тег или возвращает существующий
     * @param string $tagName имя тега
     * @return IObject
     */
    protected function getTagByName($tagName)
    {
        $tagName = trim($tagName);
        $tagCollection = $this->getCollectionManager()
            ->getCollection('tags');
        $result = $tagCollection->select()
            ->where('name')
            ->equals($tagName)
            ->getResult();
        if (!$result->count()) {
            return $tagCollection->add()
                ->setValue('name', $tagName);
        }

        return $result->fetch();
    }
}
