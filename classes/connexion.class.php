<?php

    class Connexion{

       public static function connectMSSQL(){

        //**************SQL SERVER************//

        // Identifiants pour la base de donnée SQL SERVER
       
        $SQL_SERV="mysql:host=localhost;dbname=social-work-workshop;charset=utf8mb4";
        $SQL_USERNAME="root";
        $SQL_PASSWORD="";

        $attributs = array(
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
            PDO::SQLSRV_ATTR_ENCODING => PDO::SQLSRV_ENCODING_SYSTEM
        );
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