<!DOCTYPE html>
<html>
	<head>
		<title>Catalog of E-Resources</title>
		<meta name="viewport" content="wnameth=device-wnameth,initial-scale=1.0">
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
		<div class="col-sm-3"></div>

		<div class="col-sm-6">
			<center><h2>Add New Record:</h2></center>
			<form role="form" action="insertnew.php" method="post">
				<div class="form-group">
					<label>*AISN:</label>
					<input type="text" class="form-control"  name="issn" autofocus required="required">
				</div>
				<div class="form-group">
					<label>*Title of E-Resource:</label>
					<input type="text" class="form-control" name="title" autofocus required="required">
				</div>	
				<div class="form-group">
					<label>*City:</label>
					<input type="text" class="form-control" name="city" autofocus required="required">
				</div>	
				<div class="form-group">
					<label>*Institute Name:</label>
					<input type="text" class="form-control" name="iname" autofocus required="required">
				</div>	
				<div class="form-group">
					<label>*Holdings:</label>
					<input type="text" class="form-control" name="holdings" autofocus required="required">
				</div>	
				<div class="form-group">
					<label>Description:</label>
					<textarea rows="4" cols="90" name="description" class="form-control"></textarea>
				</div>
				<div class="form-group">
					<button type="submit" class="btn btn-success">Submit</button>
				</div>		
			</form>
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
		<script src="js/bootstrap.js"> </script>
	</body>
</html>				