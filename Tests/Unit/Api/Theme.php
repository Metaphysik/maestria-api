<?php
namespace Application\Controller\Tests\Unit {

    class Theme extends \atoum\test
    {
        public function beforeTestMethod($testMethod)
        {
            $this->define->api = '\Camael\Api\Tests\Unit\Asserters\Api';
        }

        // index   => List all users
        public function testIndex()
        {
            $api        = $this->api;
            $request    = $api->get('/theme/');

            // echo $api->echoBody();
            
            $request->json
                ->hasKey('status')
                ->integer['status']->isIdenticalTo(200)
                ->integer['log'][0]['nb']->isGreaterThan(0)
            ;

            $request->data 
                ->string[0]['idTheme']->isIdenticalTo('1')
                ->string[0]['themeValue']
            ;
         
        }

        // show    => get user
        public function testShow()
        {
            $api        = $this->api;
            $request    = $api->get('/theme/1');

            // echo $api->echoBody();
            $request->json
                ->hasKey('status')
                ->integer['status']->isIdenticalTo(200)
                ->string['log'][0]->isIdenticalTo('theme 1 exists')
                ->integer['log'][1]['nb']->isGreaterThan(0)
            ;

            $request->data->string['idTheme'];
            $request->data->string['themeValue'];


            $request    = $api->get('/theme/999999999'); // Bad user

            // echo $api->echoBody();
            $request->json
                ->hasKey('status')
                ->integer['status']->isIdenticalTo(500)
                ->string['error'][0]->isIdenticalTo('theme 999999999 not exists')
            ;
        }
    }
}
