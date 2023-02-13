<?php

$page = "home";
if (isset($_GET["page"])) {
    $page = $_GET["page"];
}

$pages = array(
    "home" => array(
        "model" => "HomeModel",
        "view" => "HomeView",
        "controller" => "HomeController"
    ),
    "create_account" => array(
        "model" => "ConnectModel",
        "view" => "ConnectView",
        "controller" => "ConnectController"
    ),
    "login" => array(
        "model" => "LoginModel",
        "view" => "LoginView",
        "controller" => "LoginController"
    ),
    "my_account" => array(
        "model" => "AccountModel",
        "view" => "AccountView",
        "controller" => "AccountController"
    ),
    "logout" => array(
        "model" => "LogoutModel",
        "view" => "LogoutView",
        "controller" => "LogoutController"
    ),
    "reset_password" => array(
        "model" => "ResetModel",
        "view" => "ResetView",
        "controller" => "ResetController"
    ),
    "new_password" => array(
        "model" => "NewPasswordModel",
        "view" => "NewPasswordView",
        "controller" => "NewPasswordController"
    )
);

$find = false;
foreach ($pages as $key => $value) {
    if ($page === $key) {
        $find = true;

        $model = $value["model"];
        $view = $value["view"];
        $controller = $value["controller"];
    }
}

require("../config/index.php");

$dsn = "mysql:host=" . DB_HOSTNAME . ";dbname=" . DB_DATABASE;
$db = new PDO($dsn, DB_USERNAME, DB_PASSWORD);

if ($find) {
    require(DIR_MODEL . $page . ".php");
    require(DIR_CONTROLLER . $page . ".php");
    require(DIR_VIEW . $page . ".php");

    $pageModel = new $model($db);
    $pageController = new $controller($pageModel);
    $pageView = new $view($pageController);

    $pageView->render();
}

