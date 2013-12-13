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
use application\components\blog\model\TagModel;
use application\model\UserModel;
use umi\form\IForm;
use umi\form\IFormAware;
use umi\form\TFormAware;
use umi\hmvc\component\request\IComponentRequest;
use umi\hmvc\component\response\IComponentResponse;
use umi\hmvc\controller\type\BaseController;
use umi\hmvc\exception\http\HttpForbidden;
use umi\orm\persister\IObjectPersisterAware;
use umi\orm\persister\TObjectPersisterAware;

/**
 * Контроллер добавления нового поста.
 */
class AddPostController extends BaseController implements IFormAware, IObjectPersisterAware
{
    use TFormAware;
    use TObjectPersisterAware;

    /**
     * @var PostModel $postModel
     */
    protected $postModel;
    /**
     * @var TagModel $tagModel
     */
    protected $tagModel;
    /**
     * @var UserModel $userModel
     */
    protected $userModel;

    /**
     * Конструктор.
     * @param PostModel $postModel
     * @param TagModel $tagModel
     * @param UserModel $userModel
     */
    public function __construct(PostModel $postModel, TagModel $tagModel, UserModel $userModel)
    {
        $this->postModel = $postModel;
        $this->tagModel = $tagModel;
        $this->userModel = $userModel;
    }

    /**
     * {@inheritdoc}
     */
    public function __invoke(IComponentRequest $request)
    {
        $user = $this->getCurrentUser();

        $form = $this->createForm(require dirname(__DIR__) . '/form/post.php');

        if ($request->getMethod() == IComponentRequest::POST) {
            $form->setData(
                $request->getParams(IComponentRequest::POST)
                    ->toArray()
            );

            if (!$form->isValid()) {
                return $this->showForm($form);
            }

            $data = $form->getData();

            $post = $this->postModel->addPost($user->guid);
            $this->tagModel->setTagsToPost($post, explode(',', $data['tags']));

            foreach ($data as $fieldName => $value) {
                if ($post->hasProperty($fieldName) && $fieldName != 'tags') {
                    $post[$fieldName] = $value;
                }
            }

            $this->getObjectPersister()
                ->commit();

            return $this->createDisplayResponse('complete', []);
        }

        return $this->showForm($form);
    }

    /**
     * Показывает форму добавления нового поста в блог.
     * @param IForm $form форма
     * @return IComponentResponse
     */
    protected function showForm(IForm $form)
    {
        return $this->createDisplayResponse(
            'postAdd',
            [
                'form' => $form
            ]
        );
    }

    /**
     * Возвращает текущего пользователя системы.
     * @return object
     * @throws HttpForbidden если пользователь не авторизован
     */
    protected function getCurrentUser()
    {
        if (!$this->userModel->isAuthenticated()) {
            throw new HttpForbidden("Unauthorized access.");
        } else {
            return $this->userModel->getCurrentUser();
        }
    }
}
