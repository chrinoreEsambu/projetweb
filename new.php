<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Gestion des Messages</title>
    <link rel="stylesheet" href="assets/stylesuper.css" />
    <script src="https://kit.fontawesome.com/d98f6633b8.js" crossorigin="anonymous"></script>
    <script>
    // Fonction pour masquer le message après 3 secondes
    window.onload = function() {
        const message = document.getElementById('message');
        if (message) {
            setTimeout(function() {
                message.classList.add('hidden'); // Ajoute la classe pour masquer le message
            }, 3000); // Masquer après 3 secondes
        }
    };
    </script>
</head>

<body>
    <?php
    require_once("connexion.php");

    $error = "";
    $success = "";

    // Envoi du message
    if (isset($_POST['send_message'])) {
        $message = isset($_POST['message']) ? trim($_POST['message']) : null;

        if (!empty($message)) {
            try {
                $con = Connexion::getInstance()->getConnexion();
                $insertSql = "INSERT INTO messages (allmessages) VALUES (:message)";
                $insertStmt = $con->prepare($insertSql);
                $insertStmt->execute(['message' => $message]);
                $success = "Message envoyé avec succès !";
            } catch (PDOException $e) {
                $error = "Erreur lors de l'envoi du message : " . $e->getMessage();
            }
        } else {
            $error = "Veuillez entrer un message !";
        }
    }

    // Suppression d'un message
    if (isset($_POST['delete_message'])) {
        $idMessage = $_POST['idmessage'];
        try {
            $con = Connexion::getInstance()->getConnexion();
            $deleteSql = "DELETE FROM messages WHERE idmessage = :idmessage";
            $deleteStmt = $con->prepare($deleteSql);
            $deleteStmt->execute(['idmessage' => $idMessage]);
            $success = "Message supprimé avec succès !";
        } catch (PDOException $e) {
            $error = "Erreur lors de la suppression du message : " . $e->getMessage();
        }
    }

    try {
        $con = Connexion::getInstance()->getConnexion();
        $fetchSql = "SELECT * FROM messages";
        $fetchStmt = $con->query($fetchSql);
        $messages = $fetchStmt->fetchAll(PDO::FETCH_ASSOC);
    } catch (PDOException $e) {
        $error = "Erreur lors de la récupération des messages : " . $e->getMessage();
    }
    ?>

    <div class="container">
        <div class="right-section">
            <form action="new.php" method="POST" class="message-form">
                <h2>Envoyer un Message</h2>

                <?php if (!empty($error)) : ?>
                <p id="message" class="error-message">
                    <?= htmlspecialchars($error) ?>
                </p>
                <?php elseif (!empty($success)) : ?>
                <p id="message" class="success-message">
                    <?= htmlspecialchars($success) ?>
                </p>
                <?php endif; ?>

                <div class="input-container">
                    <textarea name="message" rows="5" placeholder="Écrivez votre message ici..." required></textarea>
                </div>

                <button type="submit" class="submit-btn" name="send_message">Envoyer le Message</button>
            </form>

            <div class="message-list">
                <h2>Liste des Messages</h2>

                <?php if (!empty($messages)) : ?>
                <table>
                    <thead>
                        <tr>
                            <th>Message</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($messages as $message) : ?>
                        <tr>
                            <td><?= htmlspecialchars($message['allmessages']) ?></td>
                            <td>
                                <form action="new.php" method="POST" style="display: inline;">
                                    <input type="hidden" name="idmessage" value="<?= $message['idmessage'] ?>" />
                                    <button type="submit" name="delete_message" class="delete-btn">
                                        <i class="fa-solid fa-trash"></i> Supprimer
                                    </button>
                                </form>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
                <?php else : ?>
                <p>Aucun message trouvé.</p>
                <?php endif; ?>
            </div>
        </div>
    </div>
</body>
<style>
* {
    margin: 0;
    padding: 0;
    box-sizing: border-box;
}

::-webkit-scrollbar {
    width: 3px;
    background-color: transparent;
}

::-webkit-scrollbar-thumb {
    background-color: #ffc300;
}

body {
    font-family: Arial, sans-serif;
    background-color: #f5f5f5;
    color: #333;
    line-height: 1.5;
    display: flex;
    justify-content: center;
    align-items: center;
    min-height: 100vh;
}

.container {
    width: 100%;
    max-width: 500px;
    padding: 20px;
    background-color: white;
    border-radius: 8px;
    text-align: center;
}

.message-form h2 {
    text-align: start;
    font-size: 18px;
    margin-bottom: 10px;
    color: #000000;
}

textarea {
    width: 100%;
    padding: 8px;
    font-size: 14px;
    border: 1px solid #ddd;
    border-radius: 5px;
    margin-bottom: 10px;
    resize: vertical;
}

button.submit-btn {
    width: 100%;
    padding: 10px;
    background-color: #000000;
    color: white;
    border: none;
    border-radius: 5px;
    font-size: 14px;
    cursor: pointer;
    transition: background-color 0.2s ease;
}

button.submit-btn:hover {
    background-color: #ffc300;
}

/* Styles pour le message d'erreur et de succès */
.error-message,
.success-message {
    margin-bottom: 15px;
    padding: 10px;
    font-size: 14px;
    border-radius: 5px;
    color: white;
    display: block;
}

.error-message {
    background-color: red;
}

.success-message {
    background-color: #00e81c;
}

/* Masquer les messages après 3 secondes */
#message {
    display: block;
    opacity: 1;
    transition: opacity 0.5s ease;
}

#message.hidden {
    opacity: 0;
    display: none;
}

.message-list {
    margin-top: 20px;
    text-align: left;
}

.message-list h2 {
    color: #000000;
}

.message-list table {
    width: 100%;
    border-collapse: collapse;
}

.message-list th,
.message-list td {
    padding: 8px;
    text-align: left;
    border-bottom: 1px solid #ddd;
}

.message-list th {
    background-color: #000000;
    color: white;
}

.message-list button.delete-btn {
    background-color: #ff1300;
    color: white;
    padding: 5px 10px;
    border: none;
    border-radius: 5px;
    cursor: pointer;
    font-size: 12px;
    transition: background-color 0.3s ease;
}

.message-list button.delete-btn:hover {
    background-color: #cc1100;
}

.message-list i {
    margin-right: 5px;
}

@media (max-width: 600px) {
    .container {
        width: 90%;
    }

    button.submit-btn {
        font-size: 12px;
    }

    textarea {
        font-size: 12px;
    }
}
</style>

</html>