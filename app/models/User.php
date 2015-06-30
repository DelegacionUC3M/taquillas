<?php

/**
 * Objeto usuario, los datos se obtienen del LDAP de la UC3M
 */
class User {

	/** User identifier. **/
	public $uid; 
    /** User full name. **/
    public $cn; 
    /** User email account.**/
    public $mail; 
    /** User LDAP path.**/
    public $dn;
    /** User rol (10 student, 100 admin) **/
    public $rol;

	public function __construct($nia = NULL, $cn = NULL, $mail = NULL,$dn = NULL) {
    	$this->uid = $nia;
    	$this->cn = $cn;
    	$this->mail = $mail;
    	$this->dn = $dn;
       	print_r("antes DBDelegados en User");
	$rol = DBDelegados::getRol($nia);
	print_r("Despues DBDelegados");
	$this->rol = !empty($rol) ? $rol : 10;
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
			$user = new User($result['uid'][0], $result['cn'][0], $result['mail'][0], $result['dn']);
			return $user;
		} else {
			return null;
		}
	}
}
