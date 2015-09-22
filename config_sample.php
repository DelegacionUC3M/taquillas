<?php

/* Define ABSPATH as this files directory. */
define( 'ABSPATH', dirname(__FILE__) . '/' );
/* Roles mas privilegios = un numero mas grande. */
define('ROL_USUARIO', 10);
define('ROL_ADMIN', 50);
define('ROL_MANAGER', 100);
// LDAP Parameters
define('LDAP_HOST', '');
define('LDAP_BASE_DN', ');
define('LDAP_IDFIELD', '');
define('LDAP_NAMEFIELD', '');
define('LDAP_MAILFIELD', '');
define('LDAP_MAILALIASFIELD', '');
date_default_timezone_set('Europe/Madrid');
/* SQL Parameters */
define('SQL_HOST', 'localhost');
define('SQL_DB', 'taquillas');
define('SQL_DB_DELEGADOS', 'delegados');
define('SQL_PASSWD', 'password');
define('SQL_USER', 'user');
define('SQL_PORT', 3306);
define('APPID', 4);
define('BLOQUEAR',0);
