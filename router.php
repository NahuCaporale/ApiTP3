<?php

require_once 'app/libs/router.php';
require_once 'app/api/pelicula.controlador.php';
require_once 'app/api/categorias.controlador.php';


// creo el router
$router = new Router();

// armo la tabla de ruteo

$router->addRoute('peliculas',          'GET',    'peliculaControlador',    'getAll');
$router->addRoute('peliculas/:id',      'GET',    'peliculaControlador',    'get');
$router->addRoute('categorias',         'GET',    'categoriasControlador',  'getAll');
$router->addRoute('categorias/:id',     'GET',    'categoriasControlador',  'get');
$router->addRoute('peliculas/:id',      'DELETE', 'peliculaControlador',    'delete');
$router->addRoute('categorias/:id',     'DELETE', 'categoriasControlador',  'delete');
$router->addRoute('categorias',         'POST',   'categoriasControlador',  'crear');
$router->addRoute('peliculas',          'POST',    'peliculaControlador',   'crear');
$router->addRoute('categorias/:id',     'PUT',     'categoriasControlador', 'editar');
$router->addRoute('peliculas/:id',      'PUT',     'peliculaControlador',   'editar');






// rutea

$router->route($_REQUEST['resource'], $_SERVER['REQUEST_METHOD']);
