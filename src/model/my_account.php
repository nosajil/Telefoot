<?php 

class AccountModel
{
    public $db;
    public $tv;

    public function __construct(PDO $db)
    {
        $this->db = $db;
    }
}