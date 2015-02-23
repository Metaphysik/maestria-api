<?php
namespace Application\Controller\Tests\Unit {

    class Question extends \atoum\test
    {
        public function beforeTestMethod($testMethod)
        {
            $this->define->api = '\Camael\Api\Tests\Unit\Asserters\Api';
        }

        // index   => List all users
        public function testIndex()
        {
            $api        = $this->api;
            $request    = $api->get('/evaluation/1/question/');

            // echo $api->echoBody();
            
            $request->json
                ->hasKey('status')
                ->integer['status']->isIdenticalTo(200)
                ->integer['log'][0]['nb']
            ;

            $request->data 
                ->string[0]['idQuestion']->isIdenticalTo('1')
                ->string[0]['title']
            ;
         
        }

        // show    => get user
        public function testShow()
        {
            $api        = $this->api;
            $request    = $api->get('/evaluation/1/question/1');

            // echo $api->echoBody();
            
            $request->json
                ->hasKey('status')
                ->integer['status']->isIdenticalTo(200)
                ->string['log'][0]->isIdenticalTo('question 1 exists')
            ;

            $request->data 
                ->string['idQuestion']->isIdenticalTo('1')
            ;
            
            $request    = $api->get('/evaluation/1/question/999999999'); // Bad user

            // echo $api->echoBody();
            
            $request->json
                ->hasKey('status')
                ->integer['status']->isIdenticalTo(500)
                ->string['error'][0]->isIdenticalTo('question 999999999 not exists')
            ;
        }
    }
}
