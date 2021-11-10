<?php

require_once "Routing.php";

$path = trim($_SERVER['REQUEST_URI'],'/');
Router::run($path);
