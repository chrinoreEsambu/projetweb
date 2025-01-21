<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Liste des Produits</title>
    <script src="https://kit.fontawesome.com/d98f6633b8.js" crossorigin="anonymous"></script>
    <style>
    body {
        font-family: Arial, sans-serif;
        margin: 0;
        padding: 0;
        display: flex;
        flex-direction: column;
        align-items: center;
        min-height: 100vh;
    }

    h2 {
        text-align: start;
        color: #333;
        font-size: 17px;
    }

    table {

        margin-top: 20px;
        border-collapse: collapse;
        background: #fff;
        box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
        border-radius: 8px;
        overflow: hidden;
    }

    th,
    td {
        text-align: center;
        padding: 12px;
        color: #555;
        border-bottom: 1px solid #ddd;
    }

    th {
        background-color: rgb(0, 0, 0);
        color: white;
        font-weight: bold;
    }

    tr:nth-child(even) {
        background-color: #f9f9f9;
    }

    tr:hover {
        background-color: #f1f1f1;
    }

    a {
        text-decoration: none;
        font-size: 0.9rem;
        padding: 8px 12px;
        border-radius: 5px;
        transition: background-color 0.3s ease, color 0.3s ease;
    }

    a:hover {
        color: white;
    }

    .modify {
        background-color: rgb(0, 0, 0);
        color: white;
    }

    .modify:hover {
        background-color: #66cc00;
    }

    .delete {
        background-color: #ff1300;
        color: white;
    }

    .delete:hover {
        background-color: #cc1100;
    }

    .no-records {
        color: #666;
        margin-top: 20px;
        font-size: 1.2rem;
    }
    </style>
</head>

<body>

    <?php
    include("classes.php");
    $res1 = produit::lister();
    if ($res1 != null && count($res1) > 0) {
        echo "<table>";
        echo "<tr><th>Désignation</th><th>Quantité</th><th>Prix Unitaire</th><th colspan='2'>Actions</th></tr>";
        foreach ($res1 as $enr1) {
            echo "<tr>
                    <td>" . $enr1['designation_prod'] . "</td>
                    <td>" . $enr1['quantite_stock'] . "</td>
                    <td>" . $enr1['prix_unitaire'] . " €</td>
                    <td><a href='modifier_produit.php?code_produit=" . $enr1['idprod'] . "' class='modify'>Modifier</a></td>
                    <td><a href='supprimer_produit.php?code_produit=" . $enr1['idprod'] . "' class='delete'><i class='fa-solid fa-trash'></i> Supprimer</a></td>
                  </tr>";
        }
        echo "</table>";
    } else {
        echo "<p class='no-records'>Aucun enregistrement trouvé</p>";
    }
    ?>

</body>

</html>