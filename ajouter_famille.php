<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ajouter Famille</title>
    <script src="https://kit.fontawesome.com/d98f6633b8.js" crossorigin="anonymous"></script>
    <style>
    * {
        margin: 0;
        padding: 0;
        box-sizing: border-box;
    }

    body {
        font-family: Arial, sans-serif;
        margin: 0;
        padding: 0;
        display: flex;
        justify-content: center;
        align-items: center;
        /* height: 100vh; */
    }

    h2 {
        color: #000000;
        margin-bottom: 20px;
        font-size: 17px;
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
    input[type="submit"],
    input[type="reset"] {
        width: 100%;
        padding: 10px;
        border: 1px solid #ddd;
        border-radius: 5px;
        font-size: 14px;
    }

    input[type="text"]:focus {
        border-color: rgb(0, 0, 0);
        outline: none;
    }

    input[type="submit"],
    input[type="reset"] {
        background-color: rgb(0, 0, 0);
        color: white;
        cursor: pointer;
        transition: background-color 0.3s ease;
        border: none;
    }

    input[type="submit"]:hover,
    input[type="reset"]:hover {
        background-color: rgb(14, 16, 17);
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

        <form name="form1" method="post" action="ajouter_famille.php">
            <table>
                <tr>
                    <td><label for="id_famille">ID Famille</label></td>
                    <td><input type="text" id="id_famille" name="id_famille" value=""></td>
                </tr>
                <tr>
                    <td><label for="designation_famille">Désignation Famille</label></td>
                    <td><input type="text" id="designation_famille" name="designation_famille" value=""></td>
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
        if (empty($_POST["id_famille"]) || empty($_POST["designation_famille"])) {
            echo '<script>alert("Un ou plusieurs champs ne sont pas remplis");window.history.go(-1);</script>';
        } else {
            $fl = new famille($_POST["id_famille"], $_POST["designation_famille"]);
            $res = $fl->ajouter();
            if ($res == true) {
                echo '<script>alert("La famille a été ajoutée avec succès");window.history.go(-1);</script>';
            } else {
                echo ($res);
            }
        }
    }
    ?>
</body>

</html>