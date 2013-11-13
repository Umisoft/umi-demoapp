<?php
/**
 * UMI.Framework (http://umi-framework.ru/)
 * @link      http://github.com/Umisoft/framework for the canonical source repository
 * @copyright Copyright (c) 2007-2013 Umisoft ltd. (http://umisoft.ru/)
 * @license   http://umi-framework.ru/license/bsd-3 BSD-3 License
 */
namespace application\components\auth\controller;

use application\model\UserModel;
use umi\form\IForm;
use umi\form\IFormAware;
use umi\form\TFormAware;
use umi\hmvc\component\request\IComponentRequest;
use umi\hmvc\controller\result\IControllerResult;
use umi\hmvc\controller\type\BaseController;

/**
 * Контроллер авторизации.
 */
class LoginController extends BaseController implements IFormAware
{
    use TFormAware;

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
     * Производит авторизацию в системе.
     * {@inheritdoc}
     */
    public function __invoke(IComponentRequest $request)
    {
        if ($this->userModel->isAuthenticated()) {
            return $this->createControllerResult('already', ['user' => $this->userModel->getCurrentUser()]);
        }

        $form = $this->createForm(require dirname(__DIR__) . '/form/login.php');

        if ($request->getMethod() == IComponentRequest::POST) {
            $form->setData(
                $request->getParams(IComponentRequest::POST)
                    ->toArray()
            );

            if ($form->isValid()) {
                $data = $form->getData();

                if (!$this->userModel->login($data['email'], $data['password'])) {
                    $response = $this->showForm($form, 'Wrong username or password');
                    $response->setCode(403);

                    return $response;
                };

                return $this->createControllerResult('success', ['user' => $this->userModel->getCurrentUser()]);
            }

            return $this->showForm($form);
        }

        return $this->showForm($form);
    }

    /**
     * Выводит форму авторизации.
     * @param IForm $form форма
     * @param string $flashMessage сообщение [optional]
     * @return IControllerResult
     */
    protected function showForm(IForm $form, $flashMessage = null)
    {
        return $this->createControllerResult(
            'login',
            [
                'message' => $flashMessage,
                'form'    => $form
            ]
        );
    }
}
