<?php 
require 'vendor/autoload.php';
require_once 'config/all.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;
class Mailer1
{
	public $mail;
	function __construct()
	{
		// mb_language('ja');
  		// mb_internal_encoding('UTF-8');
		$this->mail = new PHPMailer(true);
	}

	function sendMail($to,$toName,$subject,$body,$cc = null,$noreply=null)
	{
		mb_language("japanese");
		mb_internal_encoding("UTF-8");
		// iconv_set_encoding("internal_encoding", "UTF-8");
		$fromName = FROMNAME;
		$toName = mb_encode_mimeheader($toName, "ISO-2022-JP",'UTF-8');
		$subject = mb_encode_mimeheader($subject, "ISO-2022-JP",'UTF-8');
		$body = mb_convert_encoding($body, "ISO-2022-JP",'UTF-8');
		try {
			//Server settings
			$this->mail->SMTPDebug = SMTP_DEBUG;
			$this->mail->isSMTP();
			$this->mail->SMTPAuth   = true;
			$this->mail->Host       = MAIL_HOST;
			$this->mail->CharSet       = 'ISO-2022-JP';
			$this->mail->Encoding      = "7bit"; 
			$this->mail->SMTPSecure = SMTPSecure;
			$this->mail->Port       = MAIL_PORT;
			$this->mail->Username   = MAIL_USER;
			$this->mail->Password   = MAIL_PASS;

			//Recipients
			
			// if ( isset($noreply) && $noreply !==null){
			// 	$this->mail->setFrom($noreply,NOREPLYNAME);
			// }else{
				$this->mail->setFrom(FROM, $fromName);
			// }
			$this->mail->addAddress($to, $toName);
			if ( isset($cc) && $cc !==null){
				$this->mail->addCC($cc,CCNAME);
			}
			//Content
			$this->mail->isHTML(true);
			$this->mail->Subject = $subject;
			$this->mail->Body    = $body;
			// $this->mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

			if ( ! $this->mail->send())
			{
				return false;
			}
			return true;
		}
		catch (Exception $e)
		{
			echo "Message could not be sent. Mailer Error: {$this->mail->ErrorInfo}";
		}
	}
}

class Mailer{
	function sendMail($to,$toName,$subject,$body,$cc = null,$noreply=null)
	{
		try {
		// return MAIL_HOST;
		// Create the SMTP Transport
		$transport = (new Swift_SmtpTransport(MAIL_HOST, MAIL_PORT,SMTPSecure))
        ->setUsername(FROM)
        ->setPassword(MAIL_PASS);
 
    // Create the Mailer using your created Transport
    $mailer = new Swift_Mailer($transport);
 
    // Create a message
    $message = new Swift_Message();
 
    // Set a "subject"
    $message->setSubject($subject);
 
    // Set the "From address"
    $message->setFrom([FROM => FROMNAME]);
 
    // Set the "To address" [Use setTo method for multiple recipients, argument should be array]
    $message->addTo($to,$toName);
	if ( isset($cc) && $cc !==null){
		$message->addCc($cc, CCNAME);
	}
 
    // Add "CC" address [Use setCc method for multiple recipients, argument should be array]
    // $message->addCc('recipient@gmail.com', 'recipient name');
 
    // Add "BCC" address [Use setBcc method for multiple recipients, argument should be array]
    // $message->addBcc('recipient@gmail.com', 'recipient name');
 
    // Add an "Attachment" (Also, the dynamic data can be attached)
    // $attachment = Swift_Attachment::fromPath('example.xls');
    // $attachment->setFilename('report.xls');
    // $message->attach($attachment);
 
    // Add inline "Image"
    // $inline_attachment = Swift_Image::fromPath('nature.jpg');
    // $cid = $message->embed($inline_attachment);
 
    // Set the plain-text "Body"
    $message->setBody($body,'text/html');
 
    // Set a "Body"
    // $message->addPart('This is the HTML version of the message.<br>Example of inline image:<br><img src="'.$cid.'" width="200" height="200"><br>Thanks,<br>Admin', 'text/html');
 
    // Send the message
    // $result = $mailer->send($message);
	if ( !  $mailer->send($message))
			{
				return false;
			}
			return true;
			
} catch (Exception $e) {
    echo $e->getMessage();
  }
	}

	
}
