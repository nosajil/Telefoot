<?php if (!empty($_POST)) {
            $errors = array();
        
            $firstname = trim(strip_tags($_POST["firstname"]));
            $lastname = trim(strip_tags($_POST["lastname"]));
            $email = trim(strip_tags($_POST["email"]));
            $cemail = trim(strip_tags($_POST["cemail"]));
            $password = trim(strip_tags($_POST["password"]));
            $cpassword = trim(strip_tags($_POST["cpassword"]));
        
            if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                $errors["email"] = "L'email n'est pas valide";
            }

            if ($email != $cemail) {
                $errors["cemail"] = "Veuillez entrer des emails identiques !";
            }
        
            // PASSWORD CONDITIONS
            $uppercase = preg_match("/[A-Z]/", $password);
            $lowercase = preg_match("/[a-z]/", $password);
            $number = preg_match("/[0-9]/", $password);
        
            if (!$uppercase || !$lowercase || !$number || strlen($password) < 8) {
                $errors["password"] = "Le mot de passe doit contenir 8 caractères minimum, une lettre majuscule, un chiffre et un caractère spécial";
            }

            if ($password != $cpassword) {
                $errors["cpassword"] = "Veuillez entrer des mots de passes identiques !";
            }
        
            if (empty($errors)) {
                $hash = password_hash($password, PASSWORD_DEFAULT);
                require("../config/index.php");
                $dsn = "mysql:host=" . DB_HOSTNAME . ";dbname=" . DB_DATABASE;
                $db = new PDO($dsn, DB_USERNAME, DB_PASSWORD);
                $query = $db->prepare("INSERT INTO users (firstname, lastname, email, password) VALUES (:firstname, :lastname, :email, :password)");
                $query->bindParam(":firstname", $firstname);
                $query->bindParam(":lastname", $lastname);
                $query->bindParam(":email", $email);
                $query->bindParam(":password", $hash);
        
                if ($query->execute()) {
                    header("Location: index.php?page=login");
                } else {
                    $errors["execute"] = "Un problème est survenu veuillez réessayer ultérieusement";
                    echo "erreur ";
                }
            }
        }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Création de compte</title>
    <link rel="stylesheet" href="../public/assets/css/main.css">
    <link rel="stylesheet" href="../public/assets/css/create_account.css">
</head>
<body>
    <header>
        <img src="../public/assets/img/telefoot-color-bg-01.svg" alt="Telefoot - La chaine du foot" />
        <nav>
            <ul>
                <a href="index.php"><li>Home</li></a>
                <a href="index.php?page=my_account"><li>Telefoot Bar</li></a>
            </ul>
            <div class="section-login">
                <?php
                if (isset($_SESSION["user"])) {
                    ?>
                    <p class="welcome-message">Bienvenue <?= $_SESSION['user']['firstname'] ?></p>
                    
                    <div class="suscribe">
                        <a href="">live</a>
                    </div>
                    <div class="btn-login">
                        <a href="index.php?page=logout">Se déconnecter</a>
                    </div>
                    <?php
                } else {
                    ?>
                    <div class="suscribe">
                        <a href="">S'abonner</a>
                    </div>
                    <div class="btn-login">
                        <a href="index.php?page=login">Se connecter</a>
                    </div>
                    <?php
                }
            ?>
            </div>
        </nav>
    </header>
    <main>
        <div class="account_wrapper container">
            <h1>Créer un compte</h1>
            <form action="" method="post">
                <div class="form-group">
                    <label for="inputEmail">Email *</label>
                    <input type="email" name="email" id="inputEmail" value="<?= $email ?? "" ?>">
                    <?php
                        if (isset($errors["email"])) {
                            ?>
                            <p class="error"><?= $errors["email"] ?></p>
                            <?php
                        }
                    ?>
                </div>
                <div class="form-group">
                    <label for="inputConfirmEmail">Confirmer email *</label>
                    <input type="email" name="cemail" id="inputConfirmEmail" value="<?= $cemail ?? "" ?>">
                    <!-- Condition pour confirmer l'email -->

                    <p class="error"><?= !empty($errors["cemail"]) ? $errors["cemail"] : "" ?></p>

                </div>
                <div class="form-group">
                    <label for="inputPassword">Mot de passe *</label>
                    <input type="password" name="password" id="inputPassword" value="<?= $password ?? "" ?>">
                    <?php 
                        if (isset($errors["password"]) ) {
                            ?>
                            <p class="error"><?= $errors["password"] ?></p>
                            <?php
                        }
                    ?>
                </div>
                <div class="form-group">
                    <label for="inputConfirmPassword">Confirmer le mot de passe *</label>
                    <input type="password" name="cpassword" id="inputConfirmPassword">
                    <!-- Condition pour confirmer le mot de passe -->

                    <p class="error"><?= !empty($errors["cpassword"]) ? $errors["cpassword"] : "" ?></p>

                </div>
                <div class="form-group">
                    <label for="inputFirstname">Prénom *</label>
                    <input type="text" name="firstname" id="inputFirstname" value="<?= $firstname ?? "" ?>">
                </div>
                <div class="form-group">
                    <label for="inputLastname">Nom *</label>
                    <input type="text" name="lastname" id="inputLastname" value="<?= $lastname ?? "" ?>">
                </div>
                <div class="btn-submit">
                    <p>*Champs obligatoires</p>
                    <input type="submit" value="Envoyer">
                </div>
            </form>
        </div>

    </main>
    <footer>
        <div class="container">
            <div class="footer-brand">
                <img src="../public/assets/img/telefoot-mono-white.svg" alt="" />
            </div>
            <div class="footer-list">
                <ul>
                    <li>Home</li>
                    <li>Telefoot Bar</li>
                </ul>
                <ul>
                    <li>FAQ</li>
                    <li>FAQ Bar</li>
                    <li>Mentions légales</li>
                    <li>Conditions d'utilisation</li>
                    <li>Politique de cookies</li>
                </ul>
                <ul>
                    <li>Social</li>
                    <li>Facebook</li>
                    <li>Twitter</li>
                    <li>Instagram</li>
                </ul>
            </div>
            <div class="footer-copy">
                <p>&copy; 2020 Telefoot <span>La chaine du foot</span></p>
            </div>
        </div>
    </footer>
</body>
</html>