<?php
$message = "";
if (!empty($_POST)) {
    $email = trim(strip_tags($_POST["email"]));
    $password = trim(strip_tags($_POST["password"]));
    
    // require("../config/index.php");
    $dsn = "mysql:host=" . DB_HOSTNAME . ";dbname=" . DB_DATABASE;
    $db = new PDO($dsn, DB_USERNAME, DB_PASSWORD);
    $query = $db->prepare('SELECT * FROM users WHERE email LIKE :email');
    $query->bindParam(':email', $email);
    $query->execute();
    $result = $query->fetch();

    if (!empty($result) && password_verify($password, $result['password'])) {
        session_start();
        $_SESSION["user"] = [
            "id" => $result["id"],
            "firstname" => $result["firstname"],
            // "lastname" => $result["lastname"],
            // "email" => $result["email"],
            "ip" => $_SERVER["REMOTE_ADDR"]
        ];

        header("Location: index.php?page=my_account");
    } else {
        $message = "<p>Impossible de se connecter avec les informations saisies, veuillez réessayer</p>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Connexion au compte</title>
    <link rel="stylesheet" href="../public/assets/css/main.css">
    <link rel="stylesheet" href="../public/assets/css/login.css">
</head>
<body>
    <main class="container">
        <img src="../public/assets/img/telefoot-color-bg-01.svg" alt="">
        <form action="" method="post">
            <div class="form-group">
                <label for="inputEmail"></label>
                <input type="email" name="email" id="inputEmail" placeholder="Email">
            </div>
            <div class="form-group">
                <label for="inputPassword"></label>
                <input type="password" name="password" id="inputPassword" placeholder="Mot de passe">
            </div>
            <?= $message ?>
            <div class="btn-submit">
                <input type="submit" value="ouvrir une session">
            </div>
        </form>
        <div class="link_wrapper">
            <a href="index.php?page=reset_password">Vous avez oubliez votre mot de passe ?</a>
            <hr>
            <p>Vous ne possèdez toujours pas de compte ?</p>
            <div class="btn-submit">
                <a href="index.php?page=create_account">Créer un compte</a>
            </div>
        </div>

    </main>
</body>
</html>