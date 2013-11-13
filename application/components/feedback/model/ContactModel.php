<?php
namespace application\components\feedback\model;

/**
 * Модель обратной связи.
 * @package App\Contact
 */
class ContactModel
{
    /**
     * @var array $adminMail email администратора
     */
    protected $adminMail = ['administrator@demo.local', 'Administrator'];
    /**
     * @var array $appMail email приложения
     */
    protected $appMail = ['no-reply@demo.local', 'Demo application'];

    /**
     * Отправляет данные о созданном тикете администратору и пользователю.
     * @param array $data данные тикета
     * @return bool
     */
    public function sendContact(array $data)
    {
        return $this->sendUserNotification($data) && $this->sendAdminNotification($data);
    }

    /**
     * Отправляет оповещение пользователю, создавшему заявку.
     * @param array $data данные тикета
     * @return bool
     */
    protected function sendUserNotification(array $data)
    {
        // todo:
    }

    /**
     * Отправляет оповещение администратору сайта.
     * @param array $data данные тикета
     * @return bool
     */
    protected function sendAdminNotification(array $data)
    {
        // todo:
    }
}