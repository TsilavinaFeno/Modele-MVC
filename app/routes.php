<?php
use Core\Route;

// Initialize Route
$routes = new Route();
$routes->get('voiture', 'car/carlist/');
$routes->put('voiture/{id}', 'api/updateCarById/$1');
$routes->delete('voiture/{id}', 'api/deleteCarById/$1');

// Return all routes
return $routes;
