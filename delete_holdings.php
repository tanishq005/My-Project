
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
				die("<h2>Empty Token</h2> <a href=\"institute_profile.php\">Go Back</a>");	
			}
		$title=$_POST['title'];
		$sql1=("SELECT * FROM `institute_details` WHERE `username` = '$user'");
		$result1=$db->query($sql1);
		$row=mysqli_fetch_assoc($result1);
		$name=$row['name'];
		

		
		echo "<div class=\"panel panel-default\">
				<div class=\"panel-body\">
					Delete Holdings for <b>$title</b>
				</div>
			  </div>
			 "; 


		echo " <div class=\"col-sm-5\"><h2> Confirm Delete</h2>
				<form action=\"confirm_delete.php\" method=\"post\">
				<div class=\"form-group\">
				<input type=\"hidden\" value=\"$title\" name=\"title\">
				<input type=\"hidden\" value=\"$name\" name=\"institute\">
				<button class=\"btn btn-danger\">Yes</button>
				</div>
				</form>	
				<form class=\"form-group\" action=\"institute_profile.php\">
				<div class=\"form-group\">
				<button class=\"btn btn-success\">No</button>
				</div>
				</form>
				</div>
			

			";



			
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