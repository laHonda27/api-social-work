<?php 

header('Content-Type: application/json');
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: GET, POST, OPTIONS');
header('Content-type: text/html; charset=UTF-8'); 
header('Access-Control-Allow-Headers: X-Requested-With');


require ('../classes/socialWork_gestion.class.php');



$response=array();

if($_SERVER['REQUEST_METHOD']=="POST"){

    $id_activite = htmlspecialchars($_POST['id_activite']);
    $places_actuel = htmlspecialchars($_POST['places_actuel']);
    
    
    
    if (isset($_POST['id_activite']) && !empty($_POST['id_activite']) &&
        isset($_POST['places_actuel']) && !empty($_POST['places_actuel']) ) {  

        $socialWork = new socialWork_gestion();
        $result = $socialWork->addPlace($id_activite , $places_actuel);

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
    $response['message'] ="La méthode n'est pas autorisée.";
}
echo json_encode($response,JSON_UNESCAPED_UNICODE);

?>