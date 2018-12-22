<?php

/**
 * Get filtered $_POST values.
 * Return an array.
 */
function filter_post() 
{
    $post = filter_input_array(INPUT_POST);
    $post = array_map('trim', $post);
    $post = array_map ('htmlspecialchars', $post);
    
    return $post;
}

/**
 * Get filtered $_GET values.
 * Return an array.
 */
function filter_get() 
{
    $get = filter_input_array(INPUT_GET);
    $get = array_map('trim', $get);
    $get = array_map ('htmlspecialchars', $get);
    
    return $get;
}

/**
 * Get URI path.
 * Return a string.
 */
function getUri() 
{
    $uri = trim(parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH), '/');
    
    return $uri;
}

/** Get request method.
 * Return a string.
 */
function getMethod() 
{
    $method = $_SERVER['REQUEST_METHOD'];
    
    return $method;
}