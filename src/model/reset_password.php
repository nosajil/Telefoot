<?php 

class ResetModel
{
    public $db;
    public $tv;

    public function __construct(PDO $db)
    {
        $this->db = $db;
    }
}

