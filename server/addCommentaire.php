<?php 

require_once('../classes/locDvd_gestion.class.php');
$response=array();

if($_SERVER['REQUEST_METHOD']=="POST"){

    if (isset($_POST['leCommentaire']) ){

        $locDvd = new locDvdSerie_gestion();
        $result = $locDvd->addCommentaire($_POST['idUser'],$_POST['idDvd'],$_POST['leCommentaire']);

        switch ($result) {
            case '0': {
                $response['error'] = true;
                $response['message'] ="Merci de ne pas laisser ce champ vide !";
                break;
            }
            case '1': {
                $response['error'] = false;
                $response['message'] ="ajout ok";
                break;
            }
        }
    }
    else {
        $response['error'] = true;
        $response['message'] ="Merci de ne pas laisser ce champ vide";
    }
    
    
}
echo json_encode($response,JSON_UNESCAPED_UNICODE);

?>