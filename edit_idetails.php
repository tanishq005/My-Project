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
		$name=$_GET['i'];
		$sql=("SELECT * FROM `institute_details` WHERE `name`='$name'");
		$result=$db->query($sql);
		foreach($result as $r)
		{	$username=$r['username'];
			$city=$r['city'];
			$website=$r['website'];
			$librarian=$r['librarian'];
			$email=$r['email'];
			$sql2=("SELECT `password` FROM `institute` WHERE `username`='$username'");
			$result2=$db->query($sql2);
			$row=mysqli_fetch_assoc($result2);
			$password=$row['password'];
			echo "<div class=\"col-sm-10\">
			<form action=\"process_idetails.php\" method=\"post\">
				<input type=\"hidden\" value=\"$name\" name=\"oldname\" />
				<input type=\"hidden\" value=\"$city\" name=\"oldcity\" />
				<div class=\"form-group\">
					<label>Institute Name</label>
					<input type=\"text\" class=\"form-control\" value=\"$name\" name=\"name\">
				</div>
				<div class=\"form-group\">
					<label>Username</label>
					<input type=\"text\" class=\"form-control\" value=\"$username\" name=\"username\">
				</div>
				<div class=\"form-group\">
					<label>Password</label>
					<input type=\"text\" class=\"form-control\" value=\"$password\" name=\"password\">
				</div>
				<div class=\"form-group\">
					<label>Librarian</label>
					<input type=\"text\" class=\"form-control\" value=\"$librarian\" name=\"librarian\">
				</div>
				<div class=\"form-group\">
					<label>Institute City</label>
					<input type=\"text\" class=\"form-control\" value=\"$city\" name=\"city\">
				</div>
				<div class=\"form-group\">
					<label>Website</label>
					<input type=\"text\" class=\"form-control\" value=\"$website\" name=\"website\">
				</div>
				<div class=\"form-group\">
					<label>E-Mail</label>
					<input type=\"text\" class=\"form-control\" value=\"$email\" name=\"email\">
				</div>
				<button class=\"btn btn-success\">Submit</button>
				</form>
			</div>
			"; 
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