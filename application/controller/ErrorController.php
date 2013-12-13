<?php
/**
 * UMI.Framework (http://umi-framework.ru/)
 *
 * @link      http://github.com/Umisoft/framework for the canonical source repository
 * @copyright Copyright (c) 2007-2013 Umisoft ltd. (http://umisoft.ru/)
 * @license   http://umi-framework.ru/license/bsd-3 BSD-3 License
 */

namespace application\controller;

use umi\hmvc\component\request\IComponentRequest;
use umi\hmvc\component\response\IComponentResponse;
use umi\hmvc\controller\type\BaseController;
use umi\hmvc\exception\http\HttpException;

/**
 * Контроллер ошибок компонента.
 */
class ErrorController extends BaseController
{
    /**
     * @var \Exception $exception исключение
     */
    protected $exception;

    /**
     * Конструктор.
     * @param \Exception $e исключение
     */
    public function __construct(\Exception $e)
    {
        $this->exception = $e;
    }

    /**
     * {@inheritdoc}
     */
    public function __invoke(IComponentRequest $request)
    {
        if ($this->exception instanceof HttpException) {
            return $this->httpException();
        }

        return $this->createDisplayResponse('error', ['e' => $this->exception])
            ->setCode(500);
    }

    /**
     * Обрабатывает HTTP исключения
     * @return IComponentResponse
     */
    public function httpException()
    {
        if ($this->exception->getCode() == HttpException::HTTP_NOT_FOUND) {
            return $this->error404();
        }

        return $this->createDisplayResponse('error', ['e' => $this->exception])
            ->setCode($this->exception->getCode());
    }

    /**
     * Отображает 404 ошибку.
     * @return IComponentResponse
     */
    public function error404()
    {
        return $this->createDisplayResponse('error404', ['e' => $this->exception])
            ->setCode(404);
    }
}