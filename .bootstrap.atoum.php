<?php
require_once __DIR__ . '/vendor/autoload.php';


\atoum\autoloader::get()->addDirectory('Camael\Api\Tests\Unit\Asserters', __DIR__ . '/Tests/Unit/Asserters');
\atoum\autoloader::get()->addDirectory('Application\Controller', __DIR__ . '/Application/Controller');

$app = __DIR__;
$paths = [
    $app.'/../maestria-web/', // Bureau
    $app.'/../maestria/www/', // Maison
];

$db = false;
foreach ($paths as $key => $value) {
    if ($db === false) {
        if (false !== $db = realpath($value)) {
            break;
        }
    }
}

\atoum\autoloader::get()->addDirectory('Application\Model', $db. '/Application/Model'); // TODO : Make it with HOA !!!