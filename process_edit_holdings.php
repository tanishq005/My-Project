
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
						<?php require "addition.php" ?> 
						<?php echo "$dropdown"; ?>
						<li><a href="search_institute.php">By Institute</a></li>
						<li><a href="search_city.php">By City</a></li>
						<li><a href="#">Contact Us</a></li>
					</ul>



				</div>

			</div>
			

		</div>
		<?php
		if(empty($_POST['title']))
			{
				die("<h2>Empty Token</h2> <a href=\"institute_profile.php\">Go Back</a>");	
			}
		$title=$_POST['title'];
		$holdings=$_POST['holdings'];
		$availability=$_POST['availability'];
		$sql1=("SELECT * FROM `institute_details` WHERE `username` = '$user'");
		$result1=$db->query($sql1);
		$row=mysqli_fetch_assoc($result1);
		$name=$row['name'];
		$sql2=("UPDATE `catalog` SET `holdings`='$holdings',`availability`='$availability' WHERE `title`='$title' AND `institute`='$name' ");

		if($db->query($sql2))
			{
				echo " <h2>Data Edited Successfully</h2>

				<a href=\"edit_catalog.php\">Go Back</a>


				";
			}
		else
			{
				echo "Error: Contact Administrator";
			}		
		

		



			
		?>


		<div class="container body-content">
			<div style="height:65px;"></div>    <!-- This div is added becouse footer is overlapping the actual contents-->
		</div>
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