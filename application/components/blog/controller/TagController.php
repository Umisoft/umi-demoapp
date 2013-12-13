<?php
/**
 * UMI.Framework (http://umi-framework.ru/)
 *
 * @link      http://github.com/Umisoft/framework for the canonical source repository
 * @copyright Copyright (c) 2007-2013 Umisoft ltd. (http://umisoft.ru/)
 * @license   http://umi-framework.ru/license/bsd-3 BSD-3 License
 */

namespace application\components\blog\controller;

use application\components\blog\model\TagModel;
use umi\hmvc\component\request\IComponentRequest;
use umi\hmvc\controller\type\BaseController;

/**
 * Контроллер отображения постов по тегам.
 */
class TagController extends BaseController
{
    /**
     * @var TagModel $tagModel
     */
    protected $tagModel;

    /**
     * Конструктор.
     * @param TagModel $model
     */
    public function __construct(TagModel $model)
    {
        $this->tagModel = $model;
    }

    /**
     * {@inheritdoc}
     */
    public function __invoke(IComponentRequest $request)
    {
        $guid = $request->getVar(IComponentRequest::ROUTE, 'id');
        $tag = $this->tagModel->getTag($guid);

        return $this->createDisplayResponse(
            'tag',
            [
                'tag'   => $tag,
                'posts' => $this->tagModel->getTagPosts($tag)
            ]
        );
    }
}
