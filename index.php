<?php

require 'Routing.php';

$path = trim($_SERVER['REQUEST_URI'], '/');
$path = parse_url($path, PHP_URL_PATH);

Routing::get('', 'DefaultController');
Routing::get('trips', 'TripsController');
Routing::post('login', 'SecurityController');
Routing::post('addTrip', 'TripsController');
Routing::post('register', 'SecurityController');
//TODO: czy na pewno routing ok?

Routing::run($path);