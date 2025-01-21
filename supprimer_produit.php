<?php
include("classes.php");
$prod= Produit::lecture($_GET["code_produit"]);
if($prod!=null)
$res=$prod->supprimer();
if($res===true)
{echo('<script> alert("la suppression est
correcte")</script>');
echo('<script>document.location.href="liste_produit.php";</script>');}
else
{ echo('<script>alert("' . htmlspecialchars($res, ENT_QUOTES) . '");</script>');}
?>
<?php
// include("classes.php");

// if (isset($_GET["code_produit"]) && !empty($_GET["code_produit"])) {
//     $prod = Produit::lecture($_GET["code_produit"]);
// } else {
//     die('<script>alert("Code produit manquant");</script>');
// }


// $res = false;
// if ($prod != null) {
//     $res = $prod->supprimer();
// }

// if ($res === true) {
//     echo('<script>alert("La suppression est correcte");</script>');
//     echo('<script>document.location.href="liste_produit.php";</script>');
// } else {
//     echo('<script>alert("' . htmlspecialchars($res, ENT_QUOTES) . '");</script>');
// }
?>