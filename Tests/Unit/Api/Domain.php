<?php
namespace Application\Controller\Tests\Unit {

    class Domain extends \atoum\test
    {
        public function beforeTestMethod($testMethod)
        {
            $this->define->api = '\Camael\Api\Tests\Unit\Asserters\Api';
        }

        // index   => List all users
        public function testIndex()
        {
            $api        = $this->api;
            $request    = $api->get('/domain/');

            // echo $api->echoBody();
            
            $request->json
                ->hasKey('status')
                ->integer['status']->isIdenticalTo(200)
                ->integer['log'][0]['nb']->isGreaterThan(0)
            ;

            $request->data 
                ->string[0]['idDomain']->isIdenticalTo('1')
                ->string[0]['domainValue']
            ;
         
        }

        // show    => get user
        public function testShow()
        {
            $api        = $this->api;
            $request    = $api->get('/domain/1');

            // echo $api->echoBody();
            $request->json
                ->hasKey('status')
                ->integer['status']->isIdenticalTo(200)
                ->string['log'][0]->isIdenticalTo('domain 1 exists')
                ->integer['log'][1]['nb']->isGreaterThan(0)
            ;

            $request->data->string['idDomain'];
            $request->data->string['domainValue'];


            $request    = $api->get('/domain/999999999'); // Bad user

            // echo $api->echoBody();
            $request->json
                ->hasKey('status')
                ->integer['status']->isIdenticalTo(500)
                ->string['error'][0]->isIdenticalTo('domain 999999999 not exists')
            ;
        }
    }
}
