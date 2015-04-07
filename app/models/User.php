<?php

/**
 * Objeto usuario, los datos se obtienen del LDAP de la UC3M
 */
class User {

	public $name;
	public $nia;
	public $idu;
	public $email;
	public $rol;

	public function __construct($nia,$name,$email,$dn) {
    	$this->uid = $nia;
    	$this->cn = $name;
    	$this->mail = $email;
    	$this->dn = $dn;
     //   $rol = DBDelegados::getRol($nia);
     //   $this->rol = !empty($rol) ? $rol : 10;
    	//Pedir a la base de datos si el nia esta en la tabla de usuarios.
    	$cat = explode(",",$dn);
    	$cat = str_replace("ou=", "", $cat[2]);
    	$this->category = $cat;
    }

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