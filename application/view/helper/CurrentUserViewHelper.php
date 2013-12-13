<?php
/**
 * UMI.Framework (http://umi-framework.ru/)
 *
 * @link      http://github.com/Umisoft/framework for the canonical source repository
 * @copyright Copyright (c) 2007-2013 Umisoft ltd. (http://umisoft.ru/)
 * @license   http://umi-framework.ru/license/bsd-3 BSD-3 License
 */

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
