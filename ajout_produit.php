<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ajouter Produit</title>
    <style>
    * {
        margin: 0;
        padding: 0;
        box-sizing: border-box;
    }

    body {
        font-family: Arial, sans-serif;
        display: flex;
        justify-content: center;
        align-items: center;
        min-height: 100vh;

    }

    h2 {
        color: #000;
        margin-bottom: 20px;
        font-size: 18px;
        text-align: center;
    }

    form {
        background: #fff;
        border-radius: 10px;
        padding: 20px;
        max-width: 400px;
        width: 100%;

    }

    table {
        width: 100%;
        border-collapse: collapse;
    }

    td {
        padding: 10px;
        color: #555;
    }

    input[type="text"],
    input[type="number"],
    input[type="submit"],
    input[type="reset"] {
        width: 100%;
        padding: 10px;
        border: 1px solid #ddd;
        border-radius: 5px;
        font-size: 14px;
    }

    input[type="text"]:focus,
    input[type="number"]:focus {
        border-color: #000;
        outline: none;
    }

    input[type="submit"],
    input[type="reset"] {
        background-color: #000;
        color: white;
        cursor: pointer;
        transition: background-color 0.3s ease;
        border: none;
    }

    input[type="submit"]:hover,
    input[type="reset"]:hover {
        background-color: #333;
    }

    .buttons {
        display: flex;
        gap: 10px;
        justify-content: center;
    }
    </style>
</head>

<body>
    <div>
        <form name="form1" method="post" action="ajout_produit.php">

            <table>
                <tr>
                    <td><label for="idfam">ID Famille</label></td>
                    <td><input type="text" id="idfam" name="idfam" required></td>

                </tr>
                <tr>
                    <td><label for="designation_prod">Désignation Produit</label></td>
                    <td><input type="text" id="designation_prod" name="designation_prod" required></td>
                </tr>
                <tr>
                    <td><label for="quantite_stock">Quantité Stock</label></td>
                    <td><input type="number" id="quantite_stock" name="quantite_stock" required></td>
                </tr>
                <tr>
                    <td><label for="prix_unitaire">Prix Unitaire</label></td>
                    <td><input type="number" step="0.01" id="prix_unitaire" name="prix_unitaire" required></td>
                </tr>
                <tr>
                    <td colspan="2">
                        <div class="buttons">
                            <input type="submit" name="ajouter" value="Ajouter">
                            <input type="reset" name="reset" value="Annuler">
                        </div>
                    </td>
                </tr>
            </table>
        </form>
    </div>

    <?php

include("classes.php");

if (isset($_POST["ajouter"])) {
    
    $idfam = $_POST["idfam"] ?? null;
    $designation_prod = $_POST["designation_prod"] ?? null;
    $quantite_stock = $_POST["quantite_stock"] ?? null;
    $prix_unitaire = $_POST["prix_unitaire"] ?? null;

    
    if (empty($idfam) || empty($designation_prod) || empty($quantite_stock) || empty($prix_unitaire)) {
        echo '<script>alert("Un ou plusieurs champs ne sont pas remplis");window.history.go(-1);</script>';
        exit;
    }
    $produit = new produit(
        null,
        $designation_prod,
        $quantite_stock,
        $prix_unitaire,
        $idfam
    );

    
    $resultat = $produit->ajouter();

    if ($resultat === true) {
        echo '<script>alert("Le produit a été ajouté avec succès");window.location.href="ajout_produit.php";</script>';
    } else {
        echo "<script>alert('Erreur : $resultat');window.history.go(-1);</script>";
    }
}
?>

</body>

</html>