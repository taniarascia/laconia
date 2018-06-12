<?php

function getControllerName($path) {
    $path = ltrim($path, '/');                                        // Strip trailing whitespace
    $path = ucfirst($path);                                           // Capitalize first letter
    $path = implode('-', array_map('ucfirst', explode('-', $path)));  // Capitalize all hyphenated words
    $path = str_replace('-', '', $path);                              // Remove dashes     
    
    return $path;                      
}