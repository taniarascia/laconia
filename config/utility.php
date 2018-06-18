<?php

function getControllerName($path) {
    $path = ltrim($path, '/');                                        // Strip trailing whitespace
    $path = ucfirst($path);                                           // Capitalize first letter
    $path = implode('-', array_map('ucfirst', explode('-', $path)));  // Capitalize all hyphenated words
    $path = str_replace('-', '', $path);                              // Remove dashes     
    
    return $path;                      
}

function filter_post() {
    $post = filter_input_array(INPUT_POST);
    $post = array_map('trim', $post);
    
    return $post;
}

function filter_get() {
    $get = filter_input_array(INPUT_GET);
    $get = array_map('trim', $get);
    
    return $get;
}