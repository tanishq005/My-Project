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
		

							<!-- Main Starts -->
		
								


			 <?php

				 require "connect_catalog.php";
				 $page=$_GET['page'];
				 $query=$_GET['query'];
			 	 $institute=$_GET['insti'];
			 	 $city=$_GET['city'];
			 	 $publisher=$_GET['publisher'];
			 	 $availability=$_GET['availability'];

			 	 if(empty($availability))
				 $sql=("SELECT * FROM `catalog` WHERE `title` LIKE '%$query%' AND `institute` LIKE '%$institute%' 
				 	AND `publisher` LIKE '%$publisher%' AND `city` LIKE '%$city%' AND `availability` LIKE '%$availability%' ");
				else
					$sql=("SELECT * FROM `catalog` WHERE `title` LIKE '%$query%' AND `institute` LIKE '%$institute%' 
				 	AND `publisher` LIKE '%$publisher%' AND `city` LIKE '%$city%' AND `availability`='$availability' ");

				 $result=$db->query($sql);

				 function emptycheck($x,$y,$z)					//this function will check if there is only one refiner left or multiple
				 {
				 	if(empty($x)&&empty($y)&&empty($z))
				 		return 1;
				 }
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
				if(empty($availability))
				$sql2=("SELECT * FROM `catalog` WHERE `title` LIKE '%$query%' AND `institute` LIKE '%$institute%'
				 AND `publisher` LIKE '%$publisher%' AND `city` LIKE '%$city' AND `availability` LIKE '%$availability%' ORDER BY `title` LIMIT $offset,$rowsperpage");
				else
					$sql2=("SELECT * FROM `catalog` WHERE `title` LIKE '%$query%' AND `institute` LIKE '%$institute%'
				 AND `publisher` LIKE '%$publisher%' AND `city` LIKE '%$city' AND `availability`='$availability' ORDER BY `title` LIMIT $offset,$rowsperpage");

				$result2=$db->query($sql2);
				echo "<div class=\"panel panel-default\">								
						<div class=\"panel-body\">
						<b>Search Refined By:</b><br>";
						if(!empty($institute))
							{
								echo "Institute:<b>$institute</b>";
								if (emptycheck($publisher,$city,$availability))
								echo "<a href=\"search_new.php?query=$query&page=1\"><span class=\"glyphicon glyphicon-remove\"></span></a><br>";
								else
								echo "<a href=\"refine_search.php?query=$query&city=$city&page=1&publisher=$publisher&availability=$availability&insti\"><span class=\"glyphicon glyphicon-remove\"></span></a><br>";
							}

						if(!empty($city))
							{
								echo "City:<b>$city</b>";
								if (emptycheck($publisher,$institute,$availability))
								echo "<a href=\"search_new.php?query=$query&page=1\"><span class=\"glyphicon glyphicon-remove\"></span></a><br>";
								else
								echo "<a href=\"refine_search.php?query=$query&city&page=1&publisher=$publisher&availability=$availability&insti=$institute\"><span class=\"glyphicon glyphicon-remove\"></span></a><br>";
							}
						if(!empty($publisher))
							{
								echo "Publisher:<b>$publisher</b>";
								if (emptycheck($city,$institute,$availability))
								echo "<a href=\"search_new.php?query=$query&page=1\"><span class=\"glyphicon glyphicon-remove\"></span></a><br>";
								else
								echo "<a href=\"refine_search.php?query=$query&city=$city&page=1&publisher&insti=$institute&availability=$availability\"><span class=\"glyphicon glyphicon-remove\"></span></a><br>";
							}
							if(!empty($availability))
							{
								echo "Availability:<b>$availability</b>";
								if (emptycheck($city,$institute,$publisher))
								echo "<a href=\"search_new.php?query=$query&page=1\"><span class=\"glyphicon glyphicon-remove\"></span></a><br>";
								else
								echo "<a href=\"refine_search.php?query=$query&city=$city&page=1&publisher=$publisher&insti=$institute&availability=\"><span class=\"glyphicon glyphicon-remove\"></span></a><br>";
							}
						echo "<b>Clear all </b><a href=\"search_new.php?query=$query&page=1\"><span class=\"glyphicon glyphicon-remove\"></span></a>";	
						echo " </div></div></div>";	

				if($totalrows==0)
					die("<center><h2>No Results Found<center><h2>");


				 echo "<div class=\"col-sm-12\"> <table class=\"table table-hover table-bordered\">
					<tr>
					<th>Title</th>
					<th>Institute</th>
					<th>Issn</th>
					<th>City</th>
					<th>Availability</th>
					<th>Holdings</th>
					<th>Piblisher</th>
					<th>Action</th>
					</tr>";
					$sql3=("SELECT * FROM `institute_details` WHERE `name`='$institute'");
			 		$result3=$db->query($sql3);
			 		$r3=mysqli_fetch_assoc($result3);
			 		$iurl=$r3['website'];							// iurl== institute website url
			 		$mail=$r3['test_mail']; 	
				 foreach($result2 as $row)
				 	{	$query=$row['title'];
				 		$institute=$row['institute'];
				 		$issn=$row['issn'];
				 		$city=$row['city'];
				 		$availability=$row['availability'];
				 		$holdings=$row['holdings'];
				 		$publisher=$row['publisher'];

				 		echo " <tr>
				 				<td>$query</td>
								<td>$institute</td>
								<td>$issn</td>
								<td>$city</td>
								<td>$availability</td>
								<td>$holdings</td>
								<td>$publisher</td>
								<td>
									<form action=\"send_mail.php \" method=\"post\">
									<input type=\"hidden\" value=\"$mail\" name=\"to\" />
									<button class=\"btn btn-default\">Send Mail</button>
									</form>
								</td>
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
		<?php     
		 $page=$_GET['page'];
		 $query=$_GET['query'];
	 	 $institute=$_GET['insti'];
	 	 $city=$_GET['city'];
	 	 $publisher=$_GET['publisher'];
		//echo "$institute $city $publisher";                             //To Implement Page numbers at the bottom of the page
		if($page>2)
			echo "<a href=\"refine_search.php?page=1&query=$query&insti=$institute&publisher=$publisher&city=$city\"><span class=\" glyphicon glyphicon-menu-left\"></span><span class=\" glyphicon glyphicon-menu-left\"></span>&nbsp;</a>";
		if($page>1)
			{
				$prevpage=$page-1;
				echo "<a href=\"refine_search.php?page=$prevpage&query=$query&insti=$institute&publisher=$publisher&city=$city\"><span class=\" glyphicon glyphicon-menu-left \"></span>&nbsp;</a>";
			}
		$count=10;
		for($i=$page-$count;$i<=$page+$count;$i++)
			{	
				if($i<1||$i>$totalpage) {}
				else if($i==$page)
					echo "<font size=5><b>$page&nbsp;</b></font>";
				else
					echo "<a href=\"refine_search.php?page=$i&query=$query&insti=$institute&publisher=$publisher&city=$city\"><font size=4>$i&nbsp;</font></a>";
			}
		if($page<$totalpage)
			{	$nextpage=$page+1;
				echo "<a href=\"refine_search.php?page=$nextpage&query=$query&insti=$institute&publisher=$publisher&city=$city\"><span class=\" glyphicon glyphicon-menu-right \"></span>&nbsp;</a>";
			}
		if($page<$totalpage-1)
			echo "<a href=\"refine_search.php?page=$totalpage&query=$query&insti=$institute&publisher=$publisher&city=$city\"><span class=\" glyphicon glyphicon-menu-right\"></span><span class=\" glyphicon glyphicon-menu-right\"></span>&nbsp;</a>";
		
					
		?>

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