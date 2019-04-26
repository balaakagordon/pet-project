<?php

require_once dirname(__DIR__) . '/vendor/autoload.php';

ini_set('user_agent', 'PHP');

$uri = urldecode(
    parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH)
);

if ($uri === '/') {
    require 'login.php';
    exit;
}

if(substr($uri, -4) !== ".php") {
    $uri .= ".php";
}

if ($uri !== '/' && file_exists(__DIR__.$uri)) {
    require __DIR__ . "/" . $uri;
} else {
    include "404.php";
}
