<?php
namespace application\components\blog\controller;

use application\components\blog\model\PostModel;
use umi\hmvc\component\request\IComponentRequest;
use umi\hmvc\controller\type\BaseController;
use umi\hmvc\exception\http\HttpNotFound;

/**
 * Контроллер отображения страницы поста блога.
 * @package App\Blog
 */
class PostController extends BaseController
{
    /**
     * @var PostModel $postModel модель постов
     */
    protected $postModel;

    /**
     * Конструктор.
     * @param PostModel $postModel модель постов
     */
    public function __construct(PostModel $postModel)
    {
        $this->postModel = $postModel;
    }

    /**
     * {@inheritdoc}
     */
    public function __invoke(IComponentRequest $request)
    {
        $guid = $request->getVar(IComponentRequest::ROUTE, 'id');

        try {
            $this->postModel->getPost($guid);
        } catch (\Exception $e) { //todo: fix catching exception
            throw new HttpNotFound('Post not found.', 0, $e);
        }

        return $this->createControllerResult(
            'post',
            [
                'post' => $this->postModel->getPost($guid),
            ]
        );
    }
}
