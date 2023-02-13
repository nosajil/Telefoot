<?php
class ConnectController
{
    private $model;

    public function __construct(ConnectModel $model)
    {
        $this->model = $model;
    }

}