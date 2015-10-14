<?php
require "connect_catalog.php";
session_start();
$query=$_REQUEST['query'];
$res=array();
$username=$_SESSION['username'];
$sql=("SELECT `name` FROM `institute_details` WHERE `username`='$username'");
$result2=$db->query($sql);
$r=mysqli_fetch_assoc($result2);
$name=$r['name'];
$result = $db->query("SELECT DISTINCT `title` FROM `catalog` WHERE `title` LIKE '$query%' AND `institute`='$name' LIMIT 0,10");
//print_r($result);
    foreach ($result as $row)
     {
     	$res[]=$row['title'];
		
     }

     echo json_encode($res);
?>