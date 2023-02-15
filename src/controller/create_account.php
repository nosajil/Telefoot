<?php

class ConnectController
{
    private $model;

    public function __construct(ConnectModel $model)
    {
        $this->model = $model;
    }

    public function getDataForm() {
        return array(
            "email" => $this->model->email,
            "cemail" => $this->model->cemail,
            "password" => $this->model->password,
            "cpassword" => $this->model->cpassword,
            "firstname" => $this->model->firstname,
            "lastname" => $this->model->lastname
        );
    }

    public function validateForm() {
        if (($this->model->email != $this->model->cemail) || ($this->model->password != $this->model->cpassword)) {
            return false;
        } else {
            
            $uppercase = preg_match("/[A-Z]/", $this->model->password);
            $lowercase = preg_match("/[a-z]/", $this->model->password);
            $number = preg_match("/[0-9]/", $this->model->password);

            $specialChar = preg_match("/[^a-zA-Z0-9]/", $this->model->password);
        
            if (!$uppercase || !$lowercase || !$number || strlen($this->model->password) < 8) {
                return false;
            }

            // if ($this->model->password != $this->model->cpassword) {
            //     $errors["cpassword"] = "Veuillez entrer des mots de passes identiques !";
            // }

            // if (!filter_var($this->model->email, FILTER_VALIDATE_EMAIL)) {
            //     $errors["email"] = "L'email n'est pas valide";
            // }

            // if ($this->model->email != $this->model->cemail) {
            //     $errors["cemail"] = "Veuillez entrer des emails identiques !";
            // }
        
        }
        
        return true;
    }

    public function addUser() : bool {
        $hash = password_hash($this->model->password, PASSWORD_DEFAULT);

        $query = $this->model->db->prepare("INSERT INTO users (firstname, lastname, email, password) VALUES (:firstname, :lastname, :email, :password)");
        $query->bindParam(":firstname", $this->model->firstname);
        $query->bindParam(":lastname", $this->model->lastname);
        $query->bindParam(":email", $this->model->email);
        $query->bindParam(":password", $hash);

        if ($query->execute()) {
            return true;
        } else {
            return false;
        }
    }
}