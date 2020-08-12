<?php 
// Etape 0 : Créer la base de données

//Etape 1: Inclusion des paramètres de connexion
//include_once("myparam.inc.php");

//Etape 2: Connexion au serveur de base de données MySQL
$idcom = mysqli_connect('127.0.0.1', 'root', 'root','formulaireafpa');

//Etape 3: Test de la connexion
if(!$idcom){
    echo "Connexion impossible";
    exit(); //On arrete tout, on sort du script
}

//Etape 4 La connexion s'est faite ! Alors on vérifie que les champs du formulaire ne sont pas vides
if(!empty($_POST['nom']) && (!empty($_POST['prenom'])) && (!empty($_POST['ladate'])) && (!empty($_POST['lieu'])) && (!empty($_POST['adressepostale'])) && (!empty($_POST['email'])) && (!empty($_POST['site'])) && (!empty($_POST['telephone'])) && (!empty($_POST['semestre']))&& (!empty($_POST['connaissances']))){

    //Etape 5: La fonction escape_string permet d'échaper tous les caractères spéciaux que pourra saisir l'utilisateur
    $nom = $idcom->escape_string($_POST['nom']);
    $prenom = $idcom->escape_string($_POST['prenom']);
    $ladate = $idcom->escape_string($_POST['ladate']);
    $lieu = $idcom->escape_string($_POST['lieu']);
    $adressepostale = $idcom->escape_string($_POST['adressepostale']);
    $email = $idcom->escape_string($_POST['email']);
    $site = $idcom->escape_string($_POST['site']);
    $telephone = $idcom->escape_string($_POST['telephone']);
    $semestre = $idcom->escape_string($_POST['semestre']);
   // $connaissanceUser = $idcom->$_POST['connaissances'];



    //Etape 6: Ecrire la requête
    $requete = "INSERT INTO utilisateurs(nom, prenom, ladate,lieu,adressepostale,email,site,telephone,semestre) VALUES ('$nom', '$prenom','$ladate','$lieu','$adressepostale','$email','$site','$telephone','$semestre')";
    //$requete1= "SELECT id from connaissance where id in $connaissances"
    //Etape 7: Envoyer la requete au serveur en utilisant la fonction query de la classe mysqli
    $result = $idcom->query($requete);
    $identUser= $idcom->insert_id;
    echo $identUser ;

    foreach ($_POST['connaissances'] as $valeur){
     echo "votre connaissance " .$valeur;
     $requete1= "SELECT id from connaissance where nom='$valeur'" ;
     $result1 = $idcom->query($requete1);
     $row = $result1 -> fetch_assoc() ;     
       echo  "rownsid" .$row['id'] ;
       $idCon= $row['id'];
     
     
    
     //$result1 = $idcom->query($requete1);
     $requete1= "INSERT into connaissance_utilisateurs(id_utilisateur,id_connaissance) VALUES ($identUser, $idCon)" ;
     echo "requete" .$requete1 ;
     $result1 = $idcom->query($requete1);
    }
    //$result1 = $idcom->query($requete1);
    //Etape 8: On vérifie si la requete a bien été exécuté/recue au niveau du serveur mysql
    
    if($result){
        echo "Vous avez bien été enregistré au numéro :".$idcom->insert_id;
    }
    else { echo "Erreur ".$idcom->error;}
    //if($result1){
    //    echo "Vous avez bssssssé au numéro :".$result1;
    //}
    //else { echo "Erreur zzzz".$idcom->error;}

    //Etape 9 et dernière étape: On ferme la connexion
    $idcom->close();
}
else {echo "Veuillez remplir la formulaire"; 
}
?>