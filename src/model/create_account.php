<?php
class ConnectModel
{
    public $db;
    public $id;
    public $firstname;
    public $lastname;
    public $email;
    public $cemail;
    public $password;
    public $cpassword;

    public function __construct(PDO $db)
    {
        
        $this->db = $db;
        if (!empty($_POST)) {
            $this->firstname = trim(strip_tags($_POST["firstname"]));
            $this->lastname = trim(strip_tags($_POST["lastname"]));
            $this->email = trim(strip_tags($_POST["email"]));
            $this->cemail = trim(strip_tags($_POST["cemail"]));
            $this->password = trim(strip_tags($_POST["password"]));
            $this->cpassword = trim(strip_tags($_POST["cpassword"]));
        }
    }
}