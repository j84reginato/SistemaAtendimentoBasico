<?php

use j84Reginato\MyFramework\Application\Application;

require_once __DIR__ . '/../config/application.php';
require_once __DIR__ . '/../vendor/autoload.php';

$system = Application::getInstance();
$system->setup();
$system->run();