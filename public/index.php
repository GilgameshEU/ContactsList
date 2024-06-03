<?php

require_once __DIR__ . '/../autoload.php';

use App\Controller\ContactsController;

$controller = new ContactsController();
$errors = $controller->handleRequest();
$contacts = $controller->getContacts();

include __DIR__ . '/../templates/contacts_list.php';
