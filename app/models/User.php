<?php

/**
 * Objeto usuario, los datos se obtienen del LDAP de la UC3M
 */
class User {

	public $name;
	public $nia;
	public $idu;
	public $email;

	/**
	 * Encuentra una persona por NIA
	 * @param  string $nia 	NIA por el que buscar persona
	 * @return User 
	 */
	public static function findByNIA($nia) {
		$ldap = new LDAP;
		$ldap->run('uid=' . $nia, array('uid', 'cn', 'uc3midu', 'mail'));

		if ($ldap->count() > 0) {
			$result = $ldap->data()[0];

			$user = new User;
			$user->name = $result['cn'][0];
			$user->nia = $result['uid'][0];
			$user->idu = $result['uc3midu'][0];
			$user->email = $result['mail'][0];
			return $user;
		} else {
			return null;
		}
	}

	/**
	 * Encuentra a una persona por IDU
	 * @param  string $idu 	IDU por el que buscar persona
	 * @return User
	 */
	public static function findByIDU($idu) {
		$ldap = new LDAP;
		$ldap->run('uc3midu=' . $idu, array('uid', 'cn', 'uc3midu', 'mail'));

		if ($ldap->count() > 0) {
			$result = $ldap->data()[0];

			$user = new User;
			$user->name = $result['cn'][0];
			$user->nia = $result['uid'][0];
			$user->idu = $result['uc3midu'][0];
			$user->email = $result['mail'][0];
			return $user;
		} else {
			return null;
		}
	}
}