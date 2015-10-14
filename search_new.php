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
			

		</div>
		<?php
		session_start();
		require "connect_catalog.php";
		$query=$_GET['query'];
		$sql1=("SELECT DISTINCT `institute` FROM `catalog` WHERE `title` LIKE '%$query%' ORDER BY `institute` ASC"); 			// sql1 is to get distinct institutes
		$sql2=("SELECT DISTINCT `city` FROM `catalog` WHERE `title` LIKE '%$query%' ORDER BY `city` ASC");					// sql1 is to get distinct cities	
		$sql3=("SELECT DISTINCT `publisher` FROM `catalog` WHERE `title` LIKE '%$query%' ORDER BY `publisher` ASC");	
		$sql4=("SELECT DISTINCT `availability` FROM `catalog` WHERE `title` LIKE '%$query%' ORDER BY `availability` ASC");			// sql1 is to get distinct publishers
		$iresult=$db->query($sql1);																		// iresult is result instance of sql1 i.e institute's query	
		$cresult=$db->query($sql2);																		// iresult is result instance of sql1 i.e institute's query
		$presult=$db->query($sql3);
		$aresult=$db->query($sql4);
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
		
		?>
		<div class="panel panel-default">
			<div class="panel-body">
				<form class="search" action="refine_search.php" method="get"> 
					<input type="hidden" name="query" value="<?php echo "$query";?>">			<!-- To send an extra variable hidden input is used-->
					<input type="hidden" name="page" value="1">	
						<div class="col-xs-6 col-sm-2">
							<div class="form-group">
								<select class="form-control"  name ="insti"><option value="">Institute</option>
								<?php foreach($iresult as $r1) { $insti=$r1['institute']; echo "<option value=\"$insti\">$insti</option>";}?></select> 
							</div>	
						</div>
						<div class="col-xs-6 col-sm-2">
							<div class="form-group">
								<select class="form-control" name="city"><option value="">City</option>
								<?php foreach($cresult as $r1) { $city=$r1['city']; echo "<option value=\"$city\">$city</option>";}?></select>
							</div>
						</div>
						<div class="col-xs-6 col-sm-2">
							<div class="form-group">
								<select class="form-control" name="publisher"><option value="">Publisher</option>
								<?php foreach($presult as $r1) { $publisher=$r1['publisher']; echo "<option value=\"$publisher\">$publisher</option>";}?></select>
							</div>
						</div>
						<div class="col-xs-7 col-sm-2">
							<div class="form-group">
								<select class="form-control" name="availability"><option value="">Available Form</option>
								<?php foreach($aresult as $r1) { $availability=$r1['availability']; echo "<option value=\"$availability\">$availability</option>";}?></select>
							</div>
						</div>
						<div class="col-md-2">
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
			$sql=("SELECT DISTINCT `title`,`publisher` FROM `catalog` WHERE `title` LIKE '%$query%'");
			$result=$db->query($sql);
			
			$totalrows=$result->num_rows;
			$rowsperpage=50;
			$totalpage=ceil($totalrows/$rowsperpage);
			if (empty($page))
				$page=1;
			else if($page<1)
				$page=1;
			else if($page>$totalpage)
				$page=$totalpage;
			$offset=($page-1)*$rowsperpage;
			$sql2=("SELECT DISTINCT `title`,`publisher`,`availability`,`issn`,`eissn`,`title_url` FROM `catalog` WHERE `title` LIKE '%$query%' ORDER BY `title` ASC LIMIT $offset,$rowsperpage  ");		//query with pagination
			$result2=$db->query($sql2);	
																
			if($result->num_rows==0)
				{	echo "<a href= \"index.php\"> <center><h4>Go Back</h4></center></a>";
					die("<h3><center>No Journals Found</h3><center>");
				}
				
				echo "<table class=\"table table-striped table-hover table-bordered\">
						<tr>
							<th>Title</th>
							<th>Publisher</th>
							<th>Available Form</th>
							<th>ISSN</th>
							<th>E-ISSN</th>
							<th>Action</th>
						</tr>";
				$prev=NULL;
				foreach($result2 as $r)
					{	$query=$r['title'];
						$publisher=$r['publisher'];
						$availability=$r['availability'];
						$issn=$r['issn'];
						$eissn=$r['eissn'];
						$turl=$r['title_url'];
						echo "<tr>
						<td>$query</td>
						<td><a href=\"$turl\">$publisher</a></td>
						<td>$availability</td>
						<td>$issn</td>
						<td>$eissn</td>
						<td><a href=\"show_result.php?q=$query\">Click Here</a></td>
						</tr>
						";
							
					}
			
			


		?>
		</table>
		<?php   
		$query=$_GET['query'];                              //To Implement Page numbers at the bottom of the page
		if($page>2)
			echo "<a href=\"search_new.php?page=1&query=$query\"><span class=\" glyphicon glyphicon-menu-left\"></span><span class=\" glyphicon glyphicon-menu-left\"></span>&nbsp;</a>";
		if($page>1)
			{
				$prevpage=$page-1;
				echo "<a href=\"search_new.php?page=$prevpage&query=$query\"><span class=\" glyphicon glyphicon-menu-left \"></span>&nbsp;</a>";
			}
		$count=10;
		for($i=$page-$count;$i<=$page+$count;$i++)
			{	
				if($i<1||$i>$totalpage) {}
				else if($i==$page)
					echo "<font size=5><b>$page&nbsp;</b></font>";
				else
					echo "<a href=\"search_new.php?page=$i&query=$query\"><font size=4>$i&nbsp;</font></a>";
			}
		if($page<$totalpage)
			{	$nextpage=$page+1;
				echo "<a href=\"search_new.php?page=$nextpage&query=$query\"><span class=\" glyphicon glyphicon-menu-right \"></span>&nbsp;</a>";
			}
		if($page<$totalpage-1)
			echo "<a href=\"search_new.php?page=$totalpage&query=$query\"><span class=\" glyphicon glyphicon-menu-right\"></span><span class=\" glyphicon glyphicon-menu-right\"></span>&nbsp;</a>";
		
					
		?>
		<div class="container body-content">
			<div style="height:70px;"></div>    <!-- This div is added becouse footer is overlapping the actual contents-->
		</div>
	 </div> 
		<div class="col-sm-2">
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