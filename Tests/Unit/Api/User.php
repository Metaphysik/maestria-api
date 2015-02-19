<?php
namespace Maestria\Api {
	class User {}
}

namespace Maestria\Api\Tests\Unit {



    class User extends \atoum\test
    {
        public function testIndex()
        {
            $dir = realpath(__DIR__.'/../../');
            \Sohoa\Framework\Framework::initialize($dir);


            $framework  = new \Sohoa\Framework\Framework('dev');

        	$router     = new \Mock\Sohoa\Framework\Router();
            $router->setFramework($framework);

                    

            $framework->setRouter($router);
            $dispatcher = $framework->getDispatcher();
            $view       = $framework->getView();

            $framework->initErrorHandler();
            $framework->initKit();

            $router->construct();

            var_dump($router->getMethod());
            $router->route('/');

            
            $dispatcher->dispatch($router, $view, $framework);
        }

    }
}
