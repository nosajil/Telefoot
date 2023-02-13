<?php 
class ResetView
{
    private $controller;
    private $template;

    public function __construct(ResetController $controller)
    {
        $this->controller = $controller;
        $this->template = DIR_TEMPLATE . "reset_password.php";
    }

    public function render()
    {
        require($this->template);
    }
}