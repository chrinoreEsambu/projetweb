<?php
include("connexion.php");


if (isset($_GET['idfam'])) {
    $idfam = $_GET['idfam'];

    
    $cnx = Connexion::getInstance()->getConnexion();
    
    
    if ($cnx) {
        
        $sql = "SELECT * FROM famille WHERE idfam = :idfam";
        $stmt = $cnx->prepare($sql);
        $stmt->bindParam(':idfam', $idfam, PDO::PARAM_INT);
        $stmt->execute();
        
        
        $famille = $stmt->fetch();
    }
}
?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modifier Famille</title>
    <script src="https://kit.fontawesome.com/d98f6633b8.js" crossorigin="anonymous"></script>

    <style>
    @import url("https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap");

    body {
        font-family: Poppins, sans-serif;
        margin: 0;
        padding: 0;
        display: flex;
        flex-direction: column;
        align-items: start;
        min-height: 80vh;
        min-width: 10vw;
    }

    h2 {
        text-align: start;
        color: #1c1c1c;
        font-size: 17px;
        margin-top: 20px;
    }

    table {
        margin-top: 20px;
        border-collapse: collapse;
        background: #fff;
        border-radius: 8px;
        overflow: hidden;
        width: 100%;
        max-width: 450px;
    }

    td {
        text-align: left;
        padding: 10px;
        color: #1c1c1c;
        border-bottom: 1px solid #ddd;
    }

    input[type="text"] {
        width: 100%;
        padding: 6px;
        border: 1px solid #ccc;
        border-radius: 5px;
        font-size: 0.9rem;
        margin-top: 5px;
        box-sizing: border-box;
    }

    button[type="submit"],
    button[type="reset"] {
        padding: 8px;
        width: 48%;
        margin-top: 15px;
        border: none;
        border-radius: 5px;
        font-size: 0.9rem;
        cursor: pointer;
        transition: background-color 0.3s ease;
    }

    button[type="submit"] {
        background-color: #51ff00;
        color: white;
    }

    button[type="submit"]:hover {
        background-color: #66cc00;
    }

    button[type="reset"] {
        background-color: #ff1300;
        color: white;
    }

    button[type="reset"]:hover {
        background-color: #cc1100;
    }

    .form-container {
        padding: 20px;
        background-color: white;
        box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
        border-radius: 10px;
        width: 100%;
        max-width: 480px;
    }

    .button-container {
        text-align: center;
    }

    .no-records {
        color: #666;
        margin-top: 20px;
        font-size: 1.2rem;
    }
    </style>
</head>

<body>

    <div class="form-container">
        <h2>Modifier Famille</h2>
        <form name="form1" method="post">
            <table>
                <tr>
                    <td>ID Famille</td>
                    <td><input name="idfam" type="text" value="<?php echo htmlspecialchars($famille['idfam']); ?>"
                            readonly></td>
                </tr>
                <tr>
                    <td>Désignation</td>
                    <td><input name="designation" type="text"
                            value="<?php echo htmlspecialchars($famille['designation']); ?>"></td>
                </tr>
            </table>
            <div class="button-container">
                <button type="submit" name="Modifier" value="Modifier"><i class='fa-solid fa-check'></i>
                    Modifier</button>
                <button type="reset" name="Submit2" value="Annuler"><i class='fa-solid fa-xmark'></i> Annuler</button>
                <!-- <input type="submit" name="Modifier" value="Modifier"> -->
                <!-- <input type="reset" name="Submit2" value="Annuler"> -->
            </div>
        </form>
    </div>

    <?php
    if (isset($_POST['Modifier'])) {
        
        $idfam = $_POST['idfam'];
        $designation = $_POST['designation'];

        
        $cnx = Connexion::getInstance()->getConnexion();
        
        if ($cnx) {
            
            $sql = "UPDATE famille SET designation = :designation WHERE idfam = :idfam";
            $stmt = $cnx->prepare($sql);
            $stmt->bindParam(':idfam', $idfam, PDO::PARAM_INT);
            $stmt->bindParam(':designation', $designation, PDO::PARAM_STR);
            
            
            if ($stmt->execute()) {
                echo ('<script>alert("La modification a été effectuée avec succès.")</script>');
                echo ("<script>document.location.href=\"liste_famille.php\"</script>");
            } else {
                echo ('<script>alert("Erreur lors de la modification de la famille.")</script>');
            }
        }
    }

    if (isset($_POST['Submit2'])) {
        echo ("<script>document.location.href='liste_famille.php';</script>");
    }
    ?>

</body>

</html>