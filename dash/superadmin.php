<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Connexion</title>
    <link rel="stylesheet" href="assets/stylesuper.css" />
    <script src="https://kit.fontawesome.com/d98f6633b8.js" crossorigin="anonymous"></script>
</head>
<?php
require_once("../connexion.php");

$error = "";

if (isset($_POST['button_con'])) {
    $login = isset($_POST['username']) ? trim($_POST['username']) : null;
    $password = isset($_POST['password']) ? trim($_POST['password']) : null;
    
    if (!empty($login) && !empty($password)) {
        try {
            $con = Connexion::getInstance()->getConnexion(); $sql = "SELECT *
  FROM superadmin WHERE login = :login AND mot_de_passe = :password"; $stmt
  = $con->prepare($sql); $stmt->execute(['login' => $login, 'password' =>
  $password]); if ($stmt->rowCount() > 0) { session_start(); $_SESSION['user'] =
  $login; header("Location: ../dash/ajout_admin.php"); exit; } else { $error = "Login ou
  mot de passe incorrect !"; 
  echo " Accès refusé ! Veuillez contacter un Superadmin si vous êtes admin " . "<br>";} } catch (PDOException $e) { $error = "Erreur lors
  de la connexion : " . $e->getMessage(); } } else { $error = "Veuillez remplir
  tous les champs !"; } } ?>

<body>
    <div class="container">
        <div class="right-section">
            <form action="superadmin.php" method="POST" class="login-form">
                <h2>Super<span class="superspan">Admin</span></h2>
                <label for="message" id="message"></label>

                <div class="input-container">
                    <input type="text" id="username" name="username" placeholder="SuperAdmin name" required />
                    <i class="fa-regular fa-user"></i>
                </div>

                <div class="input-container">
                    <input type="password" id="password" name="password" placeholder="SuperAdmin password" required />
                    <i class="fa-regular fa-eye" id="eyes"></i>
                </div>

                <button type="submit" class="submit-btn" id="send" name="button_con" style="background-color:#ff2e00 ">
                    Se connecter
                </button>
            </form>
        </div>
    </div>

    <script src="assets/style.js"></script>
    <script>
    document
        .getElementById("send")
        .addEventListener("click", function(event) {
            const username = document.getElementById("username").value.trim();
            const password = document.getElementById("password").value.trim();
            const message = document.getElementById("message");

            if (!username || !password) {
                event.preventDefault();
                message.textContent = "Veuillez remplir tous les champs !";
                message.style.color = "white";
                message.style.backgroundColor = "red";
                message.style.marginbottom = "10px";
                message.style.padding = "10px";
                message.style.borderRadius = "5px";
                message.style.display = "block";
            }
            setTimeout(function() {
                message.style.display = "none";
            }, 2000);
        });
    </script>
</body>

</html>