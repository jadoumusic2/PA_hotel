<?php
    try{
         $db = new PDO("mysql:host=54.38.33.8;dbname=projetA" , "distant" , "cisco");
    }catch(Exception $e){
		die("Erreur" . $e->getMessage());
    }
?>
