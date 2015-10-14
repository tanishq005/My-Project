<!DOCTYPE html>

<html>
	<head>
	
		<title>Catalog of E-Resources</title>
		<meta name="viewport" content="width=device-width,initial-scale=1.0">
		<link href="css/bootstrap.css" rel="stylesheet">
		<link href="css/styles.css" rel="stylesheet">
	</head>
	<body>
		<div class="navbar navbar-default navbar-static-top ">
			<div class="navbar-brand">
					<ul class="nav navbar-left">
				<a href="index.php">
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
		<div class="panel panel-inverse">
		  <div class="panel-body">
		   <b>Choose Institute:</b>
		  </div>
		</div>
		 	
		 	<?php
		 	require "connect_catalog.php";
		 	$sql=("SELECT DISTINCT `institute` FROM `catalog` ORDER BY CAST(`institute` AS CHAR ) asc");
		 	$result=$db->query($sql);
		 	echo " <div class=\"container\"> <table class=\"table table-bordered table-hover\">
		 	<th> Institute Name</th>
		 	<th> City </th>
		 	";
		 	foreach($result as $r)
		 		{   $institute=$r['institute'];
		 			$sql2=("SELECT `city` FROM `institute_details` WHERE `name`='$institute'");
		 			$result2=$db->query($sql2);
		 			
		 			$res=mysqli_fetch_assoc($result2);
		 			$city=$res['city'];
		 			echo "<tr>
		 			<td><a href=\"institute_catalog.php?query=$institute&page=1\">$institute</td>
		 			<td>$city</td>
		 			</tr>";
		 		}

		 		echo "</div></table>";

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