<?php
namespace EmailTransport\Controller\Validator;

use EmailTransport\Error;
use EmailTransport\Controller\Validator\ValidatorInterface;

class EmailAddress implements ValidatorInterface
{
    protected $validator;
	/**
	 * Checks if $email contains valid format
	 * @param String $email
	 * @return boolean
	 */
	public function isValid($email)
	{
        if (empty($this->validator)) {
            $this->setValidatorService(new \Zend\Validator\EmailAddress());
        }
		return $this->validator->isValid($email);
	}

    /**
     * [setValidatorService description]
     * @param [type] $validator [description]
     */
    public function setValidatorService($validator)
    {
        if (!method_exists($validator, 'isValid')) {
            throw new Exception\InvalidServiceException(Error::SERVICE_INVALID);
        }
        $this->validator = $validator;
        return $this;
    }

    /**
     * [__invoke description]
     * @param  [type] $email [description]
     * @return [type]        [description]
     */
    public function __invoke($email)
    {
        return $this->isValid($email);
    }
}
