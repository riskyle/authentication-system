<?php

function checkInputs($data)
{
    $data = trim($data);
    $data = stripslashes($data);
    $data = strip_tags($data);
    $data = htmlspecialchars($data);
    return $data;
}

function ipAddress()
{
    if (!empty($_SERVER['HTTP_CLIENT_IP'])) {
        $ipAddr = $_SERVER['HTTP_CLIENT_IP'];
    } elseif (!empty($_SERVER['HTTP_X_FORWARD_FOR'])) {
        $ipAddr = $_SERVER['HTTP_X_FORWARD_FOR'];
    } else {
        $ipAddr = $_SERVER['REMOTE_ADDR'];
    }
    return $ipAddr;
}

function env($var)
{
    $ENV = parse_ini_file('.env');

    $value = $ENV[$var];

    return $value;
}
