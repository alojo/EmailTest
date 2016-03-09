<?php
namespace EmailTransport\Controller;

// require 'bootstrap.php';

/*
 * Wrapper class around SwiftMail
 * Facilitates a universal, simple-to-use tool for sending emails
 * Creates a Mailer to handle the message and logging
 *
 * @author Jordan Catibog
 *
 */
class MailRoom
{
	private $mailer;

	function __construct($array = array())
	{
		$this->setMailer(new Mailer($array));
	}

	public function getMailer()
	{
		return $this->mailer;
	}

	public function setMailer($mailer)
	{
		$this->mailer = $mailer;
	}

	public function send()
	{
		$this->getMailer()->send();
	}
}
// public function errorLog($array, $mess)
// {
// 	$file = dirname(__FILE__).'/ErrorLog.txt';
// 	$error = "[Date: ".date('Y-m-d H:i:s')."] [From:".$array['from']."] [To :".$array['to']."] [Error:".$mess."]  \n";
// 	file_put_contents($file, $error, FILE_APPEND | LOCK_EX);
// }

// public function send($array)
// {
// 	// Set parameter values
// 	$this->setPubId($array['pubId']);
// 	$this->setMagazineId($array['magazineId']);
// 	$this->setCategoryId($array['categoryId']);
// 	$this->setTo($array['to']);
// 	$this->setFrom($array['from']);
// 	$this->setSubject($array['subject']);
// 	$this->setHtml($array['message']['html']);
// 	$this->setText($array['message']['text']);

// 	// Get parameter values
// 	$vPubId = $this->getPubId();
// 	$vMagazineId = $this->getMagazineId();
// 	$vCategoryId = $this->getCategoryId();
// 	$vTo = $this->getTo();
// 	$vFrom = $this->getFrom();
// 	$vSubject = $this->getSubject();
// 	$vHtml=$this->getHtml();
// 	$vText = $this->getText();
// 	$this->setMessage($vHtml, $vText);
// 	$vMessage = $this->getMessage();

// 	// Constrcut an array which will be passed
// 	$replacements = array();
// 	$replacements['to'] = array (
// 		'{pubId}' 	   => filter_var($vPubId, FILTER_SANITIZE_NUMBER_INT),
// 		'{magazineId}' => filter_var($vMagazineId, FILTER_SANITIZE_NUMBER_INT),
// 		'{categoryId}' => filter_var($vCategoryId, FILTER_SANITIZE_NUMBER_INT),
// 		'{to}' 		   => filter_var($vTo, FILTER_SANITIZE_EMAIL),
// 		'{from}' 	   => filter_var($vFrom, FILTER_SANITIZE_EMAIL),
// 		'{subject}'    => $vSubject,
// 		'{message}'    => $vMessage
// 	);

// 	$transport = Swift_SmtpTransport::newInstance(MAIL_HOST, MAIL_PORT);
// 	$transport->setUsername(MAIL_USER);
// 	$transport->setPassword(MAIL_PASS);

// 	// Create an instance of the plugin and register it
// 	$plugin = new Swift_Plugins_DecoratorPlugin($replacements);
// 	$mailer = Swift_Mailer::newInstance($transport);
// 	$mailer->registerPlugin($plugin);

// 	// Create the message
// 	$message = Swift_Message::newInstance();

// 	// Open database
// 	$conn = new Database();

// 	//try	{
// 	// Check if email is valid
// 	if(filter_var($vTo, FILTER_VALIDATE_EMAIL) === FALSE) {
// 		$conn->createErrors_Tb(self::EMAIL_ERROR_NOT_VALID, 'Email not valid');
// 		$emailArr = $conn->createEmail_bodyTb($array, null);
// 		$senrArr = array(
// 			'email_address' => $vTo,
// 			'email_body_id' => $emailArr[1],
// 			'error_id'      => self::EMAIL_ERROR_NOT_VALID,
// 			'client_id'     => $vPubId,
// 			'magazine_id'   => $vMagazineId,
// 			'category_id'   => $vCategoryId,
// 			'sm_message_id' => 'notValid@swift.generated'
// 		);
// 		$this->errorLog($array, 'Email not valid');
// 		// Save information to table sent
// 		$conn->createSentTb($senrArr);
// 	}
// 	else {
// 		$message->setTo($vTo);
// 		$message->setSubject($vSubject);
// 		$message->setBody($vHtml, 'text/html');
// 		$message->setFrom($vFrom, $vFrom.' Admin');

