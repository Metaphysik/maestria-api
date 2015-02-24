<?php
namespace Application\Controller\Tests\Unit {

    class Answer extends \atoum\test
    {
        public function beforeTestMethod($testMethod)
        {
            $this->define->api = '\Camael\Api\Tests\Unit\Asserters\Api';
        }

        public function testIndex()
        {
            $api        = $this->api;
            $request    = $api->get('/evaluation/1/answer/');

            // echo $api->echoBody();

            $request->json
                ->hasKey('status')
                ->integer['status']->isIdenticalTo(200)
                ->string['log'][0]->isIdenticalTo('answer 1 exists')
            ;

            $request->data->string['idAnswer']->isIdenticalTo('1');
            $request->data->string['login'];
            $request->data->string['user'];
            $request->data->array['note']->isNotEmpty();
        }

        public function testUserIndex()
        {
            $api        = $this->api;
            $request    = $api->get('/user/1/evaluation/1/answer/');

            // echo $api->echoBody();

             $request->json
                ->hasKey('status')
                ->integer['status']->isIdenticalTo(500)
                ->string['error'][0]->isIdenticalTo('answer 1 not exists with 1 user_id')
            ;

            $request    = $api->get('/user/6/evaluation/1/answer/');

            // echo $api->echoBody();

             $request->json
                ->hasKey('status')
                ->integer['status']->isIdenticalTo(200)
                ->string['log'][0]->isIdenticalTo('answer 1 exists with 6 user_id')
            ;

            $request->data->string['idAnswer']->isIdenticalTo('1');
            $request->data->string['login'];
            $request->data->string['user'];
            $request->data->array['note']->isNotEmpty();
        }

    }
}
