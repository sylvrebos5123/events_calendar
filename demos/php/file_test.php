<?php


require dirname(__FILE__) . '/utils.php';

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


$query = $db->prepare('SELECT * FROM events WHERE status=1;');

$query->execute();

$array_events=$query->fetchAll();
$output_arrays=array();
$i=0;
//print_r($array_events);
foreach ($array_events as $k=>$v) {
    $output_arrays[$i]['id']=$v->id_event;
    $output_arrays[$i]['title']=$v->event_title.' - '.$v->event_place;
    //$output_arrays[$i]['start']=($v->start_time=='00:00:00')?$v->start_date : $v->start_date.'T'.$v->start_time;
    //$output_arrays[$i]['end']=($v->end_time=='00:00:00')?$v->end_date : $v->end_date.'T'.$v->end_time;
    $output_arrays[$i]['start']=$v->start_date_time;
    $output_arrays[$i]['end']=$v->end_date_time;
    $i++;
}

echo json_encode($output_arrays);
