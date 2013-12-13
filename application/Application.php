<?php
/**
 * UMI.Framework (http://umi-framework.ru/)
 *
 * @link      http://github.com/Umisoft/framework for the canonical source repository
 * @copyright Copyright (c) 2007-2013 Umisoft ltd. (http://umisoft.ru/)
 * @license   http://umi-framework.ru/license/bsd-3 BSD-3 License
 */

namespace application;

use umi\hmvc\component\Component;
use umi\hmvc\component\request\IComponentRequest;
use umi\hmvc\component\response\IComponentResponse;
use umi\hmvc\context\Context;
use umi\i18n\ILocalesService;
use umi\session\ISessionAware;
use umi\session\TSessionAware;
use umi\toolkit\IToolkitAware;
use umi\toolkit\TToolkitAware;

/**
 * MVC Application.
 */
class Application extends Component implements ISessionAware, IToolkitAware
{
    use TSessionAware;
    use TToolkitAware;

    /** Контроллер для отображения сетки приложения */
    const LAYOUT_CONTROLLER = 'layout';
    /**
     * Пространство имен сессии для сохранения данных PRG.
     */
    const PRG_NAMESPACE = 'post_redirect_get';

    /**
     * {@inheritdoc}
     */
    public function execute(IComponentRequest $request)
    {
        if (null !== ($response = $this->postRedirectGet($request))) {
            return $response;
        } else {
            return parent::execute($request);
        }
    }

    /**
     * {@inheritdoc}
     */
    protected function route(IComponentRequest $request)
    {
        $result = parent::route($request);

        /**
         * @var ILocalesService $service
         */
        $service = $this->getToolkit()
            ->getService('umi\i18n\ILocalesService');
        $service->setCurrentLocale(
            $request->getVar(IComponentRequest::ROUTE, 'lang', 'en-US')
        );

        return $result;
    }

    /**
     * {@inheritdoc}
     */
    public function processResponse(IComponentResponse &$response, IComponentRequest $request)
    {
        if (!$this->getControllerFactory()->hasController(self::LAYOUT_CONTROLLER)) {
            return;
        }

        $context = new Context($this, $request);
        $controller = $this->getControllerFactory()->createController(self::LAYOUT_CONTROLLER, [$response]);

        $response = $this->callController($controller, $context);
    }

    /**
     * Реализация паттерна Post/Redirect/Get - PRG.
     * @link http://en.wikipedia.org/wiki/Post/Redirect/Get
     */
    protected function postRedirectGet(IComponentRequest $request)
    {
        if (!$this->hasSessionNamespace(self::PRG_NAMESPACE)) {
            $this->registerSessionNamespace(self::PRG_NAMESPACE);
        }

        $prgNamespace = $this->getSessionNamespace(self::PRG_NAMESPACE);
        $prgKey = 'prg_' . md5($request->getRequestUri());

        if ($request->getMethod() == IComponentRequest::POST) {
            $prgNamespace[$prgKey] = $request->getParams(IComponentRequest::POST)
                ->toArray();

            return $this->createComponentResponse()
                ->getHeaders()
                ->setHeader('Location', $request->getRequestUri());

        } elseif ($prgNamespace->has($prgKey)) {

            $request->getParams(IComponentRequest::HEADERS)
                ->set('REQUEST_METHOD', 'POST');

            $request->getParams(IComponentRequest::POST)
                ->setArray($prgNamespace[$prgKey]);

            $prgNamespace->del($prgKey);

            return null;
        }

        return null;
    }
}
