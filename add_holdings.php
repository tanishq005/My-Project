

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
		$publisher=$_POST['publisher'];
		$issn=$_POST['issn'];
		$eissn=$_POST['eissn'];
		$sql=("SELECT `name` FROM `institute_details` WHERE `username`='$user'");
		$result=$db->query($sql);
		$r=mysqli_fetch_assoc($result);
		$name=$r['name'];
		$sql2=("SELECT * FROM `catalog` WHERE `title`='$title' AND `institute`='$name'");
		$result2=$db->query($sql2);
		if($result2->num_rows>=1)
		{
			die(" <div class=\"alert alert-danger\"><center><h3>You cannot create duplicate record for $title. <br>
				Record already exist <br>
				For edit holdings : <a href=\"/design/select_catalog.php?page=1&query=$title\">Click Here </a>

				</h3></center></div>
				");
		}
		
		echo "<div class=\"panel panel-default\">
				<div class=\"panel-body\">
					Add Holdings for <b>$title</b>
				</div>
			  </div>
			 "; 


		echo " <div class=\"col-sm-12\">
					<form action=\"process_holdings.php\" method=\"post\">
						<div class=\"form-group\">
							<label>Title</label>
							<input type=\"text\" class=\"form-control\" name=\"title\"  value=\"$title\" readonly/>
							<label>Publisher</label>
							<input type=\"text\" class=\"form-control\" name=\"publisher\"  value=\"$publisher\" readonly/>
							<label>Issn</label>
							<input type=\"text\" class=\"form-control\" name=\"issn\"  value=\"$issn\" readonly/>
							<label>E-Issn</label>
							<input type=\"text\" class=\"form-control\" name=\"eissn\"  value=\"$eissn\" readonly/>
							<label>Holdings</label>
							<textarea name=\"holdings\" class=\"form-control\" autofocus required=\"required\"> </textarea>
								<label> Availability</label><br>
								<label class=\"checkbox-inline\"><input type=\"radio\" value=\"Print\" name=\"availability\"  class=\"form-control\"/>Print</label>
								<label class=\"checkbox-inline\"><input type=\"radio\" value=\"Print+Online\" name=\"availability\" class=\"form-control\"  />Print+Online</label>
								<label class=\"checkbox-inline\"><input type=\"radio\" value=\"Online\" name=\"availability\" class=\" form-control\" />Online</label>
								<br><br>
							<button class=\"btn btn-success\">Submit</button>
						</div>
					</form>			
				
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