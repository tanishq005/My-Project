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
		

							<!-- Main Starts -->
		
								


			 <?php

				 require "connect_catalog.php";
				 $query=$_GET['q'];
			 	 $institute=$_GET['insti'];
			 	 $city=$_GET['city'];
			 	 $availability=$_GET['availability'];
				 $sql=("SELECT * FROM `catalog` WHERE `title`='$query' AND `institute` LIKE'%$institute%' AND `availability` LIKE '%$availability%' AND `city` LIKE '%$city%' ");
				 $result=$db->query($sql);
				 $sql2=("SELECT * FROM `catalog` WHERE `title` = '$query' ORDER BY 'institute' ASC");
				 $result2=$db->query($sql2);
				 $r2=mysqli_fetch_assoc($result2);
				 $publisher=$r2['publisher'];
				 $issn=$r2['issn'];
				 $eissn=$r2['eissn'];
				 echo "<div class=\"panel panel-default\">								
						<div class=\"panel-body\">
						<h4><b> <center>Title: $query 
						  <br><br>Publisher: $publisher <br><br>(ISSN -: $issn)";
				if(!empty($eissn))
				echo " (E-ISSN -: $eissn)";		  
						  echo "</center></b></h4>
						</div>
						</div>"; 	
				
				 function emptycheck($x,$y)					//this function will check if there is only one refiner left or multiple
				 {
				 	if(empty($x)&&empty($y))
				 		return 1;
				 }
				echo "<div class=\"panel panel-default\">								
						<div class=\"panel-body\">
						<b>Search Refined By:</b><br>";
						if(!empty($institute))
							{
								echo "Institute:<b>$institute</b>";
								if (emptycheck($availability,$city))
								echo "<a href=\"show_bytitle.php?q=$query\"><span class=\"glyphicon glyphicon-remove\"></span></a><br>";
								else
								echo "<a href=\"refine_bytitle.php?q=$query&city=$city&availability=$availability&insti\"><span class=\"glyphicon glyphicon-remove\"></span></a><br>";
							}

						if(!empty($city))
							{
								echo "City:<b>$city</b>";
								if (emptycheck($availability,$institute))
								echo "<a href=\"show_bytitle.php?q=$query\"><span class=\"glyphicon glyphicon-remove\"></span></a><br>";
								else
								echo "<a href=\"refine_bytitle.php?q=$query&city&availability=$availability&insti=$institute\"><span class=\"glyphicon glyphicon-remove\"></span></a><br>";
							}
						if(!empty($availability))
							{
								echo "availability:<b>$availability</b>";
								if (emptycheck($city,$institute))
								echo "<a href=\"show_bytitle.php?q=$query\"><span class=\"glyphicon glyphicon-remove\"></span></a><br>";
								else
								echo "<a href=\"refine_bytitle.php?q=$query&city=$city&page=1&availability&insti=$institute\"><span class=\"glyphicon glyphicon-remove\"></span></a><br>";
							}
						echo "<b>Clear all </b><a href=\"show_bytitle.php?q=$query\"><span class=\"glyphicon glyphicon-remove\"></span></a>";	
						echo " </div></div></div>";	



				 echo "<div class=\"col-sm-12\"> <table class=\"table table-hover table-bordered\">
					<tr>
					<th>Institute</th>
					<th>City</th>
					<th>Availability</th>
					<th>Holdings</th>
					<th>Publisher</th>
					<th>Action</th>
					</tr>";
				 foreach($result as $row)
				 	{	$query=$row['title'];
				 		$institute=$row['institute'];
				 		$issn=$row['issn'];
				 		$city=$row['city'];
				 		$availability=$row['availability'];
				 		$holdings=$row['holdings'];
				 		$availability=$row['availability'];

				 		echo " <tr>
								<td>$institute</td>
								<td>$city</td>
								<td>$availability</td>
								<td>$holdings</td>
								<td>$availability</td>
								<td><button type=\"button\" class=\"btn btn-default btn-lg\" data-toggle=\"modal\" 
								data-target=\"#mymodal\">Send Mail</button></td>
								</tr>";		

				 	}
			?>		

			
		</table>
		</div>
		
		<div class="modal fade" id="mymodal" tabindex="-1" role="dialog" aria-labbeledby="myModalLabel" >
			<div class="modal-dialog" role="document" >
				<div class="modal-content" style="height:450px; width=600px;">
					<div class="modal-body" style="height:450px; width=600px;">
							<iframe src="send_mail.php" height="100%" width="100%"></iframe>
					</div>
				</div>
			</div>
		</div>				
		</div>



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