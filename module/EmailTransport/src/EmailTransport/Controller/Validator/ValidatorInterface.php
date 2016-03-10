<?php

namespace EmailTransport\Controller\Validator;

interface ValidatorInterface {
    public function isValid($value);
    public function setValidatorService($validator);
    public function __invoke($value);
}
