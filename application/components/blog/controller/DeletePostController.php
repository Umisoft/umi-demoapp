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
use application\model\UserModel;
use umi\form\IFormAware;
use umi\form\TFormAware;
use umi\hmvc\component\request\IComponentRequest;
use umi\hmvc\controller\type\BaseController;
use umi\hmvc\exception\http\HttpException;
use umi\hmvc\exception\http\HttpForbidden;
use umi\i18n\ILocalizable;
use umi\i18n\TLocalizable;
use umi\orm\persister\IObjectPersisterAware;
use umi\orm\persister\TObjectPersisterAware;

/**
 * Контроллер удаления поста блога.
 */
class DeletePostController extends BaseController implements IObjectPersisterAware, IFormAware, ILocalizable
{
    use TFormAware;
    use TObjectPersisterAware;
    use TLocalizable;

    /**
     * @var UserModel $userModel модель пользователей
     */
    protected $userModel;
    /**
     * @var PostModel $postModel модель постов блога
     */
    protected $postModel;

    /**
     * Конструктор.
     * @param UserModel $userModel
     * @param PostModel $postModel
     */
    public function __construct(UserModel $userModel, PostModel $postModel)
    {
        $this->postModel = $postModel;
        $this->userModel = $userModel;
    }

    /**
     * {@inheritdoc}
     */
    public function __invoke(IComponentRequest $request)
    {
        if (!$this->userModel->isAuthenticated()) {
            throw new HttpForbidden("Unauthorized access.");
        }

        $form = $this->createForm(require dirname(__DIR__) . '/form/deletePost.php');

        if ($request->getMethod() == IComponentRequest::POST) {
            $form->setData(
                $request->getParams(IComponentRequest::POST)
                    ->toArray()
            );

            if (!$form->isValid()) {
                throw new HttpException(
                    HttpException::HTTP_INTERNAL_SERVER_ERROR,
                    'Cannot delete post. Invalid form sent.'
                );
            }

            $data = $form->getData();
            $postId = isset($data['id']) ? $data['id'] : false;

            $this->postModel->deletePost($postId);
            $this->getObjectPersister()
                ->commit();

            return $this->createDisplayResponse('delete', []);
        }

        throw new HttpException(
            HttpException::HTTP_INTERNAL_SERVER_ERROR,
            $this->translate('Cannot delete post. Invalid form sent.')
        );
    }
}
