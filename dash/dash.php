<?php
require_once("../connexion.php");

$res = null;
$productCount = 0;
$familleCount = 0;

try {
    $cnx = Connexion::getInstance()->getConnexion();
    if ($cnx) {
        
        $sql = "SELECT COUNT(*) AS productCount FROM produit";
        $resultat = $cnx->query($sql);
        if ($resultat) {
            $productCount = $resultat->fetch(PDO::FETCH_ASSOC)['productCount'];
        }

        
        $sql = "SELECT COUNT(*) AS familleCount FROM famille";
        $resultat = $cnx->query($sql);
        if ($resultat) {
            $familleCount = $resultat->fetch(PDO::FETCH_ASSOC)['familleCount'];
        }

        $sql = "SELECT COUNT(*) AS adminCount FROM administrateurs";
        $resultat = $cnx->query($sql);
        if ($resultat) {
            $adminCount = $resultat->fetch(PDO::FETCH_ASSOC)['adminCount'];
        }
    }
} catch (Exception $e) {
    
    echo "Erreur : " . $e->getMessage();
}

session_start();

if (!isset($_SESSION['user'])) {
    
    header('Location:index.php');
    exit;
}

$user = $_SESSION['user']; 


?>
<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Unify-Dash</title>
    <link rel="stylesheet" href="assets/styled.css" />
    <link rel="icon" href="../assets/favicon.png" type="image/x-icon">
    <script src="https://kit.fontawesome.com/d98f6633b8.js" crossorigin="anonymous"></script>
    <script src="//code.tidio.co/x9uoz5u9re3llid6mwze15uzi7itcmw2.js" async></script>
</head>

<body>

    <div class="sidebar" id="sidebar">
        <button class="toggle-btn" id="close-btn">
            <i class="fa-solid fa-times"></i>
        </button>
        <div class="logo">
            <img src="../assets/favi1.png" alt="" class="logobar">
            <label for="logo" class="logotxt">Unify</label>
        </div>
        <nav>
            <ul>
                <li>
                    <a href="#" id="home">
                        <i class="fa-solid fa-house"> </i> Home
                    </a>
                </li>

                <li>
                    <a href="#" onclick="loadContent('../dash/superadmin.php')">
                        <i class="fa-solid fa-screwdriver-wrench"></i> SuperAdmin
                    </a>
                </li>
                <li>
                    <a href="#" onclick="loadContent('../liste_produit.php')">
                        <i class="fa-brands fa-product-hunt"></i> Produits
                    </a>
                </li>
                <li>
                    <a href="#" onclick="loadContent('../portfolio.html')">
                        <i class="fa-regular fa-address-card"></i> Portfolio
                    </a>
                </li>

                <li>
                    <a href="#" onclick="loadContent('../news.php')">
                        <i class="fa-solid fa-newspaper"></i> Newsadmin
                    </a>
                </li>

                <li>
                    <a id="logout" style="cursor:pointer">
                        <i class="fa-solid fa-right-from-bracket"></i> Logout
                    </a>
                </li>
            </ul>
        </nav>
    </div>


    <div class="main" id="main">
        <div class="header">
            <span class="hamburger" id="hamburger">
                <i class="fa-solid fa-bars"></i>
            </span>
            <h1>Unify-Dash<span class="esthetique">board</span></h1>

            <label id="userconnect"><span class="esthet">Active User <i class="fa-regular fa-user"></i></span>
                <?= htmlspecialchars($user) ?></label>
        </div>

        <div class="main-content">
            <div class="stats">
                <div class="stat-box">
                    <i class="fa-solid fa-box-open"></i>
                    <h3> Nbr-Produits</h3>
                    <p id="products-count"><?php echo $productCount; ?></p>
                </div>
                <div class="stat-box">
                    <i class="fa-solid fa-people-group"></i>
                    <h3> Nbr-Familles</h3>
                    <p id="family-count"><?php echo $familleCount; ?></p>
                </div>
                <div class="stat-box">
                    <i class="fa-solid fa-user-group"></i>
                    <h3> Admins</h3>
                    <p id="admins-count"><?php echo $adminCount; ?></p>
                </div>
            </div>
        </div>


        <iframe src="" frameborder="0" id="mainonedisplay"
            style="display:none; width: 100%;height: 100%;background-color:white;"></iframe>


        <div class="partie-container" id="mainone">
            <div class="containerone">
                <div class="partieone">
                    <label class="titre">Ajouter Famille</label>
                    <iframe src="../ajouter_famille.php" frameborder="0" id="contentFrame1"></iframe>
                </div>
                <div class="partietwo">
                    <label class="titre">Liste des Produits</label>
                    <iframe src="../liste_produit.php" frameborder="0" id="contentFrame2"></iframe>
                </div>
            </div>
            <div class="containetwo">
                <div class="partieone" id="fo">
                    <label class="titre">Liste des Familles</label>
                    <iframe src="../liste_famille.php" frameborder="0" id="contentFrame3"></iframe>
                </div>
                <div class="partieone">
                    <label class="titre">Ajouter Produit</label>
                    <iframe src="../ajout_produit.php" frameborder="0" id="contentFrame4"></iframe>
                </div>
            </div>
        </div>
    </div>

    <script>
    document.getElementById("logout").addEventListener("click", function() {
        window.location.href = "../logout.php";
    });
    </script>

    <script>
    const mainonedisplay = document.getElementById("mainonedisplay");
    const mainone = document.getElementById('mainone');
    const home = document.getElementById('home');

    home.addEventListener('click', () => {
        mainone.style.display = "block";
        mainonedisplay.style.display = "none";
    });

    function loadContent(url) {
        mainone.style.display = "none";
        mainonedisplay.style.display = "block";
        mainonedisplay.style.borderRadius = "10px";

        mainonedisplay.src = url;
    }

    const sidebar = document.getElementById("sidebar");
    const hamburger = document.getElementById("hamburger");
    const closeBtn = document.getElementById("close-btn");

    hamburger.addEventListener("click", () => {
        sidebar.classList.add("active");
    });

    closeBtn.addEventListener("click", () => {
        sidebar.classList.remove("active");
    });

    document.querySelectorAll("iframe").forEach((iframe) => {
        iframe.onload = () => {
            iframe.style.height = iframe.contentWindow.document.body.scrollHeight + "px";
        };
    });
    </script>
</body>

</html>