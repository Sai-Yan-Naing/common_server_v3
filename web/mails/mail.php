<?php 
require 'vendor/autoload.php';
require_once 'config/all.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;
class Mailer
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
		$fromName = FROMNAME;
		$toName = mb_encode_mimeheader($toName, "ISO-2022-JP",'UTF-8');
		$subject = mb_encode_mimeheader($subject, "ISO-2022-JP","UTF-8");
		// $subject = "=?utf-8?b?".base64_encode($subject)."?=";
		$body = mb_convert_encoding($body, "ISO-2022-JP",'UTF-8');
		try {
			//Server settings
			$this->mail->SMTPDebug = SMTP_DEBUG;
			// $this->mail->isSMTP();
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
