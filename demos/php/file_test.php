<?php


//require dirname(__FILE__) . '/utils.php';
require dirname(__FILE__) . '/connect_db.php';


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

$output_arrays[9]['id']=100;
$output_arrays[9]['title']='Event to repeat';
$output_arrays[9]['start']='2016-06-10T13:00:00';
$output_arrays[9]['end']='2016-06-10T16:00:00';

$j=1;

for($i=0;$i<3;$i++)
{
    $nb_days=14*($i + 1);
    $output_arrays[9+$j]['id']=100;
    $output_arrays[9+$j]['title']='Event to repeat (repeat)';
    $output_arrays[9+$j]['start']=date('Y-m-d', strtotime("2016-06-10 +".$nb_days." days")).'T13:00:00';
    $output_arrays[9+$j]['end']=date('Y-m-d', strtotime("2016-06-10 +".$nb_days." days")).'T16:00:00';

    $j++;
}


//echo date('Y-m-d', strtotime("+30 days"));
echo json_encode($output_arrays);
