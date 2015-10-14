
<!DOCTYPE html>
<html>
	<head>
		<title>Catalog of E-Resources</title>
		<meta name="viewport" content="width=device-width,initial-scale=1.0">
		<link href="css/bootstrap.min.css" rel="stylesheet">
		<link href="css/styles.css" rel="stylesheet">
	</head>
	<body>
		
		<div class="col-sm-12">
			
		<?php
			require "connect_catalog.php";
			if(empty($_GET['token']))
				{
					die("<br><div class=\"alert alert-danger\"><h2>Oops Empty Token <a href=\"index.php\">Go Back</a></h2><center></div>
							");	
				}
			$c=$_GET['token'];
			$c=chr($c);
			$sql=("SELECT DISTINCT `title` FROM `catalog` WHERE `title` LIKE '$c%' ORDER BY `title`");
			$result=$db->query($sql);
			echo "<table class=\"table table-bordered table-hover\">";
			foreach($result as $row)
				{	$title=$row['title'];
					echo "<tr><td><center><h4><a href=\"show_bytitle.php?q=$title\" target=\"BLANK\">$title</a><br></h4></center></td></tr>
						";

				}


		?>
		</table>

			<div class="container body-content">
				<div style="height:15px;"></div>    <!-- This div is added becouse footer is overlapping the actual contents-->
			</div>
		</div>	

		
		
		<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"> </script>
		<script src="js/bootstrap.min.js"> </script>
	</body>
</html>				