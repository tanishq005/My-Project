<?php
		session_start();
		require "connect_catalog.php";
		$user=$_SESSION['username'];
		$pass=$_SESSION['password'];
		$sql=("SELECT * FROM `institute` WHERE `username` = '$user' AND `password` = '$pass' ");
		$result=$db->query($sql);
		if($result->num_rows==1)
			{
				if (isset($_SESSION['username']))
					{	
						if($_SESSION['permission']!="partial")
							die("access denied <a href=\"index.php\">Go back</a>");
						else
						{	
							goto body;    // goto statement authenticated user
						}
					}

				else
					header("location: index.php");	
			}
			else
				{
					header("location: index.php");	
				}	
?>
	<?php body:    //<!-- GOTO label -->
		$sql=("SELECT * FROM `institute_details` WHERE `username` = '$user'");
		$result=$db->query($sql);
		$r=mysqli_fetch_assoc($result);
		$oldname=$r['name'];
		$oldcity=$r['city'];

		if(isset($_POST['institute_name']) && !empty($_POST["institute_name"]))   // Because post is always set but it might be empty
			$name=$_POST['institute_name'];
		else
			$name=$r['name'];

		if(isset($_POST['institute_city'])&& !empty($_POST["institute_city"]))
			$city=$_POST['institute_city'];
		else
			$city=$r['city'];

		if(isset($_POST['institute_librarian'])&& !empty($_POST["institute_librarian"]))
			$librarian=$_POST['institute_librarian'];
		else
			$librarian=$r['librarian'];

		if(isset($_POST['institute_website'])&& !empty($_POST["institute_website"]))
			$website=$_POST['institute_website'];
		else
			$website=$r['website'];

		if(isset($_POST['institute_email'])&& !empty($_POST["institute_email"]))
			$email=$_POST['institute_email'];
		else
			$email=$r['email'];
		
	$sql2=(" UPDATE `institute_details` SET `name`='$name',`librarian`='$librarian',`city`='$city',`website`='$website',`email`='$email' WHERE `username`='$user'");
		$update=$db->query($sql2);
		if($name!=$r['name'])
		{	
			$sql3=("UPDATE `catalog` SET `institute`='$name' WHERE `institute`='$oldname'");
			$update2=$db->query($sql3);
			
		}	
		if($city!=$oldcity)
		{	
			$sql3=("UPDATE `catalog` SET `city`='$city' WHERE `city`='$oldcity'");
			$update2=$db->query($sql3);
			
		}	
		
		header("location: institute_profile.php");

			







	?>    

