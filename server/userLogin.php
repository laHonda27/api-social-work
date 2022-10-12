<?php 

require_once('../classes/socialWork_gestion.class.php');

$response=array();

if($_SERVER['REQUEST_METHOD']=="POST"){

    if (isset($_POST['email']) && isset($_POST['mdp'])){

        $socialWork = new socialWork_gestion();

        if ($socialWork->loginUser($_POST['email'],$_POST['mdp'])){

            $user = $socialWork->getUserByEmail($_POST['email']);
            $response['error'] = false;
            $response['id'] = $user['id_users'];
            $response['message'] = 'bonjour '.$user['prenom'];

        } else {

            $response['error'] = true;
            $response['message'] = "Nous n'avons pas reconnu vos identifiants ! \nRéessayer.. ";
        }
    }
}


echo json_encode($response);

?>