<?php

namespace Camael\Api\Tests\Unit\Asserters;
use Camael\Api\Request;

class Api extends \atoum\asserters\variable {

	private $_host = '';
	private $_request = null;

	
	public function __call($name, $arg) {
		$request = new Request();

		if($this->_host !== '')
			$request->setHost($this->_host);


		$this->_request = call_user_func_array([$request, $name], $arg);

		return $this;
	}

	public function __get($key) {

		switch ($key) {
			case 'code':
			 	return $this->generator->__call('integer', array($this->_request->getStatusCode()));
				break;
			case 'body':
				return $this->generator->__call('string', array($this->_request->getBody()));
				break;
			case 'request':
				return $this->generator->__call('object', array($this->_request->getRequest()));
				break;
			case 'header':
				return $this->generator->__call('array', array($this->_request->getRequest()->));
				break;
			case 'json':
				return $this->generator->__call('array', array(json_decode($this->_request->getBody(), true)));
				break;
			default:
				break;
		}

		return $this;
	}
}
