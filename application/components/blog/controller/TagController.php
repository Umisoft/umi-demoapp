<?php
namespace application\components\blog\controller;

use application\components\blog\model\TagModel;
use umi\hmvc\component\request\IComponentRequest;
use umi\hmvc\controller\type\BaseController;

/**
 * Контроллер отображения блогов по тегам.
 * @package App\Blog
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

        return $this->createControllerResult(
            'tag',
            [
                'tag'   => $tag,
                'posts' => $this->tagModel->getTagPosts($tag)
            ]
        );
    }
}
