<?php
session_start();
if (isset($_SESSION['username']))
	{
		if($_SESSION['permission']!="none")
			die("access denied <a href=\"sign in.php\">Go back</a>");
		else
		{
			echo "welcome institute";
			echo "<a href=\"logout.php\">LOG OUT</a>";	
		}
	}
else
header("location: sign in.php");	

?>

