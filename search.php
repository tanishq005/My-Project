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
		<?php
		session_start();
		require "connect_catalog.php";
		if(!isset($_GET['query'])||empty($_GET['query']))
				die("<center><h3>Empty Token is not Allowed</h3> <a href=\"index.php\">Go Back</a></center>");
		$query=$_GET['query'];
		$sql1=("SELECT DISTINCT `institute` FROM `catalog` WHERE `title` LIKE '%$query%' ORDER BY `institute` ASC"); 			// sql1 is to get distinct institutes
		$sql2=("SELECT DISTINCT `city` FROM `catalog` WHERE `title` LIKE '%$query%' ORDER BY `city` ASC");					// sql1 is to get distinct cities	
		$sql3=("SELECT DISTINCT `publisher` FROM `catalog` WHERE `title` LIKE '%$query%' ORDER BY `publisher` ASC");				// sql1 is to get distinct publishers
		$iresult=$db->query($sql1);																		// iresult is result instance of sql1 i.e institute's query	
		$cresult=$db->query($sql2);																		// iresult is result instance of sql1 i.e institute's query
		$presult=$db->query($sql3);
		$log_sql=("SELECT * FROM `logs` WHERE `id`='1' ");
		$result_log=$db->query($log_sql);
		$log=mysqli_fetch_assoc($result_log);
		$count=$log['search'];
		$count++;
		$log_sql=("UPDATE `logs` SET `search`='$count' where `id`='1' ");
		$result_log=$db->query($log_sql);
		if (isset($_SESSION['username']))
		{ $user=$_SESSION['username'];  }
		if(!empty($user))
			{	
				$log_sql=("SELECT * FROM `institute` WHERE `username`='$user' ");
				$result_log=$db->query($log_sql);
				$log=mysqli_fetch_assoc($result_log);
				$count=$log['search_log'];
				$count++;
				$log_sql=("UPDATE `institute` SET `search_log`='$count' where `username`='$user' ");
				$result_log=$db->query($log_sql);
			}	
																				// iresult is result instance of sql1 i.e institute's quer
		//echo var_dump($iresult);
		?>
		<div class="panel panel-default">
			<div class="panel-body">
				<form class="search" action="refine_search.php" method="get"> 
					<input type="hidden" name="query" value="<?php echo "$query";?>">			<!-- To send an extra variable hidden input is used-->
					<input type="hidden" name="page" value="1">	
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
								<select class="form-control" name="publisher"><option value="">Publisher</option>
								<?php foreach($presult as $r1) { $publisher=$r1['publisher']; echo "<option value=\"$publisher\">$publisher</option>";}?></select>
							</div>
						</div>
						<div class="col-sm-2">
							<button class="btn btn-success">Refine</button>
						</div>
				</form> 
			</div>	
		</div>


		<div class="col-sm-12">					<!-- Main Starts -->
		<?php
			require "connect_catalog.php";
			$query=$_GET['query'];	
			$page=$_GET['page'];
			$sql=("SELECT * FROM `catalog` WHERE `title` LIKE '%$query%'");
			$result=$db->query($sql);
			$totalrows=$result->num_rows;
			$rowsperpage=100;
			$totalpage=ceil($totalrows/$rowsperpage);
			if (empty($page))
				$page=1;
			else if($page<1)
				$page=1;
			else if($page>$totalpage)
				$page=$totalpage;
			$offset=($page-1)*$rowsperpage;
			$sql2=("SELECT * FROM `catalog` WHERE `title` LIKE '%$query%' ORDER BY `title` ASC LIMIT $offset,$rowsperpage  ");		//query with pagination
			$result2=$db->query($sql2);																
			//echo var_dump($result2);
			$prev=0;      															// prev variable is used to store issn number for eliminating duplicate rows 
			$flag=0;																// flag is used to determine the first loop iteration .. i.e if flag=0 its first iteration
			$temp=array();															// this is array is used to store the name of the institutions holding the the same journal with same issn
			//echo $result->num_rows;
			$count=0;
			if($result->num_rows==0)
				{	echo "<a href= \"index.php\"> <center><h4>Go Back</h4></center></a>";
					die("<h3><center>No Journals Found</h3><center>");
				}
				echo "<table class=\"table table-striped table-hover table-bordered\">
						<tr>
							<th>Title</th>
							<th>Publisher</th>
							<th>Availability</th>
							<th>Action</th>
						</tr>";
			foreach ($result2 as $row)
				{
					$count++; 
					if($flag==0) 
						{	$title=$row['title'];
							$issn=$row['issn'];
							$temp[]=$row['institute'];
							$publisher=$row['publisher'];
							$flag=1;
						}
					//else if($title==$row['title']&&$issn==$row['issn'])
					else if($issn==$row['issn'])
	 					{	
							$temp[]=$row['institute'];
						}	
					else
						{ 
						
							echo "<tr><td> $title </td><td>";
							echo "$publisher </td><td>";
							foreach($temp as $t)
								{	
									echo "<ul><li>$t</li></ul>";
								}

							echo "</td><td><a href=\"show_result.php?q=$title\" style=\"target-new: tab;\"> Click Here</a></td></tr>";
								//$url=$row['url'];
								$title=$row['title'];
								$issn=$row['issn'];
								$temp=array();					/// Re declaring array to clear an array . Will change it later 
								$temp[]=$row['institute'];
								$publisher=$row['publisher'];

						}
					 if($count==$result->num_rows)          							// this if determines if there are no other results to retreive and this is last iteration
						{	
							
							echo "<tr><td> $title </td><td>";
							echo " $publisher </td><td>";
							foreach($temp as $t)
								{	
									echo "<ul><li>$t</a></li></ul>";					// For merging the duplicate titles
								}
							echo "</td><td><a href=\"show_result.php?q=$title\"> Click Here</a></td></tr>"; 	 // link to the next query
						}
					
			}
			


		?>
		</table>
		<?php                                 //To Implement Page numbers at the bottom of the page
		if($page>2)
			echo "<a href=\"search.php?page=1&query=$query\"><span class=\" glyphicon glyphicon-menu-left\"></span><span class=\" glyphicon glyphicon-menu-left\"></span>&nbsp;</a>";
		if($page>1)
			{
				$prevpage=$page-1;
				echo "<a href=\"search.php?page=$prevpage&query=$query\"><span class=\" glyphicon glyphicon-menu-left \"></span>&nbsp;</a>";
			}
		$count=10;
		for($i=$page-$count;$i<=$page+$count;$i++)
			{	
				if($i<1||$i>$totalpage) {}
				else if($i==$page)
					echo "<font size=5><b>$page&nbsp;</b></font>";
				else
					echo "<a href=\"search.php?page=$i&query=$query\"><font size=4>$i&nbsp;</font></a>";
			}
		if($page<$totalpage)
			{	$nextpage=$page+1;
				echo "<a href=\"search.php?page=$nextpage&query=$query\"><span class=\" glyphicon glyphicon-menu-right \"></span>&nbsp;</a>";
			}
		if($page<$totalpage-1)
			echo "<a href=\"search.php?page=$totalpage&query=$query\"><span class=\" glyphicon glyphicon-menu-right\"></span><span class=\" glyphicon glyphicon-menu-right\"></span>&nbsp;</a>";
		
					
		?>
		</div>           			<!-- Main Ends-->

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