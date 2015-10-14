<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Untitled Document</title>
</head>

<body>


<?php
$db=new mysqli('127.0.0.1','root','','web');
if ($db->connect_errno){
die("Sorry we are facing some issue right now");		// To protect from unauthorized view of the databse path
}			

?>
</body>
</html>