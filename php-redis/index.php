<?php

require './classes/RedisScope.php';
require './classes/SimpleJsonRequest.php';

const REDIS_PORT = 19371;
const REDIS_SERVER = 'redis-19371.c1.us-west-2-2.ec2.cloud.redislabs.com';
const REDIS_PASSWD = "wiXzHrV2knPr9W0VwFg1tm9rG6UkLctf";
const URL = 'https://api.github.com/users/MFDonadeli';

$method = $_SERVER['REQUEST_METHOD'] ?? "GET";

$json_request = json_encode(array(
    'url' =>  URL,
    'param' => $_GET,
    'data' => $_REQUEST,
    'method' => $method));

$redis = new RedisScope();
$exception = null;

/**
 * This function has the purpose to turn on the warning message when server is not found
 * and sometimes will return an warning message on screen. The function will change the warning
 * in a ErrorException and will be treated on try catch below.
 */
set_error_handler(function ($severity, $message, $file, $line) {
    throw new \ErrorException($message, $severity, $severity, $file, $line);
});

try{
    $redis->connect(REDIS_SERVER, REDIS_PORT, REDIS_PASSWD, $exception);
} catch(Exception $e) {
    echo 'Redis server not found' . PHP_EOL;
}

restore_error_handler();

/**
 * Switch to trigger request. I am implementing just the simple call of request, not following the purpose of each request
 * The end result will be the same as GET, return a json implemented in json_response.php file
 * 
 * As documented in https://developer.mozilla.org/en-US/docs/Glossary/cacheable,
 * PUT AND DELETE methods are not cacheable, so I am not using Redis on them.
 * As POST and PATCH can be cacheable I am using Redis on them.
 */
switch($method){
    case 'GET':
        $response = $redis->get($json_request) ?: SimpleJsonRequest::get(URL, $_GET);
    break;
    case 'POST':
        $response = $redis->get($json_request) ?: SimpleJsonRequest::post(URL, $_GET, $_REQUEST);
    break;
    case 'PUT':
        $response = SimpleJsonRequest::put(URL, $_GET, $_REQUEST);
    break;
    case 'PATCH':
        $response = $redis->get($json_request) ?: SimpleJsonRequest::patch(URL, $_GET, $_REQUEST);
    break;
    case 'DELETE':
        $response = SimpleJsonRequest::delete(URL, $_GET, $_REQUEST);
    break;
}

$redis->set($response);

var_dump($response);

?>