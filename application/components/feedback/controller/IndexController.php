<?php
namespace application\components\feedback\controller;

use application\components\feedback\model\ContactModel;
use application\model\UserModel;
use umi\form\IForm;
use umi\form\IFormAware;
use umi\form\TFormAware;
use umi\hmvc\component\request\IComponentRequest;
use umi\hmvc\component\response\IComponentResponse;
use umi\hmvc\controller\type\BaseController;
use umi\hmvc\model\IModelAware;
use umi\hmvc\model\TModelAware;

/**
 * Контроллер отображения формы обратной связи.
 * @package App\Contact
 */
class IndexController extends BaseController implements IFormAware, IModelAware
{
    use TFormAware;
    use TModelAware;

    /**
     * @var UserModel $userModel модель для работы с пользователями
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
        $form = $this->createForm(require dirname(__DIR__) . '/form/contact.php');

        if ($request->getMethod() == IComponentRequest::POST) {
            $form->setData(
                $request->getParams(IComponentRequest::POST)
                    ->toArray()
            );

            if ($form->isValid()) {
                $data = $form->getData();
                /**
                 * @var ContactModel $contactModel
                 */
                $contactModel = $this->createModelByName('contact');
                $contactModel->sendContact($data);

                return $this->createDisplayResponse('complete', []);
            }

            return $this->showForm($form);
        }

        if ($user = $this->userModel->getCurrentUser()) {
            $form->getElement('name')
                ->setValue($user->name);
            $form->getElement('email')
                ->setValue($user->email);
        }

        return $this->showForm($form);
    }

    /**
     * Отображает форму обратной связи.
     * @param IForm $form
     * @return IComponentResponse
     */
    public function showForm(IForm $form)
    {
        return $this->createDisplayResponse('index', ['form' => $form]);
    }
}
