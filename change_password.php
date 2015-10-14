<!DOCTYPE html>
<html>
	<head>
		<title>Catalog of E-Resources</title>
		<meta name="viewport" content="width=device-width,initial-scale=1.0">
		<link href="css/bootstrap.min.css" rel="stylesheet">
		<link href="styles.css" rel="stylesheet">
		<script type="text/javascript">
		function validate()
		{
			var x=document.getElementById("pass1").value;
			var y=document.getElementById("pass2").value;
			if(x!=y)
				{
					alert("Password do not match");
					return false;
				}
			else
			return true;	
		}
		</script>
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
		<div class="navbar navbar-default navbar-static-top navbar-fixed-top">
			<div class="navbar-brand">
					<ul class="nav navbar-left">
				<a href="institute_profile.php">
				<span class="glyphicon glyphicon-arrow-left"></span>
				</a> 
				</ul>
				</div>
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
				echo   "<div class=\"panel panel-default \">
							<div class=\"panel-body\">
								<h2>Welcome $user</h2>
								<h3><a href=\"logout.php\">LOG OUT</a></h3>
							</div>
						</div>";
				echo 	"<div class=\"col-sm-5\"><form action=\"process_password.php\" method=\"post\" onsubmit=\"return validate()\">
							<div class=\"form-group\">
								<label>Password</label>
								<input type=\"password\" name=\"pass1\" id=\"pass1\" class=\"form-control\">
							</div>	
							<div class=\"form-group\">
								<label>Confirm Password</label> 
								<input type=\"password\" name=\"pass2\" id=\"pass2\" class=\"form-control\"  />
							</div>
							<button class=\"btn btn-success\" >Change</button>
						</form></div>";	 

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