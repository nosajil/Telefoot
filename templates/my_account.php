<?php
session_start();

if (!isset($_SESSION["user"]) || $_SESSION["user"]["ip"] != $_SERVER["REMOTE_ADDR"]) {
    header("Location: index.php?page=login");
}
$message = "";

$dsn = "mysql:host=" . DB_HOSTNAME . ";dbname=" . DB_DATABASE;
$db = new PDO($dsn, DB_USERNAME, DB_PASSWORD);

$query = $db->query("SELECT * FROM chaines WHERE chaines.tv = \"chaine\"");
$query2 = $db->query("SELECT * FROM chaines WHERE chaines.tv = \"replay\"");
$query3 = $db->query("SELECT * FROM clubs WHERE clubs.ligue = 1");
$query4 = $db->query("SELECT * FROM clubs WHERE clubs.ligue = 2");
$chaines = $query->fetchAll(PDO::FETCH_ASSOC);
$replays = $query2->fetchAll(PDO::FETCH_ASSOC);
$ligue1 = $query3->fetchAll(PDO::FETCH_ASSOC);
$ligue2 = $query4->fetchAll(PDO::FETCH_ASSOC);

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../public/assets/css/main.css">
    <link rel="stylesheet" href="../public/assets/css/my_account.css">
    <title>Mon compte</title>
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
        <div class="account_wrapper">
            <h2>Chaines</h2>
            <div class="channels_wrapper channel_display">
                <?php
                    foreach ($chaines as $chaine) {
                        ?>
                        <div class="chaine">
                                <img src="../public/assets/img/channels/<?= $chaine["image"] ?>" alt="">
                        </div>
                        <?php
                    }
                ?>
            </div>
            <h2>Replays</h2>
            <div class="replays_wrapper channel_display">
                <?php
                    foreach ($replays as $replay) {
                        ?>
                        <div class="chaine">
                            <img src="../public/assets/img/replay/<?= $replay["image"] ?>" alt="">
                        </div>
                        <?php
                    }
                ?>
            </div>
            <h2>Ligue 1</h2>
            <div class="ligue_wrapper channel_display">
                <?php
                    foreach ($ligue1 as $club) {
                        ?>
                        <div class="club">
                            <img src="../public/assets/img/clubs/<?= $club["image"] ?>" alt="">
                        </div>
                        <?php
                    }
                ?>
            </div>
            <h2>Ligue 2</h2>
            <div class="ligue_wrapper channel_display">
                <?php
                    foreach ($ligue2 as $club) {
                        ?>
                        <div class="club">
                            <img src="../public/assets/img/clubs/<?= $club["image"] ?>" alt="">
                        </div>
                        <?php
                    }
                ?>
            </div>
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