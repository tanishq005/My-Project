<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Untitled Document</title>
</head>

<body>
<?php
error_reporting(E_ALL);
require "connect_catalog.php";
$institute=$_POST['name'];
$issn=$_POST['issn'];
$title=$_POST['title'];
$city=$_POST['city'];
$iname=$_POST['iname'];
$holdings=$_POST['holdings'];
$description=$_POST['description'];

$sql=("INSERT INTO catalog (issn,title,city,institute,holdings,description) VALUES ($issn,'$title','$city','$iname','$holdings','$description')");

if($db->query($sql)===TRUE)
{
	echo "Data is submitted";
}
else
{
	 echo "Error: " . $sql . "<br>" . $db->error;	
}

	
?>
</body>
</html>