// 		// Get message id
// 		$msgId = $message->getHeaders()->get('Message-ID');
// 		list($m1,$m2) = explode('@', $msgId->toString());
// 		$m3 = $m2;
// 		$m1 = str_replace('Message-ID: <', '', $m1);
// 		$m2=str_replace($m2, '@swift.generated', $m2);
// 		$sm_message_id = $m1.$m2;

// 		// Get header parameters
// 		$msgDate = $message->getHeaders()->get('Date');
// 		$msgSubject = $message->getHeaders()->get('Subject');
// 		$msgFrom = $message->getHeaders()->get('From');
// 		$msgTo = $message->getHeaders()->get('To');
// 		$msMIME_Version = $message->getHeaders()->get('MIME-Version');
// 		$msContent_Type = $message->getHeaders()->get('Content-Type');
// 		$msContent_Transfer_Encoding = $message->getHeaders()->get('Content-Transfer-Encoding');
// 		$msMsg = 'Here is the message';

// 		// Get message header
// 		$headers = $message->getHeaders();
// 		$str = str_replace($m3,$m2.'>',$headers);

// 		$msHeader = array(
// 			'Message_ID' 				=> $sm_message_id,
// 			'Date' 		                => $msgDate,
// 			'Subject'                   => $msgSubject,
// 			'From'                      => $msgFrom,
// 			'To'                        => $msgTo,
// 			'MIME_Version'              => $msMIME_Version,
// 			'Content_Type'              => $msContent_Type,
// 			'Content_Transfer_Encoding' => $msContent_Transfer_Encoding,
// 			'Msg' => $msMsg
// 		);

// 		// Save Information into databse
// 		$emailArr = $conn->createEmail_bodyTb($array, $msHeader); // Insert into email table

// 		// Check if one row is inserted into database
// 		if(($emailArr[0] == 1) && ($conn->createErrors_Tb(self::EMAIL_SENT, 'No error') == 1))	{
// 			$senrArr = array(
// 				'email_address' => $vTo,
// 				'email_body_id' => $emailArr[1],
// 				'error_id'      => self::EMAIL_SENT,
// 				'client_id'     => $vPubId,
// 				'magazine_id'   => $vMagazineId,
// 				'category_id'   => $vCategoryId,
// 				'sm_message_id' => $sm_message_id
// 			);

// 			// Send Email
// 			try	{
// 				// Check if email was sent
// 				if (!$mailer->send($message, $failures)) {
// 					// Update errors table
// 					// Search error id and replace
// 					$error_key = array_search(self::EMAIL_SENT, $senrArr);
// 					$senrArr[$error_key] = self::SERVER_ERROR_NOT_RESPONDING;

// 					// Update errors table and populate sent table
// 					$conn->createErrors_Tb(self::SERVER_ERROR_NOT_RESPONDING, 'STMP error');
// 					$conn->createSentTb($senrArr);
// 					return self::SERVER_ERROR_NOT_RESPONDING;
// 				}
// 				else {
// 					// Update errors table and populate sent table
// 					$conn->createErrors_Tb(self::EMAIL_SENT, 'No error');
// 					$conn->createSentTb($senrArr);
// 					return self::EMAIL_SENT;
// 				}
// 			}
// 			catch (MyMailerException $e2) {
// 				// Server error report
// 				$conn->createErrors_Tb(self::SERVER_ERROR_NOT_RESPONDING, 'SMTP Server not responding');
// 				throw MyMailerException(self::SERVER_ERROR_NOT_RESPONDING);
// 			}
// 		}
// 		else {
// 			// Database error report
// 			$conn->createErrors_Tb(self::DATABASE_ERROR_FAIL, 'Database error');
// 			return self::DATABASE_ERROR_FAIL;
// 		}
// 	}
// 	//}
// 	//catch (MyMailerException $e) {
// 	//	throw MyMailerException(self::EMAIL_ERROR_NOT_VALID);
// 		//}

// 		$conn->close_connection();
// 	}
