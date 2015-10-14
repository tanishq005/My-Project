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
				 $query=$_GET['query'];
				 $sql=("SELECT * FROM `master_catalog` WHERE `title` LIKE '%$query%'");
				 $result=$db->query($sql);
				 $page=$_GET['page'];
				 $totalrows=$result->num_rows;
				 $rowsperpage=10;
				 $offset=($page-1)*$rowsperpage;
				 $totalpage=ceil($totalrows/$rowsperpage);
				 $sql2=("SELECT * FROM `master_catalog` WHERE `title` LIKE '%$query%' ORDER BY `title` ASC LIMIT $offset,$rowsperpage");
				 $result2=$db->query($sql2);
				 echo "<div class=\"panel panel-default\">								
						<div class=\"panel-body\">
						<h4><b>Search For : $query</b></h4>
						</div>
						</div>"; 																	// Code for common panel for title
				 echo "<table class=\"table table-striped table-hover\">
				<tr>
				<th>Title</th>
				<th>Publisher</th>
				<th>Issn</th>
				<th>E-Issn</th>
				<th>Action</th>
				</tr>";		
				 foreach($result2 as $row)
				 	{	$title=$row['title'];
				 		$issn=$row['issn'];
						$eissn=$row['eissn'];
				 		$publisher=$row['publisher'];
				 		
				 		 								

				 		echo " <tr>
								<td>$title</td>
								<td>$publisher</td>
								<td>$issn</td>
								<td>$eissn</td>
								<td>
								<form action=\"add_holdings.php\" method=\"post\" target=\"_blank\">
								<input type=\"hidden\" name=\"title\" value=\"$title\" />
								<input type=\"hidden\" name=\"publisher\" value=\"$publisher\" />
								<input type=\"hidden\" name=\"issn\" value=\"$issn\" />
								<input type=\"hidden\" name=\"eissn\" value=\"$eissn\" />
								<button type=\"submit\" class=\"btn btn-success\">Add New</button>
								</form>
								</td>
								</tr>";		

				 	}
				 	echo "</table>";
				 	

								 	
			?>
			<?php                                 //To Implement Page numbers at the bottom of the page
		if($page>2)
			echo "<a href=\"search_master.php?page=1&query=$query\"><span class=\" glyphicon glyphicon-menu-left\"></span><span class=\" glyphicon glyphicon-menu-left\"></span>&nbsp;</a>";
		if($page>1)
			{
				$prevpage=$page-1;
				echo "<a href=\"search_master.php?page=$prevpage&query=$query\"><span class=\" glyphicon glyphicon-menu-left \"></span>&nbsp;</a>";
			}
		$count=10;
		for($i=$page-$count;$i<=$page+$count;$i++)
			{	
				if($i<1||$i>$totalpage) {}
				else if($i==$page)
					echo "<font size=5><b>$page&nbsp;</b></font>";
				else
					echo "<a href=\"search_master.php?page=$i&query=$query\"><font size=4>$i&nbsp;</font></a>";
			}
		if($page<$totalpage)
			{	$nextpage=$page+1;
				echo "<a href=\"search_master.php?page=$nextpage&query=$query\"><span class=\" glyphicon glyphicon-menu-right \"></span>&nbsp;</a>";
			}
		if($page<$totalpage-1)
			echo "<a href=\"search_master.php?page=$totalpage&query=$query\"><span class=\" glyphicon glyphicon-menu-right\"></span><span class=\" glyphicon glyphicon-menu-right\"></span>&nbsp;</a>";
		
					
		?>


		

		<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"> </script>
		<script src="js/bootstrap.min.js"> </script>
	</body>
</html>				