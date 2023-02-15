<?php

class ConnectView
{
    private $controller;
    private $template;

    public function __construct(ConnectController $controller)
    {
        $this->controller = $controller;
        $this->template = DIR_TEMPLATE . "create_account.php";
    }

    public function render()
    {
        $message = "";
        if (!empty($_POST)) {
            $data = $this->controller->getDataForm();

            if (!$this->controller->validateForm()) {
                $errors["message"] = "Le mot de passe de correspond pas ou doit contenir 8 caractères minimum, une lettre majuscule, une lettre minuscule, un chiffre et un caractère spécial";
            }

            if (empty($errors)) {
                if ($this->controller->addUser()) {
                    header("Location: login");
                } else {
                    $message = "Erreur de bdd";
                }
            } else {
                $message = "<div class=\"alert alert-danger\">{$errors["message"]}</div>";
            }
        }

        require($this->template);
    }
}