
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
			$sql2=("SELECT `name` FROM `institute_details` WHERE `username`='$user'");
			$result2=$db->query($sql2);
			$r=mysqli_fetch_assoc($result2);
			$name=$r['name'];
			$sql=("SELECT * FROM `catalog` WHERE `title` LIKE '$c%' AND `institute`='$name' ORDER BY `title`");
			$result=$db->query($sql);
			echo "<table class=\"table table-bordered table-hover\">
				<th>Title</th>
				<th>Publisher</th>
				<th>ISSN</th>
				<th>E-ISSN</th>
				<th>Availability</th>
				<th>Action</th>
			";
			foreach($result as $row)
				{	
					$title=$row['title'];
					$publisher=$row['publisher'];
					$issn=$row['issn'];
					$eissn=$row['eissn'];
					$availability=$row['availability'];

					echo "<tr>
					<td>$title</td>
					<td>$publisher</td>
					<td>$issn</td>
					<td>$eissn</td>
					<td>$availability</td>
					<td>
						<form action=\"edit_holdings.php\" method=\"post\" target=\"BLANK\">
							<input type=\"hidden\" value=\"$title\" name=\"title\" />
							<button class=\"btn btn-default\">Edit</button>  
						</form>	
					</td>
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