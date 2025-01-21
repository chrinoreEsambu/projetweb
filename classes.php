<?php
    include("connexion.php");
    //Définition de la classe Famille
    class famille
    {
    public $idfam;
    public $designationf;
    function __construct($id,$des)
        {

        $this->idfam=$id;
        $this->designationf=$des;

        }
    function ajouter()
    { $cnx=Connexion::getInstance()->getConnexion();
        if($cnx)
        { $sql="INSERT INTO famille VALUES
        ('$this->idfam','$this->designationf')";
        $nblignes=$cnx->exec($sql);
        if($nblignes!=1)
        {
        return "Insertion impossible";
        
        }
        else
        { $cnx=null;
        return true; }}
        
        else
        { 
            return "Connexion impossible";
        }
        }
        function supprimer()
        {$cnx= Connexion::getInstance()->getConnexion();
            if($cnx)
    {$sql="DELETE FROM famille WHERE

    idfam=$this->idfam";
    $nblignes=$cnx->exec($sql);
    if($nblignes!=1)
    { return "Suppression impossible";
    }
    else

    { $cnx=null;
    return true;

    }
    }
    else
    { return "Connexion impossible"; }
    }
    function modifier()
    {$cnx= Connexion::getInstance()->getConnexion();
    if($cnx)

    {$sql="UPDATE famille SET

    idfam='$this->idfam',
    designationf ='$this->designationf'
    WHERE idfam=$this->idfam";
    $nblignes=$cnx->exec($sql);
    if($nblignes!=1)
    {
    return "Modification impossible";
    }
    else
    { $cnx=null;
    return true;
    }
    }
    else
    {return "Connexion impossible"; }
    }
    static function lecture($id)
    { $res=null;
    $cnx= Connexion::getInstance()->getConnexion();
    if($cnx)
    { $sql="SELECT * FROM famille WHERE idfam=$id";
    $resultat=$cnx->query($sql);
    if($resultat && $resultat->rowCount()==1)
    { $fam=$resultat->fetch(PDO::FETCH_ASSOC);
    $res=new famille($fam["idfam"],$fam["designationf"]);
    $resultat->closeCursor();
    $cnx=null; }

    }
    return $res;
    }
    static function lister()
    { $tab=null;
    $cnx= Connexion::getInstance()->getConnexion();
    if($cnx)

    { $sql="SELECT * FROM famille ORDER BY designationf";

    $resultat=$cnx->query($sql);
    if($resultat)
    {$tab=$resultat->fetchAll(PDO::FETCH_ASSOC);

    $cnx=null;
    return $tab; }

    }
    return $tab;
    }

    }
    //Définition de la classe Produit
    class produit
    {
    public $idprod;
    public $designation_prod;
    public $quantite_stock;
    public $prix_unitaire;
    public $idfam;

    function __construct($id,$des,$q,$p,$idf)
    { $this->idprod=$id;
    $this->designation_prod=$des;
    $this->quantite_stock=$q;
    $this->prix_unitaire=$p;
    $this->idfam=$idf;

    }
    function ajouter()
    { $cnx= Connexion::getInstance()->getConnexion();
    if($cnx)
    {
    //l’identifiant est de type auto-increment
    $sql="INSERT INTO produit
    (designation_prod,quantite_stock,prix_unitaire,idfam)
    VALUES('$this->designation_prod',
    '$this->quantite_stock','$this->prix_unitaire',
    '$this->idfam' )";
    $nblignes=$cnx->exec($sql);
    if($nblignes!=1)
    {
    return "Insertion impossible";

    }
    else
    { $cnx=null;
    return true; }}

    else
    { return "Connexion impossible";
    }
    }
    function supprimer()
    {$cnx= Connexion::getInstance()->getConnexion();
    if($cnx)
    {$sql="DELETE FROM produit WHERE

    idprod=$this->idprod";
    $nblignes=$cnx->exec($sql);
    if($nblignes!=1)
    { return "Suppression impossible";
    }
    else

    { $cnx=null;
    return true;

    }
    }
    else
    { return "Connexion impossible"; }
    }
    function modifier()
    {$cnx= Connexion::getInstance()->getConnexion();
    if($cnx)

    {$sql="UPDATE produit SET
    idprod='$this->idprod',

    designation_prod='$this->designation_prod',
    quantite_stock ='$this->quantite_stock',
    prix_unitaire='$this->prix_unitaire',
    idfam ='$this->idfam'
    WHERE idprod=$this->idprod";
    $nblignes=$cnx->exec($sql);
    if($nblignes!=1)
    { return "Modification impossible"; }
    else { $cnx=null;
    return true; } }

    else
    {return "Connexion impossible"; }
    }
    static function lecture($id)
    { $res=null;
    $cnx= Connexion::getInstance()->getConnexion();
    if($cnx)
    { $sql="SELECT * FROM produit WHERE idprod=$id";
    $resultat=$cnx->query($sql);
    if($resultat && $resultat->rowCount()==1)
    { $prod=$resultat->fetch(PDO::FETCH_ASSOC);

    $res=new
    produit($prod["idprod"],$prod["designation_prod"],$prod["quantite_stock"], $prod["prix_unitaire"],$prod["idfam"] );
    $resultat->closeCursor();
    $cnx=null; }

    }
    return $res;
    }
    static function lister()
    { $tab=null;
    $cnx= Connexion::getInstance()->getConnexion();
    if($cnx)
    { $sql="SELECT * FROM produit ORDER BY designation_prod";
    $resultat=$cnx->query($sql);
    if($resultat)
    {$tab=$resultat->fetchAll(PDO::FETCH_ASSOC);
    $cnx=null;
    return $tab; 
    }
    }
    return $tab;
    }

    }
    //Définition de la classe Administrateur
    class administrateur
    { public $id_admin;
    public $login;
    public $mot_de_passe;
    function __construct($id,$login,$mp)
    { $this->id_admin=$id;
    $this->login=$login;
    $this->mot_de_passe=$mp;

    }
    function ajouter()
    { $cnx= Connexion::getInstance()->getConnexion();
    if($cnx)
    {
        $sql="INSERT INTO administrateur (login,mot_de_passe)
    VALUES('$this->login', '$this->mot_de_passe')";
    $nblignes=$cnx->exec($sql);
    if($nblignes!=1)
    {
    return "Insertion impossible";

    }
    else
    { $cnx=null;
    return true; }}

    else
    { return "Connexion impossible";
    }
    }
    function supprimer()
    {$cnx= Connexion::getInstance()->getConnexion();
    if($cnx)
    {$sql="DELETE FROM administrateur WHERE

    id_admin=$this->id_admin";
    $nblignes=$cnx->exec($sql);
    if($nblignes!=1)
    { return "Suppression impossible";
    }
    else

    { $cnx=null;
    return true;

    }
    }
    else
    { return "Connexion impossible"; }
    }
    function modifier()
    {$cnx= Connexion::getInstance()->getConnexion();
    if($cnx)

    {$sql="UPDATE administrateur SET

    Id_admin='$this->id_admin',
    login='$this->login',
    mot_de_passe ='$this->mot_de_passe'
    WHERE id_admin=$this->id_admin";
    $nblignes=$cnx->exec($sql);
    if($nblignes!=1)
    { return "Modification impossible";
    }

    else { $cnx=null;

    return true; } }

    else
    {return "Connexion impossible"; }
    }
    static function lecture($id)
    { $res=null;
    $cnx= Connexion::getInstance()->getConnexion();
    if($cnx)
    { $sql="SELECT * FROM administrateur WHERE

    id_admin=$id";

    $resultat=$cnx->query($sql);
    if($resultat && $resultat->rowCount()==1)
    { $adm=$resultat->fetch(PDO::FETCH_ASSOC);

    $res=new
    administrateur($adm["id_admin"],$adm["login"],$adm["mot_de_pass
    e"]);

    $resultat->closeCursor();
    $cnx=null; }

    }
    return $res;
    }
    static function lister()
    { $tab=null;

    $cnx= Connexion::getInstance()->getConnexion();
    if($cnx)
    { $sql="SELECT * FROM administrateur ORDER BY

    login";

    $resultat=$cnx->query($sql);
    if($resultat)
    {$tab=$resultat->fetchAll(PDO::FETCH_ASSOC);

    $cnx=null;
    return $tab; }

    }
    return $tab;
    }

    }
?>
<!-- okey -->