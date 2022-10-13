<?php 

require_once('../classes/socialWork_gestion.class.php');
header('Content-Type: application/json');

$response=array();

if($_SERVER['REQUEST_METHOD']=="POST"){

    $date_creation = htmlspecialchars($_POST['date_creation']);
    $places = htmlspecialchars($_POST['places']);
    $id_type_activite = htmlspecialchars($_POST['id_type_activite']);
    $id_demandeur = htmlspecialchars($_POST['id_demandeur']);
    $description = htmlspecialchars($_POST['description']);
    $icon_activite = htmlspecialchars($_POST['icon_activite']);
    
    
    
    if (isset($_POST['date_creation']) && !empty($_POST['date_creation']) &&
        isset($_POST['places']) && !empty($_POST['places']) &&  
        isset($_POST['id_type_activite']) && !empty($_POST['id_type_activite']) &&
        isset($_POST['id_demandeur']) && !empty($_POST['id_demandeur']) &&
        isset($_POST['description']) && !empty($_POST['description']) &&
        isset($_POST['icon_activite']) && !empty($_POST['icon_activite'])){

        $locDvd = new socialWork_gestion();
        $result = $locDvd->addActivity($date_creation,$places,$id_type_activite,$id_demandeur,$description,$icon_activite);

        switch ($result) {
       
            case '1': {
                $response['error'] = false;
                $response['message'] ="ajout ok";
                break;
            }
        }
    }
    else {
        $response['error'] = true;
        $response['message'] ="Un ou plusieurs champs obligatoire n'ont pas été remplis.";
    }
    
    
}
else {
    $response['error'] = true;
    $response['message'] ="La méthode n'est pas autorisée";
}
echo json_encode($response,JSON_UNESCAPED_UNICODE);

?>