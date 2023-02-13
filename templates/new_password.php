<?php
session_start();

$dsn = "mysql:host=" . DB_HOSTNAME . ";dbname=" . DB_DATABASE;
$db = new PDO($dsn, DB_USERNAME, DB_PASSWORD);

if (isset($_GET["token"]) && !isset($_SESSION["email"])) {
    $token = trim(strip_tags($_GET["token"]));
    $query = $db->prepare("SELECT email FROM password_reset WHERE token LIKE :token");
    $query->bindParam(":token", $token);
    $query->execute();
    $result = $query->fetch();

    if (!empty($result)) {
        $_SESSION["email"] = $result["email"];
    } else {
        header("Location: index.php");
    }
} else if (isset($_SESSION["email"]) && isset($_POST["password"])) {
    $password = trim(strip_tags($_POST["password"]));
    $hash = password_hash($password, PASSWORD_DEFAULT);
    $query = $db->prepare("UPDATE users SET password = :password WHERE email LIKE :email");
    $query->bindParam(":password", $hash);
    $query->bindParam(":email", $_SESSION["email"]);

    if ($query->execute()) {
        session_destroy();
        header("Location: index.php?page=login");
    }
} else {
    header("Location: index.php");
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Nouveau mot de passe</title>
    <link rel="stylesheet" href="../public/assets/css/main.css">
    <link rel="stylesheet" href="../public/assets/css/login.css">
</head>
<body>
    <main class="container">
        <img src="../public/assets/img/telefoot-color-bg-01.svg" alt="">
        <h1>Nouveau mot de passe</h1>
        <form action="" method="post">
            <div class="form-group">
                <label for="inputPassword"></label>
                <input type="password" name="password" id="inputPassword" placeholder="Nouveau mot de passe">
            </div>
            <div class="btn-submit">
                <input type="submit" value="Envoyer">
            </div>
        </form>
    </main>
</body>
</html>