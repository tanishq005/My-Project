
<!DOCTYPE html>
<html>
	<head>
		<title>Catalog of E-Resources</title>
		<meta name="viewport" content="width=device-width,initial-scale=1.0">
		<link href="css/bootstrap.min.css" rel="stylesheet">
		<link href="styles.css" rel="stylesheet">
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
				
				$sql=("SELECT `name` FROM `institute_details` WHERE `username` = '$user'");
				$result=$db->query($sql);
				$r=mysqli_fetch_assoc($result);
				$name=$r['name'];
				
				echo   "<div class=\"container \">
							<div class=\"jumbotron\">
								<h3>Welcome $name</h3>
							</div>
						</div>";
		?> 
		<div class="col-sm-3"></div><div class="col-sm-5">

  <!-- Nav tabs -->
  <ul class="nav nav-tabs" role="tablist">
    <li role="presentation" class="active"><a href="#home" aria-controls="home" role="tab" data-toggle="tab">Home</a></li>
    <li role="presentation"><a href="#profile" aria-controls="profile" role="tab" data-toggle="tab">Profile</a></li>
  </ul>

  <!-- Tab panes -->
  <div class="tab-content">
    <div role="tabpanel" class="tab-pane fade in active" id="home">
    	<table class="table table-condensed table-hover">
			<tr><td><h4><a href="edit_institute_profile.php">Edit Profile</a></h4><br></td></tr>
			<tr><td><h4><a href="add_catalog_new.php">Add Catalog</a></h4><br></td></tr>
			<tr><td><h4><a href="edit_catalog.php">Edit Catalog</a></h4><br></td></tr>
			<tr><td><h4><a href="delete_catalog.php">Delete Catalog</a></h4><br></td></tr>
			<tr><td><h4><a href="change_password.php">Change Password</a></h4><br></td></tr>
		</table>
    </div>
    <div role="tabpanel" class="tab-pane fade" id="profile">
    	<?php 
    		$sql=("SELECT * FROM `institute_details` WHERE `username` = '$user'");
				$result=$db->query($sql);
				$r=mysqli_fetch_assoc($result);	
				$name=$r['name'];
				$city=$r['city'];
				$website=$r['website'];
				$librarian=$r['librarian'];
				$email=$r['email'];	

				echo 	"<div>
							 <table class=\"table table-hover table-condensed\">
								<th><h2>Profile Details</h2><th>
								<tr><td><h4>Institute Name :$name</h4></td></tr>
								<tr><td><h4>Institute City : $city</h4></td></tr>
								<tr><td><h4>Institute Librarian : $librarian</h4></td></tr>
								<tr><td><h4>Institute Website : $website</h4></td></tr>
								<tr><td><h4>Institute E-Mail : $email</h4></td></tr>
							</table> </div>
						";
		?>				
    </div>
  </div>




		<div class="container body-content"> 
			<div style="height:65px;"></div>    <!-- This div is added becouse footer is overlapping the actual contents-->
		</div>
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