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
			

		</div>
		<div class="col-sm-12">					<!-- Main Starts -->
		
			
		<div class="col-sm-12">
			<table class=" table table-bordered table-hover">
				<tr>
				<th>Title</th>
				</tr>					


			 <?php

				 require "connect_catalog.php";
				 $query=$_GET['query'];
				 $page=$_GET['page'];
				 $sql=("SELECT DISTINCT `title` FROM `catalog` WHERE `publisher` = '$query'");
				 $result=$db->query($sql);
				 $totalrows=$result->num_rows;
				 $rowsperpage=20;
				 $totalpage=ceil($totalrows/$rowsperpage);
				 if (empty($page))
					$page=1;
				 else if($page<1)
					$page=1;
				 else if($page>$totalpage)
					$page=$totalpage;
				 $offset=ceil($page-1)*$rowsperpage;
				 $sql2=("SELECT DISTINCT `title` FROM `catalog` WHERE `publisher` = '$query' ORDER BY `title` LIMIT $offset,$rowsperpage");
				 $result2=$db->query($sql2);
				 foreach($result2 as $row)
				 	{	$title=$row['title'];
				 		

				 		echo " <tr>
				 				<td><a href=\"show_bytitle.php?q=$title\">$title</a></td>
								</tr>";		

				 	}
			?>


		</table>
		<?php     
		 $page=$_GET['page'];
		//echo "$institute $city $publisher";                             //To Implement Page numbers at the bottom of the page
		if($page>2)
			echo "<a href=\"publisher_catalog.php?page=1&query=$query\"><span class=\" glyphicon glyphicon-menu-left\"></span><span class=\" glyphicon glyphicon-menu-left\"></span>&nbsp;</a>";
		if($page>1)
			{
				$prevpage=$page-1;
				echo "<a href=\"publisher_catalog.php?page=$prevpage&query=$query\"><span class=\" glyphicon glyphicon-menu-left \"></span>&nbsp;</a>";
			}
		$count=10;
		for($i=$page-$count;$i<=$page+$count;$i++)
			{	
				if($i<1||$i>$totalpage) {}
				else if($i==$page)
					echo "<font size=5><b>$page&nbsp;</b></font>";
				else
					echo "<a href=\"publisher_catalog.php?page=$i&query=$query\"><font size=4>$i&nbsp;</font></a>";
			}
		if($page<$totalpage)
			{	$nextpage=$page+1;
				echo "<a href=\"publisher_catalog.php?page=$nextpage&query=$query\"><span class=\" glyphicon glyphicon-menu-right \"></span>&nbsp;</a>";
			}
		if($page<$totalpage-1)
			echo "<a href=\"publisher_catalog.php?page=$totalpage&query=$query\"><span class=\" glyphicon glyphicon-menu-right\"></span><span class=\" glyphicon glyphicon-menu-right\"></span>&nbsp;</a>";
		
					
		?>
		

			 
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