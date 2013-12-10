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
 * Контроллер загрузки тегов.
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
