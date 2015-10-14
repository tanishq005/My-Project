<!DOCTYPE html>
<html>
	<head>
		<title>Catalog of E-Resources</title>
		<meta name="viewport" content="width=device-width,initial-scale=1.0">
		<link href="css/bootstrap.min.css" rel="stylesheet">
		<link href="css/styles.css" rel="stylesheet">
	</head>
	<body>
<?php
		session_start();
		require "connect_catalog.php";
		$user=$_SESSION['username'];
		$pass=$_SESSION['password'];
		$sql=("SELECT * FROM `admin` WHERE `username` = '$user' AND `password` = '$pass' ");
		$result=$db->query($sql);
		if($result->num_rows==1)
			{
				if (isset($_SESSION['username']))
					{	
						if($_SESSION['permission']!="all")
							die("access denied <a href=\"index.php\">Go back</a>");
						else
						{	
							goto body;
						}
					}

				else
					header("location: index.php");	
			}
			else
				{
					header("location: index.php");	
				}	



		body:
		if(!isset($_POST['institute_username']))
			{	
				die("Empty Token <br> <a href=\"admin.php\">Go Back</a>");
			}
		$username=$_POST['institute_username'];	
		$name=$_POST['institute_name'];
		$password=$_POST['institute_password'];
		$librarian=$_POST['institute_name_librarian'];	
		$city=$_POST['institute_city'];
		$website=$_POST['institute_website'];
		$email=$_POST['institute_mail'];
		$sql=("INSERT INTO `institute_details`(`username`, `name`, `city`, `website`, `librarian`, `email`) 
			VALUES ('$username','$name','$city','$website','$librarian','$email')");
		if($db->query($sql))
		{
			$sql2=("INSERT INTO `institute`( `username`, `password`, `permission`,`search_log`) 
				VALUES ('$username','$password','partial','0')");
			if($db->query($sql2))
			{
				echo "<div class=\"alert alert-success\"><center>Institute Created Successfully
				<br> <a href=\"admin.php\"> Go Back </a>
				</center>";
			}
		}


?>
</body>
