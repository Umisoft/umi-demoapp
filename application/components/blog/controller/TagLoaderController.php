<?php
namespace application\components\blog\controller;

use application\components\blog\model\TagModel;
use umi\hmvc\component\request\IComponentRequest;
use umi\hmvc\controller\type\BaseController;

/**
 * Контроллер отображения блогов по тегам.
 * @package App\Blog
 */
class TagLoaderController extends BaseController
{
    /**
     * @var TagModel $tagModel модель работы с тэгами
     */
    protected $tagModel;

    /**
     * Конструктор.
     * @param TagModel $tagModel модель для работы с тэгами
     */
    public function __construct(TagModel $tagModel)
    {
        $this->tagModel = $tagModel;
    }

    /**
     * {@inheritdoc}
     */
    public function __invoke(IComponentRequest $request)
    {
        $tagPart = $request->getVar(IComponentRequest::ROUTE, 'tag');
        $tags = $this->tagModel->getTags($tagPart);

        $response = $this->createPlainResponse(
            json_encode($tags)
        );
        $response->getHeaders()
            ->setHeader('Content-Type', 'application/json');
        $response->stopProcessing();

        return $response;
    }
}
