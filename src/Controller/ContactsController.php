<?php

namespace App\Controller;

use App\Model\Contact;
use App\Model\ContactsList;
use App\Validation\ContactValidator;

/**
 * Класс ContactsController обрабатывает запросы для управления контактами.
 */
class ContactsController
{
    /**
     * @var ContactsList Список контактов
     */
    private $contactsList;

    /**
     * Конструктор класса ContactsController.
     * Инициализирует список контактов и запускает сессию.
     */
    public function __construct()
    {
        session_start();
        $this->contactsList = new ContactsList();
    }

    /**
     * Обрабатывает входящие HTTP-запросы.
     *
     * @return array Массив ошибок валидации
     */
    public function handleRequest()
    {
        $errors = [];
        if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['add_contact'])) {
            $validator = new ContactValidator();
            $validator->validate(trim($_POST['name']), trim($_POST['phone']));

            if ($validator->hasErrors()) {
                $errors = $validator->getErrors();
            } else {
                $contact = new Contact(trim($_POST['name']), trim($_POST['phone']));
                $this->contactsList->addContact($contact);
                header('Location: /');
                exit();
            }
        }

        if (isset($_GET['delete'])) {
            $this->contactsList->deleteContact(intval($_GET['delete']));
            header('Location: /');
            exit();
        }

        if (isset($_GET['sort']) && $_GET['sort'] == 'name') {
            $order = isset($_GET['order']) ? $_GET['order'] : 'asc';
            $this->contactsList->sortContactsByName($order);
        }

        return $errors;
    }

    /**
     * Возвращает список контактов.
     *
     * @return array Массив контактов
     */
    public function getContacts()
    {
        return $this->contactsList->getContacts();
    }
}
