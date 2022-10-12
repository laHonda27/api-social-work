<?php 

header('Content-Type: application/json');

require_once('../classes/locDvd_gestion.class.php');
$response=array();

if($_SERVER['REQUEST_METHOD']=="POST"){

        $locDvd = new locDvdSerie_gestion();
        $result = $locDvd->addDvd($_POST['idUser'],$_POST['idDvd']);

        switch ($result) {
            case '1': {
                $response['error'] = false;
                $response['message'] =" a bien été ajouter !";
                break;
            }
            case '0': {
                $response['error'] = true;
                $response['message'] ="Vous avez déja ce dvd !";
                break;
            }
        }
    
}
echo json_encode($response,JSON_UNESCAPED_UNICODE);

?>