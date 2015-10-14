<?php require "addition.php";  error_reporting(0);?> 
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
		$to=$_POST['to'];
		require "connect_catalog.php";
		if(empty($_SESSION['username']))
			{echo " <div class=\"col-sm-4\"></div><div class=\"col-sm-4\"><div class=\"alert alert-danger\"> This Facility is only for Institutes.Log In as institute to send mail</div>
					<div class=\"panel-body\">
						<div class=\"row\">
								<form id=\"login-form\" action=\"redirect_mail.php\" method=\"post\" role=\"form\" style=\"display: block;\">
									<div class=\"form-group\">
										<input type=\"text\" name=\"username\" id=\"username\" tabindex=\"1\" class=\"form-control\" placeholder=\"Username\" autofocus required=\"required\" >
									</div>
									<div class=\"form-group\">
										<input type=\"password\" name=\"password\" id=\"password\" tabindex=\"2\" class=\"form-control\" placeholder=\"Password\" autofocus required=\"required\">
									</div>
									<input type=\"hidden\" name=\"to\" value=\"$to\">
									<div class=\"form-group\">
										<div class=\"row\">
											<div class=\"col-sm-6 col-sm-offset-3\">
												<input type=\"submit\" name=\"login-submit\" id=\"login-submit\" tabindex=\"4\" class=\"form-control btn btn-success\" >
											</div>
										</div>
									</div>
								</form>
							</div>
						</div>
					</div>";
						die();
					}

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
					echo "<div class=\"alert alert-danger\"> This Facility is only for Institutes.Log In as institute to send mail
						</div>";
					
						die();
				}	
	?>
	<?php body: ?>    <!-- GOTO label -->
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
				<a href="index.php"><div class="navbar-brand">Union Catalog Of E-Resources</div></a>
				
			
				

			</div>
			

		</div>
		<?php
		$sql=("SELECT * FROM `institute_details` WHERE `username`='$user'");
		$result=$db->query($sql);
		$r=mysqli_fetch_assoc($result);
		$from=$r['test_mail'];
		if(!empty($_POST['to']))
		$to=$_POST['to'];
		if(empty($to))
			$to=$_GET['to'];
		/*if($from==$to)
		{
			die("<div class=\"alert alert-danger\"><center>This catalog  is available in your institute so mail cannot be sent
			<br><a href=\"javascript:history.back(1)\"><button class=\"btn btn-default\">Go Back</button></a></center></div>");
		}*/
		?>
		<h2> Send Mail</h2><br>
		<div class="col=-sm-6">
			<form action="process_mail.php" method="post">
				<div class="form-group">
					<label>From</label>
					<input type="text" value=<?php echo "$from"; ?> class="form-control" name="from" readonly />
					<label>To</label>
					<input type="text"   class="form-control" value=<?php echo "$to"; ?> name="to" readonly /> 
					<label>Subject</label>
					<input type="text" name="subject"  class="form-control" /> 
					<label>Body</label>
					<textarea class="form-control" name="body"></textarea>
				</div>
					<button class="btn btn-success">Send</button>
					

			</form>		
		<div class="container body-content">
			<div style="height:20px;"></div>    <!-- This div is added becouse footer is overlapping the actual contents-->
		</div>
		</div>

		
		<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"> </script>
		<script src="js/bootstrap.min.js"> </script>
	</body>
</html>				