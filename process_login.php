
<!DOCTYPE html>
<html>
	<head>
		<title>Catalog of E-Resources</title>
		<meta name="viewport" content="width=device-width,initial-scale=1.0">
		<link href="css/bootstrap.min.css" rel="stylesheet">
		<link href="css/styles.css" rel="stylesheet">
	</head>
<?php
session_start();
require "connect_catalog.php";
if(!isset($_POST['username'])||!isset($_POST['password']))
	{	header("location: index.php");
		die("Access Denied");
	}
$user=mysqli_real_escape_string($db, $_POST['username']);	
//$user=$_POST['username'];
$pass=mysqli_real_escape_string($db, $_POST['password']);
//$_POST['password'];
$sql=("SELECT * FROM `admin` WHERE `username` = '$user' AND `password` = '$pass' ");
$result=$db->query($sql);
if($result->num_rows==1)
{
	$_SESSION['username']=$user;
	$_SESSION['password']=$pass;
	$r=mysqli_fetch_assoc($result);
	$_SESSION['permission']=$r['permission'];
	header("location: admin.php");
}
$sql=("SELECT * FROM `institute` WHERE `username` = '$user' AND `password` = '$pass' ");
$result=$db->query($sql);
if($result->num_rows==1)
{
	$_SESSION['username']=$user;
	$_SESSION['password']=$pass;
	$r=mysqli_fetch_assoc($result);
	$_SESSION['permission']=$r['permission'];
	header("location: institute_profile.php");
}
$sql=("SELECT * FROM `users` WHERE `username` = '$user' AND `password` = '$pass' ");
$result=$db->query($sql);
if($result->num_rows==1)
{
	$_SESSION['username']=$user;
	$_SESSION['password']=$pass;
	$r=mysqli_fetch_assoc($result);
	$_SESSION['permission']=$r['permission'];
	header("location: profile.php");
}
echo "<center><h3><div class=\"alert-success\">Invalid credentials<br>";

die("<a href=\"index.php\"> Go Back</a>");
echo "</div></h3></center>";



?>
</html>