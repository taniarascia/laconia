<?php

/*!
 * Laconia 
 * An MVC framework from scratch in PHP
 * 
 * PHP Version 7.2
 * 
 * @version 1\2.0
 * @author  Tania Rascia
 * @license https://github.com/taniarascia/laconia/blob/master/LICENSE MIT License
 * @link    https://github.com/taniarascia/laconia
 * @issues  https://github.com/taniarascia/laconia/issues
 */
$root = __DIR__ . '/..';

require $root . '/vendor/autoload.php';

Router::load($root . '/src/app/routes.php')->direct(getUri(), getMethod());
