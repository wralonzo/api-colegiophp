<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Home::index');
$routes->resource('alumnos', ['controller' => 'AlumnoController']);
$routes->resource('asistencias', ['controller' => 'AsistenciaController']);
$routes->resource('clases', ['controller' => 'ClaseController']);
$routes->resource('clasealumnos', ['controller' => 'ClaseAlumnoController']);
$routes->resource('grados', ['controller' => 'GradoController']);
$routes->resource('notas', ['controller' => 'NotasController']);


$routes->get('alumnos/clase', 'ClaseAlumnoController::alumnosPorClase');




$routes->get('send-email', 'EmailController::send_email');
