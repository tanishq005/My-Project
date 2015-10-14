<?php
error_reporting(0);
session_start();
$temp="admin";
if(empty($_SESSION['username']))
$dropdown="<li class=\"dropdown\">
			<a href=\"#\" class=\"dropdown-toggle\" data-toggle=\"dropdown\" role=\"button\" aria-haspopup=\"true\" aria-expanded=\"false\">Browse 
				          <span class=\"caret\"></span></a>
				          <ul class=\"dropdown-menu\">
				            <li><a href=\"browse_title.php\">By Title</a></li>
				            <li><a href=\"browse_publisher.php\">By Publisher</a></li>
				            <li><a href=\"search_city.php\">By City </a></li>
				             <li><a href=\"search_institute.php\">By Institute </a></li>
				          </ul>
				        </li>";

else if($_SESSION['username']===$temp)
	$dropdown="<li class=\"dropdown\">
			<a href=\"#\" class=\"dropdown-toggle\" data-toggle=\"dropdown\" role=\"button\" aria-haspopup=\"true\" aria-expanded=\"false\">Browse 
				          <span class=\"caret\"></span></a>
				          <ul class=\"dropdown-menu\">
				            <li><a href=\"browse_title.php\">By Title</a></li>
				            <li><a href=\"browse_publisher.php\">By Publisher</a></li>
				            <li><a href=\"search_city.php\">By City </a></li>
				             <li><a href=\"search_institute.php\">By Institute </a></li>
				          </ul>
				        </li>
				        <li><a href=\"admin.php\">Profile</a></li>";
else
	$dropdown="<li class=\"dropdown\">
			<a href=\"#\" class=\"dropdown-toggle\" data-toggle=\"dropdown\" role=\"button\" aria-haspopup=\"true\" aria-expanded=\"false\">Browse 
				          <span class=\"caret\"></span></a>
				          <ul class=\"dropdown-menu\">
				            <li><a href=\"browse_title.php\">By Title</a></li>
				            <li><a href=\"browse_publisher.php\">By Publisher</a></li>
				            <li><a href=\"search_city.php\">By City </a></li>
				             <li><a href=\"search_institute.php\">By Institute </a></li>
				          </ul>
				        </li>
				        <li><a href=\"institute_profile.php\">Profile</a></li>";
	
?>