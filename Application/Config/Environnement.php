<?php
/**
 * @var \Sohoa\Framework\Environnement $this;
 */
$app = resolve('hoa://Application/');

// Autoconfiguration du PATH
$paths = [
    $app.'/../../maestria-web/', // Bureau
    $app.'/../../maestria/www/', // Maison
];

$db = false;
foreach ($paths as $key => $value) {
    if ($db === false) {
        if (false !== $db = realpath($value)) {
            break;
        }
    }
}

if ($db === false) {
    throw new \Exception("You need to config the Maestria config dir in ".__FILE__, 1);
}

if (file_exists($db.'/Application/Database/Maestria.db') === false) {
    throw new \Exception('You need to install/generate Metaphsik/Maestria-web repository before use it');
}

\Hoa\Database\Dal::initializeParameters(array(
    'connection.list.default.dal' => Hoa\Database\Dal::PDO,
    'connection.list.default.dsn' => 'sqlite:'.$db.'/Application/Database/Maestria.db',
    'connection.autoload' => 'default',
));

return [];
