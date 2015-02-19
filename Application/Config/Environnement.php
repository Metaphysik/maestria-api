<?php
/**
 * @var \Sohoa\Framework\Environnement $this;
 */
$app = resolve('hoa://Application/');
$db  = realpath($app.'/../../maestria/www/');

if ($db === false) {
    throw new \Exception("You need to config the Maestria config dir in ".__FILE__, 1);
}

\Hoa\Database\Dal::initializeParameters(array(
    'connection.list.default.dal' => Hoa\Database\Dal::PDO,
    'connection.list.default.dsn' => 'sqlite:'.$db.'/Application/Database/Maestria.db',
    'connection.autoload' => 'default',
));

return [];
