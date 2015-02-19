<?php
namespace Maestria\Api {
	class Main {}
}

namespace Maestria\Api\Tests\Unit {

    class Main extends \atoum\test
    {
    	public function beforeTestMethod($testMethod)
        {
            $this->define->api = '\Camael\Api\Tests\Unit\Asserters\Api';
        }

        public function testRoot()
        {
        	$this->api->get('/')->body->contains('Maestria API');
        }

        public function testLogin()
        {
        	$json = $this
                       ->api
                        ->get('/login', ['user' => 'Hello'])
                        ->json
                    ;

            $json
                ->hasKey('d')
                ->string['d']->isIdenticalTo('wawa')
                ->string['c']->isIdenticalTo('a')
            ;

        }

    }
}
