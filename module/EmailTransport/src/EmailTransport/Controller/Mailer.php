<?php
namespace EmailTransport\Controller;

use Doctrine\ORM\Tools\Setup;
use Doctrine\ORM\EntityManager;

use Doctrine\ORM\Mapping\Driver\AnnotationDriver;
use Doctrine\Common\Annotations\AnnotationReader;
use Doctrine\Common\Annotations\AnnotationRegistry;
use EmailTransport\Controller\Exception\ExceptionInterface;


require_once 'vendor/autoload.php';
require_once dirname(__DIR__) . "/Entity/Category.php";

/**
 *
 */
class Mailer
{
	private $db;
	private $transport;
	private $message;
	private $decoratorPlugin = null;

	private $clientId;
	private $clientName;
	private $pubId;
	private $magazineId;
	private $magazineAbbr;
	private $magazineName;
	private $categoryId;
	private $categoryName;

	private $exceptionCollection = array();

	private static $required = array(
		'to'      => Error::ADDRESS_RECIPIENT_INVALID,
		'from'    => Error::ADDRESS_SENDER_INVALID,
		'subject' => Error::MESSAGE_SUBJECT_EMPTY,
		'html'    => Error::MESSAGE_BODY_HTML_EMPTY,
		'text'    => Error::MESSAGE_BODY_TEXT_EMPTY
	);

	/**
	 * Factory unpacker of $messageData, if available.
	 *
	 * @param Array $messageData
	 */
	public function __construct($messageData = array())
	{
		$this->setupDb();
		$this->unpackMessageData($messageData);
        
		if (0 < count($this->exceptionCollection)) {
			 $this->logAndThrowException(new Exception\InvalidRemoteAddressException(Error::IP_BLACKLISTED));
		} else {
            
		    $this->setTransport(\Swift_Mailer::newInstance(Smtp::newInstance()));
			$this->setMessage(new Message($messageData));
			$this->exchangeSet($messageData);
		}
	}

	public function getTransport()
	{
		return $this->transport;
	}
	public function setTransport($transport)
	{
		$this->transport = $transport;
	}

	public function getMessage()
	{
		return $this->message;
	}
	public function setMessage($message)
	{
		$this->message = $message;
	}

	public function getDecoratorPlugin()
	{
		return $this->message;
	}
	public function setDecoratorPlugin($decorator)
	{
		$this->decoratorPlugin = $decorator;
	}

	public function getClientId()
	{
		return $this->clientId;
	}
	public function setClientId($clientId)
	{
		$this->clientId = $clientId;
	}

	public function getClientName()
	{
		return $this->clientName;
	}
	public function setClientName($clientName)
	{
		$this->clientName = $clientName;
	}

	public function getPubId()
	{
		return $this->pubId;
	}
	public function setPubId($pubId)
	{
		$this->pubId = $pubId;
	}

	public function getMagazineId()
	{
		return $this->magazineId;
	}
	public function setMagazineId($magazineId)
	{
		$this->magazineId = $magazineId;
	}

	public function getMagazineAbbr()
	{
		return $this->magazineAbbr;
	}
	public function setMagazineAbbr($magazineAbbr)
	{
		$this->magazineAbbr = $magazineAbbr;
	}

	public function getMagazineName()
	{
		return $this->magazineName;
	}
	public function setMagazineName($magazineName)
	{
		$this->magazineName = $magazineName;
	}

	public function getCategoryId()
	{
		return $this->categoryId;
	}
	public function setCategoryId($categoryId)
	{
		$this->categoryId = $categoryId;
	}

	public function getCategoryName()
	{
		return $this->categoryName;
	}
	public function setCategoryName($categoryName)
	{
		$this->categoryName = $categoryName;
	}

	public function addException(ExceptionInterface $e)
	{
		array_push($this->exceptionCollection, $e);
	}

	public function send($message = null)
	{
		if (null === $message) $message = $this->getMessage();
		if ($this->inspectMessage($message)) {
			if (null !== ($plugin = $this->getDecoratorPlugin())) {
				$this->getTransport()->registerPlugin($plugin);
			}
			if (Validator\Ip::isValid($_SERVER['REMOTE_ADDR'])) {
               
				return $this->getTransport()->send($this->getMessage()->prepare());
			} else {
				$this->logAndThrowException(new Exception\InvalidRemoteAddressException(Error::IP_BLACKLISTED));
			}
		} else {
           
			// do something about it, punk
		}
	}

