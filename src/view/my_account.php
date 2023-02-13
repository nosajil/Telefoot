<?php 
class AccountView
{
    private $controller;
    private $template;

    public function __construct(AccountController $controller)
    {
        $this->controller = $controller;
        $this->template = DIR_TEMPLATE . "my_account.php";
    }

    public function render()
    {
        require($this->template);
    }
}