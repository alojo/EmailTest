<?php


namespace EmailTransport\Model;

use Zend\Db\Adapter\Adapter;
use Zend\Db\TableGateway\AbstractTableGateway;

class EmailTransportTable extends AbstractTableGateway {

    protected $table = 'Mailer';

    public function __construct(Adapter $adapter) {
        $this->adapter = $adapter;
    }
}