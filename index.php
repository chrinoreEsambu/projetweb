<?php
require_once("connexion.php");
// partie voleeur
$error = "";

if (isset($_POST['button_con'])) {
    $login = isset($_POST['username']) ? trim($_POST['username']) : null;
    $password = isset($_POST['password']) ? trim($_POST['password']) : null;

    if (!empty($login) && !empty($password)) {
        try {
            $con = Connexion::getInstance()->getConnexion();
            $sql = "SELECT * FROM administrateurs WHERE login = :login AND mot_de_passe = :password";
            $stmt = $con->prepare($sql);
            $stmt->execute(['login' => $login, 'password' => $password]);

            if ($stmt->rowCount() > 0) {
                session_start(); // Démarre la session

                // Ajoute des variables de session avec les informations de l'utilisateur connecté
                $enreg = $stmt->fetch(PDO::FETCH_ASSOC);
                $_SESSION["user"] = $login; // Par exemple, le login
                $_SESSION["user_id"] = $enreg["idadmin"]; // Ajouter l'ID de l'administrateur ou toute autre info pertinente
                $_SESSION["user_role"] = $enreg["role"]; // Si tu as une colonne 'role' ou similaire

                header("Location: dash/dash.php"); // Redirection vers le tableau de bord
                exit;
            } else {
                $error = "Login ou mot de passe incorrect !";
            }
        } catch (PDOException $e) {
            $error = "Erreur lors de la connexion : " . $e->getMessage();
        }
    } else {
        $error = "Veuillez remplir tous les champs !";
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Connexion</title>
    <link rel="stylesheet" href="assets/style.css" />
    <script src="https://kit.fontawesome.com/d98f6633b8.js" crossorigin="anonymous"></script>
    <link rel="icon" href="assets/favicon.png" type="image/x-icon">
</head>

<body>
    <div class="container">
        <div class="left-section">
            <img src="https://via.placeholder.com/600x600" alt="Image de présentation" class="image"
                id="random-image" />
        </div>
        <div class="right-section">
            <form action="index.php" method="POST" class="login-form">
                <h2>Connexion</h2>

                <p id="message"
                    style="display: <?= empty($error) ? 'none' : 'block'; ?>; color: white; background-color: red; padding: 10px; border-radius: 5px;">
                    <?= htmlspecialchars($error) ?>
                </p>

                <div class="input-container">
                    <input type="text" id="username" name="username" placeholder="Entrez votre nom d'utilisateur"
                        required />
                    <i class="fa-regular fa-user"></i>
                </div>

                <div class="input-container">
                    <input type="password" id="password" name="password" placeholder="Entrez votre mot de passe"
                        required />
                    <i class="fa-regular fa-eye" id="eyes"></i>
                </div>

                <button type="submit" class="submit-btn" id="send" name="button_con">
                    Se connecter
                </button>

                <div class="footer">
                    <a href="oops.html">Créer un compte</a>
                </div>
            </form>
        </div>
    </div>

    <script src="./assets/style.js"></script>

    <script>
    document.getElementById("send").addEventListener("click", function(event) {
        const username = document.getElementById("username").value.trim();
        const password = document.getElementById("password").value.trim();
        const message = document.getElementById("message");

        if (!username || !password) {
            event.preventDefault();
            message.textContent = "Veuillez remplir tous les champs !";
            message.style.color = "white";
            message.style.backgroundColor = "red";
            message.style.marginBottom = "10px";
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
