<?php

function fixInput($data)
{
    if (is_string($data)) {
        $data = str_replace("\\", "\\\\", $data);
        $data = str_replace("\'", "\\\'", $data);
    }
    return $data;
}

function getGet($key)
{
    return isset($_GET[$key]) ? fixInput($_GET[$key]) : '';
}

function getPost($key)
{
    return isset($_POST[$key]) ? fixInput($_POST[$key]) : '';
}

function getRequest($key)
{
    return isset($_REQUEST[$key]) ? fixInput($_REQUEST[$key]) : '';
}

function getCookie($key)
{
    return isset($_COOKIE[$key]) ? fixInput($_COOKIE[$key]) : '';
}

function getSession($key)
{
    return isset($_SESSION[$key]) ? fixInput($_SESSION[$key]) : '';
}

function getCookie_Session($key)
{
    if (isset($_SESSION[$key])) {
        return fixInput($_SESSION[$key]);
    }
    if (isset($_COOKIE[$key])) {
        return fixInput($_COOKIE[$key]);
    }
    return null;
}