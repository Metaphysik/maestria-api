<?php

namespace Camael\Api\Tests\Unit\Asserters;
use Camael\Api\Request;

class Api extends \atoum\asserters\variable {

	private $_host = '';
	private $_request = null;
	private $_router  = null;
	private $_dispatcher = null;
	private $_view = null;


	public function __construct() {
		parent::__construct();
 		
 		$dir = realpath(__DIR__.'/../../');
 		\Sohoa\Framework\Framework::initialize($dir);
        

        

        $this->_framework  = new \Sohoa\Framework\Framework('dev');
    	$this->_router     = new \Mock\Sohoa\Framework\Router();

        $this->_router->setFramework($this->_framework);
       	$this->_framework->setRouter($this->_router);
        
        $this->_dispatcher = $this->_framework->getDispatcher();
        $this->_view       = $this->_framework->getView();


        $this->_router->construct();


	}
	
	public function __call($name, $arg) {
		if(isset($arg[0]) === false)
        	throw new \Exception("You need and url in first argument", 0);


        $this->_router->getMockController()->getMethod = $name;
        $this->_router->route($arg[0]);


        ob_start();
        $this->_dispatcher->dispatch($this->_router, $this->_view, $this->_framework);
        $this->_request = ob_get_contents();
        ob_end_clean();

		return $this;
	}

	public function __get($key) {

		switch ($key) {
			case 'body':
				return $this->generator->__call('string', array($this->_request));
				break;
			case 'json':
				return $this->generator->__call('array', array(json_decode($this->_request, true)));
				break;
			default:
				break;
		}

		return $this;
	}
}
