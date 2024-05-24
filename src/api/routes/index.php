<?php
namespace App\routes;

use App\controllers\RentsController;
use App\core\router\Router;
use App\controllers\TopicosController;
use App\controllers\ClientsController;
use App\controllers\MoviesController;

$router = new Router();

$router->get('/topicos', TopicosController::class, 'index');
$router->getWithParam('/topicos', TopicosController::class, 'getTopico');

$router->get('/clients', ClientsController::class, 'index');
$router->getWithParam('/clients', ClientsController::class, 'getClient');
$router->putWithParam('/clients', ClientsController::class, 'updateClient');
$router->post('/clients', ClientsController::class, 'createClient');
$router->deleteWithParam('/clients', ClientsController::class, 'deleteClient');

$router->get('/movies', MoviesController::class, 'index');
$router->getWithParam('/movies', MoviesController::class, 'getMovie');
$router->putWithParam('/movies', MoviesController::class, 'updateMovie');
$router->post('/movies', MoviesController::class, 'createMovie');
$router->deleteWithParam('/movies', MoviesController::class, 'deleteMovie');

$router->post('/rents', RentsController::class, 'createRent');

return $router;