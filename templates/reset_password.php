<?php
require("../vendor/autoload.php");
use PHPMailer\PHPMailer\PHPMailer;
// define("HOST", "http://localhost/telefoot");

if (isset($_POST["email"])) {
    $email = trim(strip_tags($_POST["email"]));

    $token = bin2hex(random_bytes(50));

    $dsn = "mysql:host=" . DB_HOSTNAME . ";dbname=" . DB_DATABASE;
    $db = new PDO($dsn, DB_USERNAME, DB_PASSWORD);

    $query = $db->prepare('INSERT INTO password_reset (email, token) VALUES (:email, :token)');
    $query->bindParam(":email", $email);
    $query->bindParam(":token", $token);

    if ($query->execute()) {
        $phpmailer = new PHPMailer();
        $phpmailer->isSMTP();
        $phpmailer->Host = 'sandbox.smtp.mailtrap.io';
        $phpmailer->SMTPAuth = true;
        $phpmailer->Port = 2525;
        $phpmailer->Username = 'd22ad0940dd1b1';
        $phpmailer->Password = '526d10a896c5d2';

        $phpmailer->From = "telefoot@contact.fr";
        $phpmailer->FromName = "Team Telefoot";

        $phpmailer->addAddress($email);
        $phpmailer->isHTML();
        $phpmailer->CharSet = "UTF-8";
        $phpmailer->Subject = "Réinitialisation du mot de passe";
        $phpmailer->Body = "<a href=\"". HOST ."index.php?page=new_password&token={$token}\">Réinitialisation du mot de passe</a>";
        $phpmailer->send();
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mot de passe oublié</title>
    <link rel="stylesheet" href="../public/assets/css/main.css">
    <link rel="stylesheet" href="../public/assets/css/login.css">
</head>
<body>
    <main class="container">
        <img src="../public/assets/img/telefoot-color-bg-01.svg" alt="">
        <h1>Réinitialiser le mot de passe</h1>
        <p>Pour réinitialiser votre mot de passe, entrez l'e-mail de votre compte</p>
        <form action="" method="post">
            <div class="form-group">
                <label for="inputEmail"></label>
                <input type="email" name="email" id="inputEmail" placeholder="Email">
            </div>
            <div class="btn-submit">
                <input type="submit" value="Envoyer">
            </div>
        </form>
        <div class="link_wrapper">
            <p>Nous vous enverrons un lien pour réinitialiser votre mot de passe</p>
        </div>

    </main>
</body>
</html>