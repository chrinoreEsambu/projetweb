<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Ajout Administrateur</title>
    <link rel="stylesheet" href="assets/stylesuper.css" />
    <script src="https://kit.fontawesome.com/d98f6633b8.js" crossorigin="anonymous"></script>
</head>

<?php
require_once("../connexion.php");

$error = "";
$success = "";

if (isset($_POST['button_add'])) {
    $login = isset($_POST['username']) ? trim($_POST['username']) : null;
    $password = isset($_POST['password']) ? trim($_POST['password']) : null;

    if (!empty($login) && !empty($password)) {
        try {
            $con = Connexion::getInstance()->getConnexion();

           
            $checkSql = "SELECT * FROM administrateurs WHERE login = :login";
            $checkStmt = $con->prepare($checkSql);
            $checkStmt->execute(['login' => $login]);

            if ($checkStmt->rowCount() > 0) {
                $error = "Cet administrateur existe déjà !";
            } else {
                
                $insertSql = "INSERT INTO administrateurs (login, mot_de_passe) VALUES (:login, :password)";
                $insertStmt = $con->prepare($insertSql);
                $insertStmt->execute(['login' => $login, 'password' => $password]);
                $success = "Administrateur ajouté avec succès !";
            }
        } catch (PDOException $e) {
            $error = "Erreur lors de l'ajout : " . $e->getMessage();
        }
    } else {
        $error = "Veuillez remplir tous les champs !";
    }
}


if (isset($_POST['delete_admin'])) {
    $login = $_POST['admin_login'];
    try {
        $con = Connexion::getInstance()->getConnexion();
        $deleteSql = "DELETE FROM administrateurs WHERE login = :login";
        $deleteStmt = $con->prepare($deleteSql);
        $deleteStmt->execute(['login' => $login]);
        $success = "Administrateur supprimé avec succès !";
        // echo '<script>alert("Administrateur supprimé avec succès !");</script>';
    } catch (PDOException $e) {
        $error = "Erreur lors de la suppression : " . $e->getMessage();
    }
}

try {
    $con = Connexion::getInstance()->getConnexion();
    $fetchSql = "SELECT * FROM administrateurs";
    $fetchStmt = $con->query($fetchSql);
    $admins = $fetchStmt->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    $error = "Erreur lors de la récupération des administrateurs : " . $e->getMessage();
}


?>

<body>
    <div class="container">
        <div class="left-section">
            <img src="https://via.placeholder.com/600x600" alt="Image d'ajout admin" class="image" id="random-image" />
        </div>
        <div class="right-section">
            <form action="ajout_admin.php" method="POST" class="login-form">
                <h2>Ajout Administrateur</h2>

                <?php if (!empty($error)) : ?>
                <p style="color: white; background-color: red; padding: 10px; border-radius: 5px;" id="message">
                    <?= htmlspecialchars($error) ?>
                </p>
                <?php elseif (!empty($success)) : ?>
                <p id="message" style="color: white; background-color: green; padding: 10px; border-radius: 5px;">
                    <?= htmlspecialchars($success) ?>
                </p>
                <?php endif; ?>

                <div class="input-container">
                    <input type="text" id="username" name="username" placeholder="Nom d'utilisateur" required />
                    <i class="fa-regular fa-user"></i>
                </div>

                <div class="input-container">
                    <input type="password" id="password" name="password" placeholder="Mot de passe" required />
                    <i class="fa-regular fa-eye" id="eyes"></i>
                </div>

                <button type="submit" class="submit-btn" name="button_add" id="send">
                    Ajouter Administrateur
                </button>
            </form>

            <div class="admin-list">
                <h2>Liste des Administrateurs</h2>

                <?php if (!empty($admins)) : ?>
                <table>
                    <thead>
                        <tr>
                            <th style="border-top-left-radius: 5px;">Nom d'utilisateur</th>
                            <th>Mot de passe</th>
                            <th style="border-top-right-radius:5px ;">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($admins as $admin) : ?>
                        <tr>
                            <td><?= htmlspecialchars($admin['login']) ?></td>
                            <td><?= htmlspecialchars($admin['mot_de_passe']) ?></td>
                            <td>
                                <form action="ajout_admin.php" method="POST" style="display: inline;">
                                    <input type="hidden" name="admin_login" value="<?= $admin['login'] ?>" />
                                    <button type="submit" name="delete_admin" class="delete-btn"><i
                                            class='fa-solid fa-trash'></i> Supprimer</button>
                                </form>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
                <?php else : ?>
                <p>Aucun administrateur trouvé.</p>
                <?php endif; ?>

            </div>

        </div>
        <iframe src="../new.php" frameborder="0" class="iclasso"></iframe>
    </div>

    <!-- <iframe src="../new.php" frameborder="0"></iframe> -->


    <script>
    const imageElement = document.getElementById("random-image");
    const images = [
        "../assets/1.gif",
        "../assets/2.gif",
        "../assets/10.gif",
        "../assets/4.gif",
        "../assets/10.gif",
        "../assets/6.gif",
        "../assets/7.gif",
        "../assets/8.gif",
        "../assets/9.gif",
        "../assets/10.gif",
        "../assets/11.gif",
    ];

    function getRandomImage() {
        const randomIndex = Math.floor(Math.random() * images.length);
        const randomImage = images[randomIndex];
        imageElement.src = randomImage;
    }
    getRandomImage();
    </script>

    <script>
    document.getElementById("eyes").addEventListener("click", function() {
        const passwordField = document.getElementById("password");
        if (passwordField.type === "password") {
            passwordField.type = "text";
            this.classList.remove("fa-eye");
            this.classList.add("fa-eye-slash");
        } else {
            passwordField.type = "password";
            this.classList.remove("fa-eye-slash");
            this.classList.add("fa-eye");
        }
    });
    </script>

    <script>
    document.getElementById("send").addEventListener("click", function(event) {
        const username = document.getElementById("username").value.trim();
        const password = document.getElementById("password").value.trim();
        const message = document.getElementById("message");

        if (!username || !password) {
            event.preventDefault();
            if (!message) {
                const errorMsg = document.createElement("p");
                errorMsg.id = "message";
                errorMsg.textContent = "Veuillez remplir tous les champs !";
                errorMsg.style.color = "white";
                errorMsg.style.backgroundColor = "red";
                errorMsg.style.padding = "10px";
                errorMsg.style.borderRadius = "5px";
                document.querySelector(".login-form").prepend(errorMsg);
            } else {
                message.textContent = "Veuillez remplir tous les champs !";
                message.style.display = "block";
            }
        }
    });
    </script>
</body>

</html>