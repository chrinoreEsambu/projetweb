<?php
include("connexion.php");

if (isset($_GET['idfam'])) {
    
    $idfam = $_GET['idfam'];

    
    $cnx = Connexion::getInstance()->getConnexion();

    
    if ($cnx) {
        
        $sql = "DELETE FROM famille WHERE idfam = :idfam";
        $stmt = $cnx->prepare($sql);
        $stmt->bindParam(':idfam', $idfam, PDO::PARAM_STR); 
        
        
        if ($stmt->execute()) {
            // echo '<script>alert("Famille supprimée avec succès.");</script>';
            echo('<script>document.location.href="liste_famille.php";</script>');
        } else {
            echo '<script>alert("Erreur lors de la suppression de la famille.");</script>';
            echo('<script>document.location.href="liste_famille.php";</script>');
        }
    } else {
        
        echo "<p>Impossible de se connecter à la base de données.</p>";
    }
} else {
   
    echo "<p>ID de la famille manquant.</p>";
}
?>