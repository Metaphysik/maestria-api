<?php
namespace Application\Controller\Tests\Unit {

    class User extends \atoum\test
    {
        public function beforeTestMethod($testMethod)
        {
            $this->define->api = '\Camael\Api\Tests\Unit\Asserters\Api';
        }

        // index   => List all users ?nb=50&start=50 | ?filter=(all|count)
        // new     => Useless in API
        // show    => get user
        
        // create  => create an user | return user id
        // edit    => edit user information
        // update  => Useless ?
        // destroy => delete user

        public function testIndex()
        {
            $api        = $this->api;
            $request    = $api->get('/user/');

            // echo $api->echoBody();
            
            $request->json
                ->hasKey('status')
                ->integer['status']->isIdenticalTo(200)
                ->integer['log'][0]['nb']
            ;

            $request->data 
                ->string[0]['idProfil']->isIdenticalTo('1')
                ->string[0]['login']->isIdenticalTo('admin')
                ->string[0]['user']->isIdenticalTo('Administrateur')
            ;
        }

        public function testShow()
        {
            $api        = $this->api;
            $request    = $api->get('/user/1'); // Real user

            // echo $api->echoBody();
            
            $request->json
                ->hasKey('status')
                ->integer['status']->isIdenticalTo(200)
                ->string['log'][0]->isIdenticalTo('user 1 exists')
            ;

            $request->data 
                ->string['idProfil']->isIdenticalTo('1')
                ->string['login']->isIdenticalTo('admin')
                ->string['user']->isIdenticalTo('Administrateur')
            ;
            
            $request    = $api->get('/user/999999999'); // Bad user

            // echo $api->echoBody();
            
            $request->json
                ->hasKey('status')
                ->integer['status']->isIdenticalTo(500)
                ->string['error'][0]->isIdenticalTo('user 999999999 not exists')
            ;

           

        }
    }
}
