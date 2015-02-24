<?php
namespace Application\Controller\Tests\Unit {

    class Classroom extends \atoum\test
    {
        public function beforeTestMethod($testMethod)
        {
            $this->define->api = '\Camael\Api\Tests\Unit\Asserters\Api';
        }

        // index   => List all users
        public function testIndex()
        {
            $api        = $this->api;
            $request    = $api->get('/classroom/');

            // echo $api->echoBody();
            
            $request->json
                ->hasKey('status')
                ->integer['status']->isIdenticalTo(200)
                ->integer['log'][0]['nb']->isGreaterThan(0)
            ;

            $request->data 
                ->string[0]['idClass']->isIdenticalTo('1')
                ->string[0]['value']
            ;
         
        }

        // show    => get user
        public function testShow()
        {
            $api        = $this->api;
            $request    = $api->get('/classroom/1');

            // echo $api->echoBody();
            //
            $request->json
                ->hasKey('status')
                ->integer['status']->isIdenticalTo(200)
                ->string['log'][0]->isIdenticalTo('class 1 exists')
                ->integer['log'][1]['nb']->isGreaterThan(0)
            ;

            $request->data->string[0]['idUserClass'];
            $request->data->string[0]['user'];
            $request->data->string[0]['token'];


            $request    = $api->get('/classroom/999999999'); // Bad user

            // echo $api->echoBody();

            $request->json
                ->hasKey('status')
                ->integer['status']->isIdenticalTo(500)
                ->string['error'][0]->isIdenticalTo('class 999999999 not exists')
            ;
        }
    }
}
