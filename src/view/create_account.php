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
        require($this->template);
    }
}