<?php
/**
 * Zend Framework (http://framework.zend.com/)
 *
 * @link      http://github.com/zendframework/ZendSkeletonApplication for the canonical source repository
 * @copyright Copyright (c) 2005-2015 Zend Technologies USA Inc. (http://www.zend.com)
 * @license   http://framework.zend.com/license/new-bsd New BSD License
 */

 /*
   * With the table and Doctrine entity created we can now use this in our application to add data to the table. 
   * For this we need to use the Zend service locator to get the entity manager, then we can create a new 
   * instance of the user entity, populate the entity and use the entity *manager to add the data to the database.
   */


namespace EmailTransport\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;
use Doctrine\ORM\EntityManager;

use swiftmailer\lib\swift_required;



class EmailTransportController extends AbstractActionController
{
    
    public function indexAction()
    { 
        //create an object of emailtransport
        $array = [
            'to' => 'eliamaliakkal@gmail.com',
            'from' => 'alinalojo@gmail.com',
            'message' => array('text' => 'This is only a text test message')
        ];
        $emailtransport = new  MailRoom($array);
        $emailtransport->send(); 
        return new ViewModel(array(
           // 'albums' => $this->getEntityManager()->getRepository('Album\Entity\Album')->findAll(),
        )); 
    }
   
   
    /*
    $transport = Swift_MailTransport::newInstance();

    $message = Swift_Message::newInstance();
    $message->setTo(array(
      "hello@gmail.com" => "Aurelio De Rosa",
      "test@fake.com" => "Audero"
    ));
    $message->setSubject("This email is sent using Swift Mailer");
    $message->setBody("You're our best client ever.");
    $message->setFrom("account@bank.com", "Your bank");

    // Send the email
    $mailer = Swift_Mailer::newInstance($transport);
    $mailer->send($message);
 */
    

}
