<?php
$red = "Valor";


$response = $red ?: (get("aaa") ?? getb("aaa"));

echo $response;

function get($aaa)
{
    return "aaa";
}

function getb($aaa)
{
    return $aaa . "bbb";
}