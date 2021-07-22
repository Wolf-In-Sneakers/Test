<?php


namespace Shop\core;

use Shop\models\Auth\Auth;
use Shop\models\Basket\Basket;


abstract class Controller
{
    protected View $view;

    protected array $errors;

    public function __construct()
    {
        $this->view = new View();

        $this->errors = [];
    }


}