<?php
namespace Maestria\Api {
    class User
    {
    }
}

namespace Maestria\Api\Tests\Unit {

    class User extends \atoum\test
    {
        public function beforeTestMethod($testMethod)
        {
            $this->define->api = '\Camael\Api\Tests\Unit\Asserters\Api';
        }
    }
}
