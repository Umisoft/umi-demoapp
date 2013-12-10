<?php
/**
 * UMI.Framework (http://umi-framework.ru/)
 *
 * @link      http://github.com/Umisoft/framework for the canonical source repository
 * @copyright Copyright (c) 2007-2013 Umisoft ltd. (http://umisoft.ru/)
 * @license   http://umi-framework.ru/license/bsd-3 BSD-3 License
 */

namespace application\model;

use umi\authentication\IAuthentication;
use umi\authentication\IAuthenticationAware;
use umi\authentication\IAuthenticationFactory;
use umi\authentication\TAuthenticationAware;
use umi\hmvc\model\IModel;

/**
 * Модель пользователей.
 */
class UserModel implements IAuthenticationAware, IModel
{
    use TAuthenticationAware;

    /**
     * @var IAuthentication $auth менеджер авторизации.
     */
    protected $auth;

    /**
     * Производит попытку авторизации в системе.
     * @param string $email email пользователя
     * @param string $password пароль
     * @return bool результат авторизации
     */
    public function login($email, $password)
    {
        if ($this->isAuthenticated()) {
            return false;
        }

        $provider = $this->createAuthProvider(
            IAuthenticationFactory::PROVIDER_SIMPLE,
            [
                'username' => $email,
                'password' => $password
            ]
        );

        return $this->getAuthManager()
            ->authenticate($provider)
            ->isSuccessful();
    }

    /**
     * Возвращает имя авторизованного пользователя.
     * @return object|null авторизованный пользователь.
     */
    public function getCurrentUser()
    {
        return $this->getAuthManager()
            ->getStorage()
            ->getIdentity();
    }

    /**
     * Проверяет, авторизован ли пользователь в системе.
     * @return bool
     */
    public function isAuthenticated()
    {
        return $this->getAuthManager()
            ->isAuthenticated();
    }

    /**
     * Уничтожает данные текущей авторизации.
     * @return void
     */
    public function logout()
    {
        $this->getAuthManager()
            ->forget();
    }

    /**
     * Возвращает менеджер аутентификации.
     * @return IAuthentication
     */
    protected function getAuthManager()
    {
        if (!$this->auth) {
            $this->auth = $this->createAuthManager();
        }

        return $this->auth;
    }
}