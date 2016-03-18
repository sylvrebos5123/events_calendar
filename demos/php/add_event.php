<?php
var_dump($_GET);
if(isset($_GET))
{

    foreach($_GET as $k=>$v)
    {
        $_GET[$k]=htmlspecialchars($_GET[$k]);
    }
}
else
{
    die('Input value not found');
}

require dirname(__FILE__) . '/connect_db.php';
echo $_GET['id_event'];
if($_GET['id_event']==0)
{
$query = $db->prepare("insert INTO events(event_title,event_place,start_date_time,end_date_time,status)
                                  values (:event_title,:event_place,:start_date_time,:end_date_time,1);");
}
else
{
    $query = $db->prepare("update from events set event_title=:event_title,event_place=:event_place,
                                                  start_date_time=:start_date_time,end_date_time::end_date_time
                                                  where id_event=:id_event ;");
}
$query->bindValue(':id_event', $_GET['id_event'], PDO::PARAM_INT);
$query->bindValue(':event_title', $_GET['event_title'], PDO::PARAM_STR);
$query->bindValue(':event_place', $_GET['event_place'], PDO::PARAM_STR);
$query->bindValue(':start_date_time', $_GET['start_date_time'], PDO::PARAM_STR);
$query->bindValue(':end_date_time', $_GET['end_date_time'], PDO::PARAM_STR);

$query->execute();

//var_dump($query);
