<?php 

    //Autochargement des classes
    include ('connexion.class.php');
   

    class socialWork_gestion{

        private $connexion;

        public function __construct(){

            $this->connexion=Connexion::connectMYSQL();
        }

        //********************************************************************/
        //Gestion de l'authentification et de l'enregistement

        //Test d'existence par l'email
        public function userExist($email){

            $sql="SELECT * FROM utilisateurs WHERE email = ?";
            $stmt=$this->connexion->prepare($sql);
            $stmt->bindParam(1,$email,PDO::PARAM_STR);
            $stmt->execute();
            $result=$stmt->fetch();
            return $result !=null;

        }
        //Methode d'enregistrement dans la bdd*****************************
        public function addUser($email,$mdp,$role,$name){
         

            if ($this->userExist($email)){
                return 0;
            }
            else {
               
                if ($email !="" && $mdp!="" && $role!=""  && $name!=""){
                   
                    $hashedMdp= password_hash($mdp,PASSWORD_DEFAULT);
                    $sql="INSERT INTO utilisateurs (email,role,name,mdp) VALUES(?,?,?,?)";
                    $stmt=$this->connexion->prepare($sql);
                    $stmt->bindParam(1,$email,PDO::PARAM_STR);
                    $stmt->bindParam(2,$role,PDO::PARAM_STR);
                    $stmt->bindParam(3,$name,PDO::PARAM_STR);
                    $stmt->bindParam(4,$hashedMdp,PDO::PARAM_STR);

                    if($stmt->execute()){
                        return 1;
                    }
                } 
                else {

                    return 2;
                }
            }

        }

    
        
        //Methode de connexion a la bdd*************************************
        public function loginUser($email,$mdp){

            if($user = $this->getUserByEmail($email)){
                return password_verify($mdp,$user['mdp']);
            }
            else{
                return false;
            }

        }
        //Selection d'un utilisateur à partir de l'email************************
        public function getUserByEmail($email){

            $sql="SELECT * FROM utilisateurs WHERE email = ?";
            $stmt=$this->connexion->prepare($sql);
            $stmt->bindParam(1,$email,PDO::PARAM_STR);
            $stmt->execute();

            return $stmt->fetch(PDO::FETCH_ASSOC);
           
        }


        public function addActivity($date_creation,$places,$id_type_activite,$id_demandeur,$description,$icon_activite,$nom){
         

            $sql="INSERT INTO activite (date_creation,places,id_type_activite,id_demandeur,description,places_actuel,icon_activite,nom) VALUES(?,?,?,?,?,?,?)";
            $stmt=$this->connexion->prepare($sql);
            $stmt->bindParam(1,$date_creation,PDO::PARAM_INT);
            $stmt->bindParam(2,$places,PDO::PARAM_INT);
            $stmt->bindParam(3,$id_type_activite,PDO::PARAM_INT);
            $stmt->bindParam(4,$id_demandeur,PDO::PARAM_INT);
            $stmt->bindParam(5,$description,PDO::PARAM_STR);
            $stmt->bindParam(6,"0",PDO::PARAM_STR);
            $stmt->bindParam(7,$icon_activite,PDO::PARAM_STR);
            $stmt->bindParam(8,$nom,PDO::PARAM_STR);

            if($stmt->execute()){
                return 1;
            }

        }

    }
?>