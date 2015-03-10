<?php

/**
 * User object, data is from UC3M's LDAP
 */
class User {

	public $name;
	public $nia;
	public $idu;
	public $email;

	/**
	 * Find a person by NIA
	 * @param  string $nia
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
	 * Find a person by IDU
	 * @param  string $idu
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
