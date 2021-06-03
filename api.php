<?php

use App\Infrastructure\Http\Request;
use App\Presentation\Api\Controller\SearchController;
use Symfony\Component\ErrorHandler\Debug;
use Symfony\Component\Config\FileLocator;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Loader\YamlFileLoader;

require __DIR__ . '/vendor/autoload.php';

$isDebugMode = $_SERVER['APP_DEBUG'] ?? false;

if ($isDebugMode) {
    umask(0000);

    Debug::enable();
}

$containerBuilder = new ContainerBuilder();
$loader = new YamlFileLoader($containerBuilder, new FileLocator(__DIR__));
$loader->load(__DIR__ . '/config/services.yaml');

$containerBuilder->compile();

$request = Request::createFromHttpGlobals();

/** @var SearchController $controller */
$controller = $containerBuilder->get(SearchController::class);

$response = $controller($request);
$response->sendHeaders();
$response->sendContent();