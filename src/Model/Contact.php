<?php

namespace App\Model;

/**
 * Класс Contact представляет контакт с именем и номером телефона.
 */
class Contact
{
    /**
     * @var string Имя контакта
     */
    private $name;

    /**
     * @var string Номер телефона контакта
     */
    private $phone;

    /**
     * Конструктор класса Contact.
     *
     * @param string $name Имя контакта
     * @param string $phone Номер телефона контакта
     */
    public function __construct($name, $phone)
    {
        $this->name = $name;
        $this->phone = $phone;
    }

    /**
     * Возвращает имя контакта.
     *
     * @return string Имя контакта
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Возвращает номер телефона контакта.
     *
     * @return string Номер телефона контакта
     */
    public function getPhone()
    {
        return $this->phone;
    }
}
