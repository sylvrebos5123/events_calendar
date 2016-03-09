<?php

//$json = '{"a":1,"b":2,"c":3,"d":4,"e":5}';
 
//var_dump(json_decode($json));
//var_dump(json_decode($json, true));


$array=array(
"title"=>"blabla",
"start"=>"2016-03-08",
"end"=>"2016-03-10"
);

echo '['.json_encode($array).']';