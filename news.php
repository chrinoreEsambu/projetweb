<?php
// Inclure le fichier de connexion à la base de données
require_once("connexion.php");

// Récupérer l'instance de la connexion PDO
$conn = Connexion::getInstance()->getConnexion();
?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Messages Admin - Chrinore</title>
    <script src="https://kit.fontawesome.com/d98f6633b8.js" crossorigin="anonymous"></script>
    <style>
    @import url("https://fonts.googleapis.com/css2?family=Poppins:wght@200;300;400;500&display=swap");

    * {
        margin: 0;
        padding: 0;
        box-sizing: border-box;
        font-family: "Poppins", sans-serif;
    }

    ::-webkit-scrollbar {
        width: 7px;
        background-color: transparent;
    }

    ::-webkit-scrollbar-thumb {
        background-color: #ffc300;
    }

    body {
        background-color: #000;
        color: #fff;
    }

    header {
        padding: 20px 10%;
        display: flex;
        align-items: center;
        justify-content: space-between;
    }

    header h4 {
        font-size: 20px;
        color: #ffc300;
    }

    header a {
        text-decoration: none;
        color: #fff;
        padding: 10px 20px;
        border: 2px solid #ffc300;
        border-radius: 5px;
        transition: 0.3s;
    }

    header a:hover {
        background-color: #ffc300;
        color: #000;
    }

    main {
        padding: 20px 10%;
    }

    h1 {
        font-size: 28px;
        margin-bottom: 20px;
        text-align: center;
    }

    .message-container {
        display: flex;
        flex-direction: column;
        gap: 15px;
    }

    .message-box {
        background-color: #1a1a1a;
        padding: 15px;
        border-radius: 8px;
        box-shadow: 0 2px 5px rgba(0, 0, 0, 0.5);
        transition: 0.3s;
    }

    .message-box:hover {
        background-color: #ffc300;
        color: #000;
    }

    .message-header {
        font-weight: 500;
        margin-bottom: 10px;
    }

    .message-content {
        font-size: 14px;
        line-height: 1.5;
    }
    </style>
</head>

<body>
    <header>
        <h4>Note d'info <i class="fa-solid fa-bell"></i></h4>
    </header>
    <main>
        <h1>Messages <i class="fa-solid fa-comment"></i></h1>
        <div class="message-container">
            <?php
            // Récupération des messages depuis la base de données
            try {
                
                $sql = "SELECT * FROM messages ORDER BY idmessage DESC";
                $stmt = $conn->prepare($sql);
                $stmt->execute();
                
                if ($stmt->rowCount() > 0) {
                    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                        echo "<div class='message-box'>";
                        
                    
                        $date = new DateTime();
                        $formatted_date = $date->format('d/m/Y H:i:s');
                        
                        
                        echo "<div class='message-header'>Publié le : " . htmlspecialchars($formatted_date) . "</div>";
                        
                        echo "<div class='message-content'>" . htmlspecialchars($row['allmessages']) . "</div>";
                        echo "</div>";
                    }
                } else {
                    echo "<div class='message-box'>Aucun message trouvé.</div>";
                }
            } catch (PDOException $e) {
                echo "Erreur de requête: " . $e->getMessage();
            }
            ?>
        </div>
    </main>
</body>

</html>