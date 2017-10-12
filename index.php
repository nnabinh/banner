<?php
require('config.php');
require('classes/Bootstrap.php');
require('classes/Model.php');

require('controllers/banner.php');

require('models/banner.php');

$bootstrap = new Bootstrap($_GET);
$controller = $bootstrap->createController();

if ($controller) {
    $controller->executeAction();
}
