<?php
try
{
    $db = new PDO('mysql:host=localhost;dbname=calendar','root',''
    , array(PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES "UTF8"'));

    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION); // Permet de gérer les erreurs sous forme d'exceptions (il faudra donc adpater le code en conséquence)
    $db->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_OBJ); // Permet d'indiquer que l'on souhaite récupérer des objets pour les résultats des requêtes
} catch (PDOException $e) {
    echo 'La connexion à la base de donnée à échoué : ' . $e->getMessage();
    die();
}