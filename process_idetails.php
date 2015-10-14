<?php require "addition.php" ?> 
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
	?>

	<?php body: ?>    <!-- GOTO label -->
	<body>
		<div class="navbar navbar-default navbar-static-top ">
			<div class="container">
				
				<a href="index.php" class="navbar-brand">Union Catalog Of E-Resources</a>
				<div class="navbar-header">
					<button class="navbar-toggle" data-toggle="collapse" data-target=".navHeaderCollapse">
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
					</button>
				</div>
			
				<div class="collapse navbar-collapse navHeaderCollapse">
					<ul class="nav navbar-nav navbar-right">
						<?php echo "$dropdown"; ?>
						<li><a href="search_institute.php">By Institute</a></li>
						<li><a href="search_city.php">By City</a></li>
						<li><a href="#">Contact Us</a></li>
					</ul>
				</div>
			</div>
		</div>
		<?php
		$name=$_POST['name'];
		$oldname=$_POST['oldname'];
		$oldcity=$_POST['oldcity'];
		$username=$_POST['username'];
		$password=$_POST['password'];
		$librarian=$_POST['librarian'];
		$city=$_POST['city'];
		$website=$_POST['website'];
		$email=$_POST['email'];

		$sql=("UPDATE `institute_details` SET `username`='$username',`city`='$city',`website`='$website',`email`='$email' WHERE `name`='$name'");
		if($db->query($sql))
		{	
			$sql2=("UPDATE `institute` SET `password`='$password' WHERE `username`='$username'");
			if($db->query($sql2))
			{
				echo "<div class=\"alert alert-success\"><center>Institute Edited Successfully
				<br> <a href=\"admin.php\"> Go Back </a>
				</center>";
			}	
		}
		if($name!=$oldname)
		{
			$sql3=("UPDATE `catalog` SET `institute`='$name' WHERE `institute`='$oldname'");
			$update2=$db->query($sql3);
			
		}	
		if($city!=$oldcity)
		{	
			$sql3=("UPDATE `catalog` SET `city`='$city' WHERE `city`='$oldcity'");
			$update2=$db->query($sql3);
			
		}	


		?>
		<div class="container body-content">
			<div style="height:65px;"></div>    <!-- This div is added becouse footer is overlapping the actual contents-->
		</div>


		
		<div class = "navbar navbar-inverse navbar-fixed-bottom">
               
                        <div class = "container">
                                <p class = "navbar-text pull-left">Site Built By IIT Gandhi Nagar</p>
                                <p class = "navbar-text pull-right"><a href="privacy_policy.php">Privacy Policy</a></p>
                              
                        </div>
               
                </div>
		<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"> </script>
		<script src="js/bootstrap.min.js"> </script>
	</body>
</html>				