
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
			<div class="panel panel-default">
				<div class="panel-body">
					<h2>Showing All Catalogs</h2>
				</div>
			</div>		
			<?php
				$query=$_GET['query'];
				$page=$_GET['page'];
				$sql1=("SELECT * FROM `institute_details` WHERE `username` = '$user'");
				$result1=$db->query($sql1);
				$row=mysqli_fetch_assoc($result1);
				$name=$row['name'];
				$sql2=("SELECT * FROM `catalog` WHERE `title` LIKE '%$query%' AND `institute`='$name'");
				$result2=$db->query("$sql2");
				//echo $result2->num_rows;
				$totalrows=$result2->num_rows;
				$rowsperpage=10;
				$offset=($page-1)*$rowsperpage;
				$totalpage=ceil($totalrows/$rowsperpage);
				$sql3=("SELECT * FROM `catalog` WHERE `title` LIKE '%$query%' AND `institute`='$name' ORDER BY `title` LIMIT $offset,$rowsperpage");
				$result3=$db->query($sql3);

				echo "<table class=\"table table-striped table-hover\">
						<tr>
							<th>Title</th>
							<th>Holdings</th>
							<th>Action</th>
						</tr>
					";

				foreach($result3 as $row)
					{ 	$title=$row['title'];
						$holdings=$row['holdings'];
						echo "<tr>
								<td>$title</td>
								<td>$holdings</td>
								<td>
									<form action=\"delete_holdings.php\" method=\"post\" target=\"BLANK\">
										<input type=\"hidden\" value=\"$title\" name=\"title\" />
										<button class=\"btn btn-default\">Delete</button>  
									</form>	
								</td>	
							 </tr>	
							";
					}
			?>
		</table>
		
			
			<?php                                 //To Implement Page numbers at the bottom of the page
				if($page>2)
					echo "<a href=\"select_catalog.php?page=1&query=$query\"><span class=\" glyphicon glyphicon-menu-left\"></span><span class=\" glyphicon glyphicon-menu-left\"></span>&nbsp;</a>";
				if($page>1)
					{
						$prevpage=$page-1;
						echo "<a href=\"select_catalog.php?page=$prevpage&query=$query\"><span class=\" glyphicon glyphicon-menu-left \"></span>&nbsp;</a>";
					}
				$count=10;
				for($i=$page-$count;$i<=$page+$count;$i++)
					{	
						if($i<1||$i>$totalpage) {}
						else if($i==$page)
							echo "<font size=5><b>$page&nbsp;</b></font>";
						else
							echo "<a href=\"select_catalog.php?page=$i&query=$query\"><font size=4>$i&nbsp;</font></a>";
					}
				if($page<$totalpage)
					{	$nextpage=$page+1;
						echo "<a href=\"select_catalog.php?page=$nextpage&query=$query\"><span class=\" glyphicon glyphicon-menu-right \"></span>&nbsp;</a>";
					}
				if($page<$totalpage-1)
					echo "<a href=\"select_catalog.php?page=$totalpage&query=$query\"><span class=\" glyphicon glyphicon-menu-right\"></span><span class=\" glyphicon glyphicon-menu-right\"></span>&nbsp;</a>";
				
							
			?>
			

		</div>
		<br>
		<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"> </script>
		<script src="js/bootstrap.min.js"> </script>
	</body>
</html>				