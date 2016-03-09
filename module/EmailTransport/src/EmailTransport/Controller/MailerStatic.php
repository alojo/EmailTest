<?php

namespace EmailTransport\Controller;

use EmailTransport\Error;
use EmailTransport\Validator\Html;

/**
 * Wrapper class for EmailTransport
 * to be able to send mail statically.
 *
 * @author jcatibog
 */
class MailerStatic
{
    /**
     * Send email using $array params as Factory.
     *
     * @param Array $array
     *
     * @throws Exception\InvalidArgumentException
     */
    public static function send($array = array())
    {
        if (empty($array)) {
            throw new Exception\InvalidArgumentException(Error::STATIC_NO_DATA);
        } else {
            $mailer = new Mailer($array);
            $mailer->send();
        }
    }

    /**
     * Send email, receiving same parameter signature as PHP mail().
     *
     * @param String $to
     * @param String $subject
     * @param String $message
     * @param String $additional_headers    (optional)
     * @param String $additional_parameters (optional)
     *
     * @throws Exception\InvalidArgumentException(Error::ADDRESS_RECIPIENT_INVALID)
     * @throws Exception\InvalidArgumentException(Error::MESSAGE_SUBJECT_EMPTY)
     * @throws Exception\InvalidArgumentException(Error::MESSAGE_BODY_EMPTY)
     */
    public static function mail($to, $subject, $message, $additional_headers = '', $additional_parameters = '')
    {
        if (empty($to)) {
            throw new Exception\InvalidArgumentException(Error::ADDRESS_RECIPIENT_EMPTY);
        } elseif (!(new Validator\EmailAddress())->isValid($to)) {
            throw new Exception\InvalidArgumentException(Error::ADDRESS_RECIPIENT_INVALID);
        } elseif (empty($subject)) {
            throw new Exception\InvalidArgumentException(Error::MESSAGE_SUBJECT_EMPTY);
        } elseif (empty($message)) {
            throw new Exception\InvalidArgumentException(Error::MESSAGE_BODY_EMPTY);
        } else {
            $array = array(
                'to' => $to,
                'from' => 'webmaster@cdsglobal.ca',
                'message' => array(),
            );

            if ((new Validator\Html())->isValid($message)) {
                $array['message']['html'] = $message;
            } else {
                $array['message']['text'] = $message;
            }

            (new Mailer($array))->send();
        }
    }
}
