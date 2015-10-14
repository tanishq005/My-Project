
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
				<div class="navbar-brand">
					<ul class="nav navbar-left">
				<a href="admin.php">
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
			echo "<div class=\"panel panel-default\">
						<div class=\"panel-body\">
							<h3>Add new Institute</h3>
							<h3><a href=\"logout.php\">LOG OUT</a></h3>
						</div>
					</div>";	

			echo    "<div class=\"col-sm-6\">
						<form action=\"process_institute.php\" method=\"post\">
							<div class=\"form-group\">
								<label> Institute Name </label>
									<input type=\"text\" name=\"institute_name\" class=\"form-control\" autofocus required=\"required\">
							</div>
							<div class=\"form-group\">
								<label> Librarian Name </label>
									<input type=\"text\" name=\"institute_name_librarian\" class=\"form-control\" autofocus required=\"required\">
							</div>
							<div class=\"form-group\">
								<label> Institute Username </label>
									<input type=\"text\" name=\"institute_username\" class=\"form-control\" autofocus required=\"required\">
							</div>
							<div class=\"form-group\">
								<label> Password </label>
									<input type=\"password\" name=\"institute_password\" class=\"form-control\" autofocus required=\"required\">
							</div>
							<div class=\"form-group\">
								<label> City </label>
									<input type=\"text\" name=\"institute_city\" class=\"form-control\" autofocus required=\"required\">
							</div>
							<div class=\"form-group\">
								<label> Institute Website </label>
									<input type=\"text\" name=\"institute_website\" class=\"form-control\" autofocus required=\"required\">
							</div>
							<div class=\"form-group\">
								<label> Institute E-Mail</label>
									<input type=\"text\" name=\"institute_mail\" class=\"form-control\" autofocus required=\"required\">
							</div>
							<button class=\"btn btn-success\">Create</button>		
						</form>
					</div>";			
		?>
		<div class="container body-content">
			<div style="height:65px;"></div>    <!-- This div is added becouse footer is overlapping the actual contents-->
		</div>

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