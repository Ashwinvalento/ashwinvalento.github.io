
<?php
require 'PHPMailerAutoload.php';

// Check for empty fields
if(empty($_POST['name'])  		||
   empty($_POST['email']) 		||
   empty($_POST['phone']) 		||
   empty($_POST['message'])	||
   !filter_var($_POST['email'],FILTER_VALIDATE_EMAIL))
   {
	echo "No arguments Provided!";
	return false;
   }

// get the parameters from js
$name = $_POST['name'];
$email_address = $_POST['email'];
$phone = $_POST['phone'];
$message = $_POST['message'];

 
$mail = new PHPMailer;
 
$mail->isSMTP();                                      // Set mailer to use SMTP
$mail->Host = 'localhost';                       // Specify main and backup server
$mail->SMTPAuth = true;                               // Enable SMTP authentication
$mail->Username = 'contact@valento.in';                   // SMTP username
$mail->Password = 'somePassword';               // SMTP password
$mail->SMTPSecure = 'ssl';                            // Enable encryption, 'ssl' also accepted
$mail->Port = 465 ;                                    //Set the SMTP port number - 587 for authenticated TLS
$mail->setFrom("contact@valento.in","Portfolio Contact");     //Set who the message is to be sent from
$mail->addReplyTo($email_address);  //Set an alternative reply-to address
$mail->addAddress('');               // Name is optional

$mail->WordWrap = 50;                                 // Set word wrap to 50 characters
$mail->isHTML(true);                                  // Set email format to HTML
 
$mail->Subject = "Portfolio Contact Form:  $name";
$mail->Body    = "You have received a new message from your website Portfolio contact form.<br/><br/>Here are the details:<br/><strong>Name:</strong> $name<br/><strong>Email:</strong> $email_address<br/><strong>Phone:</strong> $phone<br/><strong>Message:</strong> <br/>$message <br/>";

 
if(!$mail->send()) {
   echo 'Message could not be sent.';
   echo 'Mailer Error: ' . $mail->ErrorInfo;
   exit;
}
 
echo 'Message has been sent';
return true;	
 
