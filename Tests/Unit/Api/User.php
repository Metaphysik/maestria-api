<?php
namespace Maestria\Api {
	class User {}
}

namespace Maestria\Api\Tests\Unit {



    class User extends \atoum\test
    {
        public function beforeTestMethod($testMethod)
        {
            $this->define->api = '\Camael\Api\Tests\Unit\Asserters\Api';
        }

        public function testIndex()
        {
            $api = $this->api;

            $api->get('/')->body->contains('Bouya');
            $api->get('/login')->json->hasKey('d');
        }

    }
}
