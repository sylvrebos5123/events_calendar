<?php
//var_dump($_POST);
if(isset($_POST))
{

    foreach($_POST as $k=>$v)
    {
        $_POST['id_event']=(int)$_POST['id_event'];
        $_POST[$k]=trim(htmlspecialchars($_POST[$k]));
    }
}
else
{
    die('Input value not found');
}

require dirname(__FILE__) . '/connect_db.php';
//echo $_POST['id_event'];

if($_POST['id_event']==0) //insert
{
    $query = $db->prepare("insert INTO events(event_title,event_place,start_date_time,end_date_time,status)
                                  values (:event_title,:event_place,:start_date_time,:end_date_time,1);");
}
else //update
{
    $query = $db->prepare("update events set event_title=:event_title , event_place=:event_place ,
                                                  start_date_time=:start_date_time , end_date_time=:end_date_time
                                                  where id_event=:id_event ;");
    $query->bindValue(':id_event', $_POST['id_event'], PDO::PARAM_INT);
}

$query->bindValue(':event_title', $_POST['event_title'], PDO::PARAM_STR);
$query->bindValue(':event_place', $_POST['event_place'], PDO::PARAM_STR);
$query->bindValue(':start_date_time', $_POST['start_date_time'], PDO::PARAM_STR);
$query->bindValue(':end_date_time', $_POST['end_date_time'], PDO::PARAM_STR);

$query->execute();

//var_dump($query);
