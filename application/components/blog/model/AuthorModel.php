<?php
namespace application\components\blog\model;

use umi\hmvc\model\IModel;
use umi\orm\collection\ICollectionManagerAware;
use umi\orm\collection\TCollectionManagerAware;
use umi\orm\object\IObject;
use umi\orm\selector\ISelector;

/**
 * Модель для работы с авторами блога.
 */
class AuthorModel implements ICollectionManagerAware, IModel
{
    use TCollectionManagerAware;

    /**
     * Возвращает посты автора.
     * @param IObject $author автор
     * @return ISelector
     */
    public function getAuthorPosts(IObject $author)
    {
        return $this->getCollectionManager()
            ->getCollection('posts')
            ->select()
            ->orderBy('publishTime', ISelector::ORDER_DESC)
            ->where('owner')
            ->equals($author);
    }

    /**
     * Возвращает автора по GUID.
     * @param string $guid
     * @return IObject
     */
    public function getAuthor($guid)
    {
        return $this->getCollectionManager()
            ->getCollection('users')
            ->get($guid);
    }
}
