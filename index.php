<?php

// Nette Framework Microblog example


// Load Nette Framework
require __DIR__ . '/libs/Nette/loader.php';
require __DIR__ . '/libs/Texy/texy.min.php';
require __DIR__ . '/data/TemplateRouter.php';


// Configure application
$configurator = new Nette\Config\Configurator;

// Enable Nette Debugger for error visualisation & logging
$configurator->enableDebugger(__DIR__ . '/data/log');

// Create Dependency Injection container
$configurator->setTempDirectory(__DIR__ . '/data/temp');
$container = $configurator->createContainer();

// Enable template router
$container->router = new TemplateRouter('data/templates', __DIR__ . '/data/temp');

$container->addService('database', function() {
	return new Nette\Database\Connection('mysql:host=localhost;dbname=ulrik','root','');
});

// Run the application!
$container->application->run();
