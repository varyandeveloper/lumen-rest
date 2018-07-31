<?php

require_once __DIR__ .'/vendor/autoload.php';

try {
    $file = __DIR__ . '/.env';
    $config = parse_ini_file($file);
    $config['APP_KEY'] = str_random(32);
    $content = '';

    foreach ($config as $key => $value) {
        $content .= "$key=$value\n";
    }

    file_put_contents($file, $content);

} catch (\Throwable $exception) {
    exit('Can`t set APP_KEY in .env file');
}