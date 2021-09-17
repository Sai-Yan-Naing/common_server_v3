<?php 
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;
require 'vendor/autoload.php';
require_once 'config/all.php';
class Mailer
{
	public $mail;
	function __construct()
	{
		$this->mail = new PHPMailer(true);
	}
	function sendMail($to,$toName,$subject,$body){
	    

	try {
		    //Server settings
		    $this->mail->SMTPDebug = 0;
		    $this->mail->isSMTP(); 
		    $this->mail->Host       = MAIL_HOST;
		    $this->mail->SMTPAuth   = true;
		    $this->mail->Username   = MAIL_USER;
		    $this->mail->Password   = MAIL_PASS;
		    $this->mail->SMTPSecure = SMTPSecure;
		    $this->mail->Port       = MAIL_PORT;

		    //Recipients
		    $this->mail->setFrom(FROM, FROMNAME);
		    $this->mail->addAddress($to, $toName);

		    //Content
		    $this->mail->isHTML(true);
		    $this->mail->Subject = $subject;
		    $this->mail->Body    = $body;
		    // $this->mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

		    if(!$this->mail->send())
		    {
		    	return false;
		    }
		    return true;
		    
		} catch (Exception $e) {
		    echo "Message could not be sent. Mailer Error: {$this->mail->ErrorInfo}";
		}
	}
}
?>