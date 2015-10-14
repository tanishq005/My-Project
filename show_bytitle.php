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
				<div class="navbar-brand">
					<ul class="nav navbar-left">
				<a href="javascript:history.back(1);">
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
		<div class="col-sm-12">
						


			 <?php

				 require "connect_catalog.php";
				 $query=$_GET['q'];
				 $sql=("SELECT * FROM `catalog` WHERE `title` = '$query' ORDER BY CAST(`institute` AS CHAR ) asc");
				 //var_dump($sql);
				 $result=$db->query($sql);
				 $r=mysqli_fetch_assoc($result);
				 $publisher=$r['publisher'];
				 $issn=$r['issn'];
				 $eissn=$r['eissn'];
				 $sql1=("SELECT DISTINCT `institute` FROM `catalog` WHERE `title`='$query' ORDER BY `institute` ASC"); 			// sql1 is to get distinct institutes
				$sql2=("SELECT DISTINCT `city` FROM `catalog` WHERE `title`='$query' ORDER BY `city` ASC");					// sql1 is to get distinct cities	
				$sql3=("SELECT DISTINCT `availability` FROM `catalog` WHERE `title`='$query' ORDER BY `availability` ASC");				// sql1 is to get distinct publishers
				$iresult=$db->query($sql1);																		// iresult is result instance of sql1 i.e institute's query	
				$cresult=$db->query($sql2);																		// iresult is result instance of sql1 i.e institute's query
				$presult=$db->query($sql3);
				 echo "<div class=\"panel panel-default\">								
						<div class=\"panel-body\">
						<h4><b> <center>Title:</b> $query 
						  <br><br><b>Publisher:</b> $publisher <br><br>(<b>ISSN</b> -: $issn)";
				if(!empty($eissn))
				echo " (E-ISSN -: $eissn)";		  
						  echo "</center></b></h4>
						</div>
						</div>"; 	
				?>
				<div class="panel panel-default">
			<div class="panel-body">
				<form class="search" action="refine_bytitle.php" method="get"> 
					<input type="hidden" name="q" value="<?php echo "$query";?>">			<!-- To send an extra variable hidden input is used-->
						<div class="col-sm-3">
							<div class="form-group">
								<select class="form-control"  name ="insti"><option value="">Institute</option>
								<?php foreach($iresult as $r1) { $insti=$r1['institute']; echo "<option value=\"$insti\">$insti</option>";}?></select> 
							</div>	
						</div>
						<div class="col-sm-3">
							<div class="form-group">
								<select class="form-control" name="city"><option value="">City</option>
								<?php foreach($cresult as $r1) { $city=$r1['city']; echo "<option value=\"$city\">$city</option>";}?></select>
							</div>
						</div>
						<div class="col-sm-3">
							<div class="form-group">
								<select class="form-control" name="availability"><option value="">Available Form</option>
								<?php foreach($presult as $r1) { $availability=$r1['availability']; echo "<option value=\"$availability\">$availability</option>";}?></select>
							</div>
						</div>
						<div class="col-md-2">
							<button class="btn btn-success">Refine</button>
						</div>
				</form> 
			</div>	
		</div>
		

				<?php																	// Code for common panel for title
				 echo "<table class=\"table table-striped table-hover\">
				<tr>
				<th>Institute</th>
				<th>City</th>
				<th>Available Form</th>
				<th>Holdings</th>
				<th>Last Update</th> 
				<th>Action</th>
				</tr>";		
				 foreach($result as $row)
				 	{	$title=$row['title'];
				 		$institute=$row['institute'];
				 		$city=$row['city'];
				 		$availability=$row['availability'];
				 		$holdings=$row['holdings'];
						$lu=$row['last_update'];
				 		
				 		

				 		$sql2=("SELECT * FROM `institute_details` WHERE `name`='$institute' ORDER BY `institute` ASC");
				 		$result2=$db->query($sql2);
				 		$r=mysqli_fetch_assoc($result2);
				 		$iurl=$r['website'];							// iurl== institute website url
				 		$mail=$r['test_mail']; 								

				 		echo " <tr>
								<td><a href=\"$iurl\" target=\"_blank\">$institute</a></td>
								<td>$city</td>
								<td>$availability</td>
								<td>$holdings</td>
								<td>$lu</td>
								<td>
									<form action=\"send_mail.php \" method=\"post\">
									<input type=\"hidden\" value=\"$mail\" name=\"to\" />
									<button class=\"btn btn-default\">Send Mail</button>
									</form>
								</td>

								</tr>";		

				 	}
				 	echo "</table>";
				 	

								 	
			?>
			
								

			
		</table>
		</div>
		
		<div class="modal fade" id="mymodal" tabindex="-1" role="dialog" aria-labbeledby="myModalLabel" >  <!-- To Implement Send mail popup-->
			<div class="modal-dialog" role="document" >
				<div class="modal-content" style="height:450px; width=600px;">
					<div class="modal-body" style="height:450px; width=600px;">
							<iframe src="send_mail.php" height="100%" width="100%"></iframe>
					</div>
				</div>
			</div>
		</div>			


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