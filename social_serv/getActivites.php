<?php 

    //Variables de conenxion :
    header('Content-Type: application/json');


    require_once('../classes/connexion.class.php');
    
    $connexion=Connexion::connectMSSQL();

    //Lecture des séries
    function getActivities(){

        global $connexion;

        $requete = "SELECT * FROM activite a 
        inner join utilisateurs u on u.id_users = a.id_demandeur
        inner join type_activite ta on ta.id_type_activite = a.id_type_activite";
        


        $statut=$connexion->prepare($requete);
        $statut->execute();

        $all=$statut->fetchAll(PDO::FETCH_ASSOC);

        $connexion=null;
        $statut=null; 

        return $all;
    }

    //Génération de la chaine JSON
    
    echo json_encode(getActivities(),JSON_UNESCAPED_UNICODE);




?>