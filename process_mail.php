
<?php
		session_start();
		require "connect_catalog.php";
		if(empty($_SESSION['username']))
			die("<div class=\"alert alert-danger\"> This Facility is only for Institutes.Log In as institute to send mail</div>
				<div class=\"alert alert-success\"><a href=\"index.php\">Go Back</a></div>");

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
					die("<div class=\"alert alert-danger\"> This Facility is only for Institutes.Log In as institute to send mail</div>");	
				}	
	?>
	<?php body: ?>    <!-- GOTO label -->
<?php
 $from=$_POST['from'];
 $to=$_POST['to'];
 $subject=$_POST['subject'];
 $body=$_POST['body'];
 
	 require ("phpmailer/class.phpmailer.php");
		 
	 $mail = new PHPMailer;

$mail->isSMTP();
$mail->SMTPDebug = 2;
$mail->Host = 'smtp.gmail.com';
$mail->SMTPAuth = true;
$mail->Username = 'tanishqmonga005@gmail.com';
$mail->Password = 'wannaguess';
//$mail->SMTPSecure = 'tls';
$mail->Port = 25;
$mail->from='tanishqmonga005@gmail.com';
$mail->addReplyTo($from, $user);
$mail->addAddress($to);
$mail->isHTML(true);
$mail->Subject = 'test';
$mail->Body    = 'hello test';

if(!$mail->Send()) {
echo 'Message was not sent.';
echo 'Mailer error: ' . $mail->ErrorInfo;
}
 
 
 

 //print_r($response);
 
 
?>
