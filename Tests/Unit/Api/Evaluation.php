<?php
namespace Application\Controller\Tests\Unit {

    class Evaluation extends \atoum\test
    {
        public function beforeTestMethod($testMethod)
        {
            $this->define->api = '\Camael\Api\Tests\Unit\Asserters\Api';
        }

        // index   => List all users ?nb=50&start=50 | ?filter=(all|count)
        public function testIndex()
        {
            $api        = $this->api;
            $request    = $api->get('/evaluation/');
            
            // echo $api->echoBody();

            $request->json
                ->hasKey('status')
                ->integer['status']->isIdenticalTo(200)
                ->integer['log'][0]['nb']->isIdenticalTo(12)
            ;

            $request->data->string[0]['idEvaluation'];
            $request->data->string[0]['label'];
            $request->data->string[0]['description'];
            $request->data->string[0]['user'];
        }

        // show    => get user
        public function testShow()
        {
            $api        = $this->api;
            $request    = $api->get('/evaluation/1');

            // echo $api->echoBody();
            
            $request->json
                ->hasKey('status')
                ->integer['status']->isIdenticalTo(200)
                ->string['log'][0]->isIdenticalTo('evaluation 1 exists')
            ;

            $request->data 
                ->string['idEvaluation']->isIdenticalTo('1')
            ;
            
            $request    = $api->get('/evaluation/999999999'); // Bad user

            // echo $api->echoBody();
            
            $request->json
                ->hasKey('status')
                ->integer['status']->isIdenticalTo(500)
                ->string['error'][0]->isIdenticalTo('evaluation 999999999 not exists')
            ;

        }
    }
}
