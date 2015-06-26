<?php

/* Define ABSPATH as this files directory. */
define( 'ABSPATH', dirname(__FILE__) . '/' );
/* Roles mas privilegios = un numero mas grande. */
define('ROL_USUARIO', 10);
define('ROL_ADMIN', 50);
define('ROL_MANAGER', 100);
// LDAP Parameters
define('LDAP_HOST', 'ldaps://ldap.uc3m.es');
define('LDAP_BASE_DN', 'ou=Gente,o=Universidad Carlos III,c=es');
define('LDAP_IDFIELD', 'uid');
define('LDAP_NAMEFIELD', 'cn');
define('LDAP_MAILFIELD', 'mail');
define('LDAP_MAILALIASFIELD', 'uc3mcorreoalias');
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
