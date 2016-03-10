<?php

if(isset($_POST))
{
    foreach($_POST as $k=>$v)
    {
        $_POST[$k]=htmlspecialchars(strip_tags($_POST[$k]));
    }

}

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


$query = $db->prepare("insert INTO events(event_title,event_place,start_date_time,end_date_time,status)
                                  values (:event_title,:event_place,:start_date_time,:end_date_time,1)");

$query->bindValue(':event_title', $_POST['event_title'], PDO::PARAM_STR);
$query->bindValue(':event_place', $_POST['event_place'], PDO::PARAM_STR);
$query->bindValue(':start_date_time', $_POST['start_date_time'], PDO::PARAM_STR);
$query->bindValue(':end_date_time', $_POST['end_date_time'], PDO::PARAM_STR);

$query->execute();