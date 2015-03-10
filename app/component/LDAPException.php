<?php

/**
 * LDAP Exception
 */
class LDAPException extends Exception {

	function __construct($error, $errno = -1) {
		parent::__construct($error, $errno);
	}

}
