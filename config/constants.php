<?php

define('SITE_NAME', 'Laconia');

define('DISALLOWED_USERNAMES', [
    'create',
    'create-list',
    'create-password',
    'edit',
    'edit-list',
    '404',
    'login',
    'logout',
    'settings',
    'admin',
    'view-users',
    'user-profile',
    'home',
    'index',
    'register',
    'forgot-password',
    'forgot-password-process',
]);

// Password validation
define('PASSWORD_TOO_SHORT', 'Password must contain at least 8 characters.');
define('PASSWORD_NEEDS_NUMBER', 'Password must contain at least 1 number.');
define('PASSWORD_NEEDS_UPPERCASE', 'Password must contain at least 1 uppercase letter.');
define('PASSWORD_NEEDS_UPPERCASE', 'Password must contain at least 1 lowercase letter.');
define('PASSWORD_MISSING', 'You must include a password.');

// Username validation
define('USERNAME_EXISTS', 'That username already exists.');
define('USERNAME_NOT_APPROVED', 'That username is not approved.');
define('USERNAME_MISSING', 'You must include a username.');
define('USERNAME_TOO_SHORT', 'Username must contain at least 4 characters.');
define('USERNAME_CONTAINS_DISALLOWED', 'Your username cannot contain special characters');

// Email validation
define('EMAIL_EXISTS', 'That email already exists.');
define('EMAIL_NOT_EXISTS', 'That email address was not found in our system!');
define('EMAIL_MISSING', 'You must include an email address.');

// Lists
define('LIST_CREATE_SUCCESS', 'List successfully created!');