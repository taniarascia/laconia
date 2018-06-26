<?php

// Site
define('SITE_NAME', 'Laconia');

// Reserved names
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

// Login
define('LOGIN_FAIL', 'Incorrect username / password combination!');

// Password validation
define('PASSWORD_TOO_SHORT', 'Password must contain at least 8 characters');
define('PASSWORD_NEEDS_NUMBER', 'Password must contain at least 1 number');
define('PASSWORD_NEEDS_UPPERCASE', 'Password must contain at least 1 uppercase letter');
define('PASSWORD_NEEDS_UPPERCASE', 'Password must contain at least 1 lowercase letter');
define('PASSWORD_MISSING', 'You must include a password');

// Username validation
define('USERNAME_EXISTS', 'That username already exists');
define('USERNAME_NOT_EXISTS', 'That username does not exist');
define('USERNAME_NOT_APPROVED', 'That username is not approved');
define('USERNAME_MISSING', 'You must include a username');
define('USERNAME_TOO_SHORT', 'Username must contain at least 3 characters');
define('USERNAME_TOO_LONG', 'Username must be shorter than 50 characters');
define('USERNAME_CONTAINS_DISALLOWED', 'Your username cannot contain special characters');

// Email validation
define('EMAIL_EXISTS', 'Email address already exists');
define('EMAIL_NOT_EXISTS', 'Email address not found in our system');
define('EMAIL_MISSING', 'You must include an email address');
define('EMAIL_NOT_VALID', 'Email address is not valid');

// Lists
define('LIST_CREATE_SUCCESS', 'List successfully created');
define('LIST_CREATE_FAIL', 'Your list was not created! Please fill out all fields');
define('LIST_UPDATE_SUCCESS', 'List successfully updated');

// Settings
define('SETTINGS_UPDATE_SUCCESS', 'Settings successfully updated!');