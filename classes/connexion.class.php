<?php

    class Connexion{

       public static function connectMYSQL(){

        //**************SQL SERVER************//

        // Identifiants pour la base de donnée SQL SERVER
       
        $SQL_SERV="mysql:host=localhost;port=3306;dbname=social-work-workshop;charset=utf8mb4";
        $SQL_USERNAME="Admin2";
        $SQL_PASSWORD="WorkShop123";
        
        try
        {
            $connexion=new PDO ($SQL_SERV,$SQL_USERNAME,$SQL_PASSWORD);
        }
        catch(Exeption $e)
        {
            echo "Erreur de connexion ! :".$e->getMessage()."<br>";
        }

        return $connexion;


    }
}

?>
