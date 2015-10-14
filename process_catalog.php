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


		body:
		$sql=("SELECT * FROM `institute_details` WHERE `username`='$user'");
		$result=$db->query($sql);
		$r=mysqli_fetch_assoc($result);
		$institute=$r['name'];
		$city=$r['city'];
		if(empty($_POST['title']))
			die("Token Empty<br> <a href=\"add_catalog.php\">Go back</a>");
		$title=$_POST['title'];
		$publisher=$_POST['publisher'];
		$holdings=$_POST['holdings'];
		$availability=$_POST['availability'];
		$issn=$_POST['issn'];
		$eissn=$_POST['eissn'];
		$description=$_POST['description'];
		$purl=$_POST['purl'];

		$sql2=("INSERT INTO `catalog`(`title`, `institute`, `holdings`, `availability`, `publisher`, `issn`, `eissn`, `description`,`city`,`title_url`) 
			VALUES ('$title','$institute','$holdings','$availability','$publisher','$issn','$eissn','$description','$city','$purl')");
		$result2=$db->query($sql2);
		//echo $sql2;
		//echo var_dump($result2);
		if(mysqli_affected_rows($db)==1)
			{	 
				echo "Data Submitted Successfully<br>";
				echo "<a href=\"institute_profile.php\">Go Back</a>";

			}
?>


