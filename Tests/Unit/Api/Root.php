<?php
namespace Maestria\Api {
    class Main
    {
    }
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
            $api  = $this->api;
            $p    = $api->post('/login');
            $json = $p->json;

            echo $api->echoBody();

            $json
                ->hasKey('status')
                ->integer['status']->isIdenticalTo(500)
                ->string['error'][0]->isIdenticalTo('Post data : user are not found')
                ->string['error'][1]->isIdenticalTo('Post data : password are not found')
            ;

            $p    = $api->post('/login', ['user' => 'admin', 'password' => sha1('admin')]);
            $json = $p->json;

            echo $api->echoBody();

            $json
                ->hasKey('status')
                ->integer['status']->isIdenticalTo(200)
                ->array['error']->notContains([0, 1, 2, 3, 4, 5, 6, 7, 8, 9])
            ;
        }
    }
}
