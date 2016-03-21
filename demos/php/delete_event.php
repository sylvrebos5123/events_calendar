<?php
//var_dump($_POST);


require dirname(__FILE__) . '/connect_db.php';
//echo $_POST['id_event'];
if(isset($_POST['id_event']))
{

    $query = $db->prepare("delete from events
                          where id_event=:id_event ;");

    $query->bindValue(':id_event', $_POST['id_event'], PDO::PARAM_INT);
}


$query->execute();

//var_dump($query);
