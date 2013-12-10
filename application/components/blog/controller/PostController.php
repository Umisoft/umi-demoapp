<?php
/**
 * UMI.Framework (http://umi-framework.ru/)
 *
 * @link      http://github.com/Umisoft/framework for the canonical source repository
 * @copyright Copyright (c) 2007-2013 Umisoft ltd. (http://umisoft.ru/)
 * @license   http://umi-framework.ru/license/bsd-3 BSD-3 License
 */

namespace application\components\blog\controller;

use application\components\blog\model\PostModel;
use umi\hmvc\component\request\IComponentRequest;
use umi\hmvc\controller\type\BaseController;
use umi\hmvc\exception\http\HttpNotFound;

/**
 * Контроллер отображения страницы поста блога.
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

        return $this->createDisplayResponse(
            'post',
            [
                'post' => $this->postModel->getPost($guid),
            ]
        );
    }
}