	private function setupDb()
	{
		$paths = array("../Entity");
		$isDevMode = true;

		// the connection configuration
		/*$dbParams = array(
			'driver'   => 'pdo_mysql',
			'host'     => 'orion',
			'user'     => 'mailman',
			'password' => 'gimmedatbunnyhood',
			'dbname'   => 'emailtransport',
		);*/
         $dbParams = array(
                    'driver'   => 'pdo_mysql',
                    'host'     => 'localhost',
                    'port'     => '3306',
                    'user'     => 'root',
                    'password' => 'alojo',
                    'dbname'   => 'emailtransport',
             );

	//	$config = Setup::createAnnotationMetadataConfiguration($paths, $isDevMode);
	//	$this->db = EntityManager::create($dbParams, $config);
     //   $article = $this->db->find('EmailTransport\Entity\Category', $id);
        
        $config = Setup::createConfiguration($isDevMode);
        $driver = new AnnotationDriver(new AnnotationReader(), $paths);

        // registering noop annotation autoloader - allow all annotations by default
        AnnotationRegistry::registerLoader('class_exists');
        $config->setMetadataDriverImpl($driver);

        $em = EntityManager::create($dbParams, $config);

    //    $user = $em->find('EmailTransport\Entity\Category', 1);
      
 
	}

	private function exchangeSet($data)
	{
		foreach ($data as $key => $value) {
			$ucfKey = ucfirst($key);
			if (method_exists($this, "set{$ucfKey}")) $this->set{$ucfKey}($value);
		}
	}

	/**
	 * Iterates through $data and collects/arranges it into something usable
	 *
	 * @param Array $data
	 * @return void
	 */
	private function unpackMessageData(&$data)
	{
		$decorations = null;
		foreach ($data as $key => &$value) {
			switch ($key) {
				case 'to':
				case 'from':
					if (is_string($value)) {
                        
						if ((new Validator\File())->isValid($value)) {
							/** @todo parse file into PHP Array as array('email' => 'name') */
							try {
								$value = Helper\File::parse($file);
							} catch (Exception $e) {
								$this->addException($e);
							}
							$decorations = Helper\Decoration::extract($value);
						} else if (!(new Validator\EmailAddress())->isValid($value)) {
							$this->addException(new Exception\UnexpectedValueException(Error::EMAIL_ADDRESS_INVALID));
						}
					} else if (is_array($value)) {
						// make sure keys are addresses and values are names
					}
					break;
				case 'message':
					if (!empty($value['html'])) {
						if (Validator\File::isValid($value['html'])) {
							$value['html'] = file_get_contents($value['html']);
						} else if (Validator\Html::isValid($value['html'])) {
							// do nothing. value is good.
						} else {
							$this->addException(new Exception\UnexpectedValueException(Error::MESSAGE_BODY_EMPTY));
						}
					}
					if (!empty($value['text'])) {
						if (Validator\File::isValid($value['text'])) {
							$value['text'] = file_get_contents($value['text']);
						}
					}
					break;
				case 'attachments':
					if (is_numeric($value)) {

					} else if (is_string($value)) {
						if (Validator\File::isValid($value)) {
							$value = array($value);
						}
					} else if (is_array($value)) {
						// make sure keys are addresses and values are names
						foreach ($value as $filename) {
							if (!Validator\File::isValid($filename)) {
								$this->addException(new Exception\InvalidFileException(Validator\File::getReason($filename)));
							}
						}
					}
					break;
				default:
					break;
			}
		}
		if (isset($decorations) && !empty($decorations)) {
			$this->setDecoratorPlugin(new Swift_Plugins_DecoratorPlugin($decorations));
		}
	}

	private function inspectMessage($message)
	{
		$ready = true;
		$body = array();
		if ($message instanceof Message) {
			foreach ($message->toArray() as $key => $value) {
				$hasBody = false;
				if (in_array($key, array_keys(static::$required))) {
					if (in_array($key, array('html','text'))) {
						if (null !== $value) array_push($body, $key);
					} else if (null === $value) {
						$ready = false;
					}
				}
			}
			if (0 == count($body)) {
				$ready = false;
			}
		} else {
			$ready = false;
		}
		return $ready;
	}

	private function logAndThrowException($e)
	{
		// do something about $e
		throw $e;
	}
}
