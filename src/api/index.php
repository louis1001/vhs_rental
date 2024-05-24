<?php
    $al = require __DIR__ . '/../vendor/autoload.php';

    $router = require 'routes/index.php';

    $router->dispatch();
?>