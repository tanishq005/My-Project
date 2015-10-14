<!DOCTYPE html>
<html>
	<head>
		<title>Catalog of E-Resources</title>
		<meta name="viewport" content="width=device-width,initial-scale=1.0">
		<link href="css/bootstrap.min.css" rel="stylesheet">
		<link href="css/styles.css" rel="stylesheet">
	</head>
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
			require "connect.php";
			$name =$_GET['query'];
			$sql=("SELECT * FROM catalog WHERE City='$name'");
			$result=$db->query($sql);
			if($result === FALSE)
			 	{ 
 			   		die(mysql_error()); // error handling
				}
			if($result->num_rows==0)
				{
					die("There is no resource available currently");
				}
				?>
				<div class="panel panel-inverse">
				  <div class="panel-body">
				   <b>Results</b>
				  </div>
				</div>
				<?php
			echo " <div class=\"col-sm-12\"> <table class=\"table table-hover table-striped \"> <tr><td>Title</td><td>City</td><td>Institute</td><td>Holdings</td><td>Last Update</td><td>Action</td></tr>" ;
			foreach($result as $row)
				{  $title=$row['Title'];
					$city=$row['City'];
					$institute=$row['Institute'];
					$holdings=$row['Holdings'];
					$lastupdate=$row['Lastupdate'];
				echo "<tr> <td> $title </td><td>$city</td><td>$institute</td><td>$holdings</td><td>$lastupdate</td>";
				echo "<td><a href=sendmail.php>Send Mail</a></td></tr><br>";

				}
			echo "</table></div> ";
	
?>
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