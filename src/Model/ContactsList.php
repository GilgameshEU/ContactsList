<?php

namespace App\Model;

/**
 * Класс ContactsList управляет списком контактов.
 */
class ContactsList
{
    /**
     * @var array Массив контактов
     */
    private $contacts = [];

    /**
     * Конструктор класса ContactsList.
     * Инициализирует массив контактов из сессии.
     */
    public function __construct()
    {
        if (!isset($_SESSION['contacts'])) {
            $_SESSION['contacts'] = [];
        }
        $this->contacts = $_SESSION['contacts'];
    }

    /**
     * Добавляет новый контакт в список.
     *
     * @param Contact $contact Контакт для добавления
     */
    public function addContact(Contact $contact)
    {
        $this->contacts[] = ['name' => $contact->getName(), 'phone' => $contact->getPhone()];
        $this->save();
    }

    /**
     * Удаляет контакт из списка по индексу.
     *
     * @param int $index Индекс контакта для удаления
     */
    public function deleteContact($index)
    {
        if (isset($this->contacts[$index])) {
            unset($this->contacts[$index]);
            $this->contacts = array_values($this->contacts);
            $this->save();
        }
    }

    /**
     * Возвращает массив контактов.
     *
     * @return array Массив контактов
     */
    public function getContacts()
    {
        return $this->contacts;
    }

    /**
     * Сортирует контакты по имени.
     *
     * @param string $order Направление сортировки ('asc' или 'desc')
     */
    public function sortContactsByName($order)
    {
        if ($order === 'asc') {
            usort($this->contacts, function ($a, $b) {
                return strcmp($a['name'], $b['name']);
            });
        } elseif ($order === 'desc') {
            usort($this->contacts, function ($a, $b) {
                return strcmp($b['name'], $a['name']);
            });
        }
        $this->save();
    }

    /**
     * Сохраняет текущий список контактов в сессию.
     */
    private function save()
    {
        $_SESSION['contacts'] = $this->contacts;
    }
}
