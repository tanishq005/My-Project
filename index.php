<?php require "addition.php" ?> 
<!DOCTYPE html>
<html>
	<head>
		<title>Catalog of E-Resources</title>
		<meta name="viewport" content="width=device-width,initial-scale=1.0">
		<link href="css/bootstrap.min.css" rel="stylesheet">
		<link href="styles.css" rel="stylesheet">
		<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"> </script>
		
		<script type="text/javascript" src="js/bootstrap.min.js"></script>
<script type="text/javascript" src="js/typeahead.min.js"></script>

		<script>
			$(document).ready(function(){
			    $('#query').typeahead({
			        name : 'query',
			        remote : 'advance_search.php?query=%QUERY'
			        
			    });
			});
		</script>

	</head>
	<body background="wall.jpg">

		<div class="navbar navbar-default navbar-static-top navbar-fixed-top">
			<div class="container">
				<a href="#" class="navbar-brand">Union Catalog Of E-Resources</a>
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
		

		<div class="container">
			<div class="jumbotron" style="min-width:550px;">
				<h2>Union Catalog of E Resources</h2>
				<p> This is a website which enables you to know about the places where all the e resources around the colleges are located.</p>
					<form action="search_new.php" method="get">
						<input type="hidden" value="1" name="page">
						<div class="form-group">
							<label for="text" ><h3>Search E-Resources</h3></label><br>
							<input type="text" name="query"  class="form-control" id="query" autofocus required="required" autocomplete="off">
							</div>
							<div class="col-sm-1">
							<button type="submit" class="btn btn-primary">Search</button>
							</div> 
					</form>
					<div class="col-sm-1">
					<a href="search_new.php?query=&page=1"><button class="btn btn-success">Show all Catalogs</button></a>
					</div>
				</div>	
			</div>
		</div>

	<class="container">
    	<div class="row">
    		<div class="col-sm-3"> </div>
    		<div class="col-sm-1"> </div>
			<div class="col-sm-4">
				<div class="panel panel-login">
					<div class="panel-heading">
						<div class="row">
							<div class="col-xs-12">
								<a href="#" class="active" id="login-form-link"><center>Login</center></a>
							</div>
						</div>
						<hr>
					</div>
					<div class="panel-body">
						<div class="row">
							<div class="col-lg-12">
								<form id="login-form" action="process_login.php" method="post" role="form" style="display: block;">
									<div class="form-group">
										<input type="text" name="username" id="username" tabindex="1" class="form-control" placeholder="Username" autofocus required="required" >
									</div>
									<div class="form-group">
										<input type="password" name="password" id="password" tabindex="2" class="form-control" placeholder="Password" autofocus required="required">
									</div>
									<div class="form-group">
										<div class="row">
											<div class="col-sm-6 col-sm-offset-3">
												<input type="submit" name="login-submit" id="login-submit" tabindex="4" class="form-control btn btn-login" >
											</div>
										</div>
									</div>
									<div class="form-group">
										<div class="row">
											<div class="col-lg-12">
												<div class="text-center">
													<a href="#" tabindex="5" class="forgot-password">Forgot Password?</a>
												</div>
											</div>
										</div>
									</div>
								</form>
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
		
	</body>
</html>				