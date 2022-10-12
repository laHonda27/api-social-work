<?php 

    //Variables de conenxion :
    header('Content-Type: application/json');


    require('../classes/connexion.class.php');
    
    $connexion=Connexion::connectMYSQL();

    //Lecture des séries
    function getUsers(){

        global $connexion;

        $requete = "SELECT * FROM utilisateurs";


        $statut=$connexion->prepare($requete);
        $statut->execute();

        $all=$statut->fetchAll(PDO::FETCH_ASSOC);

        $connexion=null;
        $statut=null; 

        return $all;
    }

    //Génération de la chaine JSON
    
    echo json_encode(getUsers(),JSON_UNESCAPED_UNICODE);




?>