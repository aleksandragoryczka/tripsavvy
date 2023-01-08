<?php

require 'Routing.php';

$path = trim($_SERVER['REQUEST_URI'], '/');
$path = parse_url($path, PHP_URL_PATH);

Routing::get('', 'DefaultController');
Routing::get('trips', 'TripsController');
Routing::get('expenses', 'TripsController');
Routing::post('login', 'SecurityController');
Routing::post('register', 'SecurityController');
Routing::post('addTrip', 'TripsController');
Routing::post('search', 'TripsController');
Routing::post('addExpense', 'TripsController');
Routing::post('getExpensesViaTrip', 'TripsController');


Routing::run($path);