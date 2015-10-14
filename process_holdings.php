
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
						<li><a href="#">Contact Us</a></li>
						<?php 
						session_start();
						if(!empty($_SESSION['username']))
						{	$name=$_SESSION['username'];
							echo "<li> <a href=\"logout.php\"><b>Log Out ($name)</b></a></li>
							";
						}
						?>
					</ul>



				</div>

			</div>
			

		</div>
		<?php
		if(empty($_POST['title']))
			{
				die("<h2>Empty Token</h2> <a href=\"add_catalog_new.php\">Go Back</a>");	
			}
		$title=$_POST['title'];
		$publisher=$_POST['publisher'];
		$issn=$_POST['issn'];
		$eissn=$_POST['eissn'];
		$holdings=$_POST['holdings'];
		if(empty($_POST['availability']))
			{
				die("<h2>Empty Token</h2> <a href=\"add_catalog_new.php\">Go Back</a>");	
			}
		$availability=$_POST['availability'];
		$sql1=("SELECT * FROM `institute_details` WHERE `username` = '$user'");
		$result1=$db->query($sql1);
		$row=mysqli_fetch_assoc($result1);
		$name=$row['name'];
		$city=$row['city'];
		$description=NULL;

		$sql2=("INSERT INTO `catalog`(`title`, `institute`, `holdings`, `availability`, `publisher`, `issn`, `eissn`, `description`,`city`)
				VALUES ('$title','$name','$holdings','$availability','$publisher','$issn','$eissn','$description','$city')");
		if($db->query($sql2))
			{
				echo " <div class=\"alert alert-success\"><center><h2>Data Submitted Successfully</h2>
				

				<a href=\"add_catalog_new.php\"><button class=\"btn btn-default\">Go Back </button></a></center> </div>


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