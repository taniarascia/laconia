<?php

/*!
 * Laconia 
 * 
 * An MVC application written in plain PHP without libraries or frameworks.
 * 
 * PHP Version 7.2
 * 
 * @version 1.0
 * @author  Tania Rascia
 * @license https://github.com/taniarascia/laconia/blob/master/LICENSE MIT License
 * @link    https://github.com/taniarascia/laconia
 * @issues  https://github.com/taniarascia/laconia/issues
 * @since   March 14, 2018 
 * 
 * Laconia is a personal project to learn the fundamentals of programming and 
 * modern web app development from scratch. The main goals of my project are to learn 
 * MVC (Model View Controller) architecture, the OOP (Object-Oriented Programming) 
 * paradigm, routing, modern development practices, and how to tie it all together
 * to make a functional web app. 
 */

$root = __DIR__ . '/..';

require $root . '/vendor/autoload.php';

Router::load($root . '/src/routes.php')->direct(getUri(), getMethod());