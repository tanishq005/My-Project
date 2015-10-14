<?php
require "connect_catalog.php";
$query=$_REQUEST['query'];
$res=array();
$result = $db->query("SELECT DISTINCT `title` FROM `master_catalog` WHERE `title` LIKE '$query%' LIMIT 0,10");
//print_r($result);
    foreach ($result as $row)
     {
     	$res[]=$row['title'];
     }
     //var_dump($res);

     echo json_encode($res);
?>