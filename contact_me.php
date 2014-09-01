<?php
use \google\appengine\api\mail\Message;
use google\appengine\api\log\LogService;
syslog(LOG_ERR, "howdy!");
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
	
$name = $_POST['name'];
$email_address = $_POST['email'];
$phone = $_POST['phone'];
$message = $_POST['message'];
	
// Create the email and send the message
$to = 'djrobotfreak@gmail.com'; // Add your email address inbetween the '' replacing yourname@yourdomain.com - This is where the form will send a message to.
$email_subject = "Website Contact Form:  $name";
$email_body = "You have received a new message from your website contact form.\n\n"."Here are the details:\n\nName: $name\n\nEmail: $email_address\n\nPhone: $phone\n\nMessage:\n$message";
$headers = "From: noreply@yourdomain.com\n"; // This is the email address the generated message will be from. We recommend using something like noreply@yourdomain.com.
$headers .= "Reply-To: $email_address";	
try
{
  $message = new Message();
  syslog(LOG_INFO, "I created the message");
  $message->setSender('support@netegreek.com');
  $message->addTo("support@netegreek.com");
  $message->setSubject($email_subject);
  $message->setTextBody($email_body);
    syslog(LOG_INFO, "I am about to send!");
  $message->send();
    syslog(LOG_INFO, "I should be sending");
    return true;
} catch (InvalidArgumentException $e) {
    syslog(LOG_ERR, "Something went wrong...$e");
  return false;
}
//mail($to,$email_subject,$email_body,$headers);
return false;			
?>

