<?php
/**
 * UMI.Framework (http://umi-framework.ru/)
 * @link      http://github.com/Umisoft/framework for the canonical source repository
 * @copyright Copyright (c) 2007-2013 Umisoft ltd. (http://umisoft.ru/)
 * @license   http://umi-framework.ru/license/bsd-3 BSD-3 License
 */

namespace application\view\helper;

use umi\hmvc\component\request\IComponentRequest;
use umi\hmvc\context\IContextAware;
use umi\hmvc\context\TContextAware;

/**
 * Помощник вида для вывода URL дочернего компонента.
 */
class ComponentUrlViewHelper implements IContextAware
{
    use TContextAware;

    /**
     * Помощник вида для вывода URL дочернего компонента.
     * @param string $child имя дочернего компонента
     * @param string $name имя маршрута дочернего компонента
     * @param array $params параметры маршрута дочернего компонента
     * @return string
     */
    public function __invoke($child, $name, array $params = [])
    {
        $childComponent = $this->getContext()->getComponent()
            ->getChildComponent($child);

        return $this->getCurrentPathToComponent($child) . $childComponent->getRouter()
            ->assemble($name, $params);
    }

    /***
     * Возвращает путь до заданного компонента.
     * @param string $name имя компонента
     * @return string
     */
    protected function getCurrentPathToComponent($name)
    {
        $router = $this
            ->getContext()->getComponent()
            ->getRouter();

        $requestRouteParams = $this->getContext()->getRequest()
            ->getParams(IComponentRequest::ROUTE)
            ->toArray();

        $routeParams = ['component' => $name] + $requestRouteParams;

        return $router->assemble('home/component', $routeParams);
    }
}
