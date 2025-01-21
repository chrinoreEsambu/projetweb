<?php
include("classes.php");
$prod = produit::lecture($_GET["code_produit"]);
?>
<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modifier Produit</title>
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
        min-height: 100vh;
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

    td:first-child {
        /* font-weight: bold; */
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
        <h2>Modifier Produit</h2>
        <form name="form1" method="post">
            <table>
                <tr>
                    <td>Code Produit</td>
                    <td><input name="code_produit" type="text" value="<?php echo htmlspecialchars($prod->idprod); ?>">
                    </td>
                </tr>
                <tr>
                    <td>Désignation</td>
                    <td><input name="designation_prod" type="text"
                            value="<?php echo htmlspecialchars($prod->designation_prod); ?>"></td>
                </tr>
                <tr>
                    <td>Quantité Stock</td>
                    <td><input name="quantite_stock" type="text"
                            value="<?php echo htmlspecialchars($prod->quantite_stock); ?>"></td>
                </tr>
                <tr>
                    <td>Prix Unitaire</td>
                    <td><input name="prix_unitaire" type="text"
                            value="<?php echo htmlspecialchars($prod->prix_unitaire); ?>"></td>
                </tr>
                <tr>
                    <td>ID Famille</td>
                    <td><input name="idfam" type="text" value="<?php echo htmlspecialchars($prod->idfam); ?>"></td>
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
        $pl = new produit(
            $_POST["code_produit"],
            $_POST["designation_prod"],
            $_POST["quantite_stock"],
            $_POST["prix_unitaire"],
            $_POST["idfam"]
        );
        $res = $pl->modifier();
        if ($res === true) {
            echo ('<script>alert("La modification a été effectuée avec succès.")</script>');
            echo ("<script>document.location.href=\"liste_produit.php\"</script>");
        } else {
            echo ($res);
        }
    }
    ?>
</body>

</html>