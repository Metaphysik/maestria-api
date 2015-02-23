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

            echo $api->echoBody();
            
         
        }

        // show    => get user
        public function testShow()
        {

        }
    }
}
