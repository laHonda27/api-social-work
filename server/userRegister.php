<?php 

require_once('../classes/socialWork_gestion.class.php');
$response=array();
if($_SERVER['REQUEST_METHOD']=="POST"){
    if (isset($_POST['email']) && isset($_POST['mdp']) && isset($_POST['role']) && isset($_POST['name']) ){

        $socialWork = new socialWork_gestion();
        $result = $socialWork->addUser($_POST['email'],$_POST['mdp'],$_POST['role'],$_POST['name']);

        switch ($result) {
            case '1': {
                $response['error'] = false;
                $response['state'] = "success";
                $response['message'] ="Votre compte a bien été créer \nRendez-vous sur la page de connexion";
                break;
            }
            case '2': {
                $response['error'] = true;
                $response['state'] = "false";
                $response['message'] ="Des informations sont manquantes !";
                break;
            }
            
            case '0': {
                $response['error'] = true;
                $response['state'] = "false";
                $response['message'] ="Ce mail est déja associer à un compte ! \nVeuillez choisir un autre mail.";
                break;
            }

            default :
                $response['error'] = true;
                $response['state'] = "false";
                $response['message'] ="Erreur";
                break;
        }
    }
    
}
else {
    $response['error'] = true;
    $response['state'] = "false";
    $response['message'] ="Erreur";
}


echo json_encode($response,JSON_UNESCAPED_UNICODE);

?>