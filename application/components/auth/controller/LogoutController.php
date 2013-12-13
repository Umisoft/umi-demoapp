<?php
/**
 * UMI.Framework (http://umi-framework.ru/)
 * @link      http://github.com/Umisoft/framework for the canonical source repository
 * @copyright Copyright (c) 2007-2013 Umisoft ltd. (http://umisoft.ru/)
 * @license   http://umi-framework.ru/license/bsd-3 BSD-3 License
 */

namespace application\components\auth\controller;

use application\model\UserModel;
use umi\hmvc\component\request\IComponentRequest;
use umi\hmvc\context\IContextAware;
use umi\hmvc\context\TContextAware;
use umi\hmvc\controller\type\BaseController;

/**
 * Контроллер разавторизации пользователя.
 */
class LogoutController extends BaseController implements IContextAware
{
    use TContextAware;

    /**
     * @var UserModel $userModel модель пользователей
     */
    protected $userModel;

    /**
     * Конструктор.
     * @param UserModel $userModel
     */
    public function __construct(UserModel $userModel)
    {
        $this->userModel = $userModel;
    }

    /**
     * {@inheritdoc}
     */
    public function __invoke(IComponentRequest $request)
    {
        $this->userModel->logout();

        return $this->createRedirectResponse(
            $this->getContext()->getComponent()->getRouter()
                ->getBaseUrl() ? : '/'
        );
    }
}
