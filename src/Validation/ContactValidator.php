<?php

namespace App\Validation;

/**
 * Класс ContactValidator валидирует данные контакта.
 */
class ContactValidator
{
    /**
     * @var array Массив ошибок валидации
     */
    private $errors = [];

    /**
     * Валидирует имя контакта.
     *
     * @param string $name Имя для валидации
     */
    public function validateName($name)
    {
        if (empty($name)) {
            $this->errors[] = "Имя не должно быть пустым.";
        } elseif (strlen($name) < 3) {
            $this->errors[] = "Имя должно содержать минимум 3 символа.";
        }
    }

    /**
     * Валидирует номер телефона контакта.
     *
     * @param string $phone Номер телефона для валидации
     */
    public function validatePhone($phone)
    {
        if (empty($phone)) {
            $this->errors[] = "Номер телефона не должен быть пустым.";
        } elseif (!preg_match('/^\+7 \(\d{3}\) \d{3}-\d{2}-\d{2}$/', $phone)) {
            $this->errors[] = "Номер телефона должен быть в формате +7 (XXX) XXX-XX-XX.";
        }
    }

    /**
     * Возвращает массив ошибок валидации.
     *
     * @return array Массив ошибок
     */
    public function getErrors()
    {
        return $this->errors;
    }

    /**
     * Проверяет, есть ли ошибки валидации.
     *
     * @return bool true если есть ошибки, иначе false
     */
    public function hasErrors()
    {
        return !empty($this->errors);
    }

    /**
     * Валидирует имя и номер телефона контакта.
     *
     * @param string $name Имя для валидации
     * @param string $phone Номер телефона для валидации
     */
    public function validate($name, $phone)
    {
        $this->validateName($name);
        $this->validatePhone($phone);
    }
}
