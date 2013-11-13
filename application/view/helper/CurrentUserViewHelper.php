<?php
namespace application\view\helper;

use application\model\UserModel;

/**
 * Помошник вида, для проверки авторизации пользователя.
 */
class CurrentUserViewHelper
{
    /**
     * @var UserModel $model модель пользователей
     */
    protected $model;

    /**
     * Конструктор.
     * @param UserModel $model модель авторизации
     */
    public function __construct(UserModel $model)
    {
        $this->model = $model;
    }

    /**
     * Проверяет, авторизован ли пользователь.
     * @return bool
     */
    public function __invoke()
    {
        return $this->model->isAuthenticated() ? $this->model->getCurrentUser() : false;
    }
}
