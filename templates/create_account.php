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
                <a href="my_account"><li>Telefoot Bar</li></a>
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
                        <a href="logout">Se déconnecter</a>
                    </div>
                    <?php
                } else {
                    ?>
                    <div class="suscribe">
                        <a href="">S'abonner</a>
                    </div>
                    <div class="btn-login">
                        <a href="login">Se connecter</a>
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
            <?= $message ?>
            <form action="" method="post">
                <div class="form-group">
                    <label for="inputEmail">Email *</label>
                    <input type="email" name="email" id="inputEmail" value="<?= isset($data["email"]) ? $data["email"] : "" ?>" 
                    required />
                </div>
                <div class="form-group">
                    <label for="inputConfirmEmail">Confirmer email *</label>
                    <input type="email" name="cemail" id="inputConfirmEmail" value="<?= isset($data["cemail"]) ? $data["cemail"] : "" ?>" required />
                </div>
                <div class="form-group">
                    <label for="inputPassword">Mot de passe *</label>
                    <input type="password" name="password" id="inputPassword" value="<?= isset($data["password"]) ? $data["password"] : "" ?>" required />
                </div>
                <div class="form-group">
                    <label for="inputConfirmPassword">Confirmer le mot de passe *</label>
                    <input type="password" name="cpassword" id="inputConfirmPassword" value="<?= isset($data["cpassword"]) ? $data["cpassword"] : "" ?>" required />
                </div>
                <div class="form-group">
                    <label for="inputFirstname">Prénom *</label>
                    <input type="text" name="firstname" id="inputFirstname" value="<?= isset($data["firstname"]) ? $data["firstname"] : "" ?>" required />
                </div>
                <div class="form-group">
                    <label for="inputLastname">Nom *</label>
                    <input type="text" name="lastname" id="inputLastname" value="<?= isset($data["lastname"]) ? $data["lastname"] : "" ?>">
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