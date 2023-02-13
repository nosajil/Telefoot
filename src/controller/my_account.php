<?php

class AccountController
{
    private $model;

    public function __construct(AccountModel $model)
    {
        $this->model = $model;
    }

    public function getChannels()
    {
        $query = $this->model->db->prepare('SELECT * FROM chaines WHERE tv = "chaine"');
        $query->bindParam("chaine", $this->model->tv, PDO::PARAM_STR);
        $query->execute();
        $channel = $query->fetch();

        return $channel;
    }
}