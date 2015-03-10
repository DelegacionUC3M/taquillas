<?php

/**
 * Dead simple wrapper for LDAP
 *
 * @author Mario Montes González <mmontesgonz@gmail.com>
 * @throws LDAPException
 */
class LDAP {
	/**
	 * Host of LDAP
	 * @var string
	 */
	private $host		= LDAP_HOST;
	/**
	 * Distinguised Name bae for searching in LDAP
	 * @var string
	 */
	private $base_dn	= LDAP_BASE_DN;

	/**
	 * LDAP link identifier
	 * @var resource
	 */
	protected $ldap;
	/**
	 * Search result identifier
	 * @var resource
	 */
	protected $stmt;

	/**
	 * Establish LDAP connection
	 */
	function __construct() {
		$this->ldap = @ldap_connect($this->host);

		if ($this->ldap === false) {
			throw new LDAPException('Connection not established');
		} else if ($this->errno() != 0) {
			throw new LDAPException($this->error(), $this->errno());
		}
	}

	/**
	 * Search entries in LDAP
	 * @param  string $query search filter
	 * @param  array  $data  list of attributes to get
	 * @return void
	 */
	public function run($query, $data = array()) {
		$this->stmt = @ldap_search($this->ldap, $this->base_dn, $query, $data);

		if ($this->errno() != 0) {
			throw new LDAPException($this->error(), $this->errno());
		}
	}

	/**
	 * Get all entries returned by the search
	 * @return array
	 */
	public function data() {
		if (is_null($this->stmt)) {
			throw new LDAPException('Query is required');
		} else {
			$entries = @ldap_get_entries($this->ldap, $this->stmt);
			
			if ($this->errno() != 0) {
				throw new LDAPException($this->error(), $this->errno());
			} else {
				return $entries;
			}
		}
	}

	/**
	 * Get number of entries returned by the search
	 * @return int
	 */
	public function count() {
		if (is_null($this->stmt)) {
			throw new LDAPException('Query is required');
		} else {
			$entries = @ldap_count_entries($this->ldap, $this->stmt);
			
			if ($this->errno() != 0) {
				throw new LDAPException($this->error(), $this->errno());
			} else {
				return $entries;
			}
		}
	}

	/**
	 * Check identifier and password against LDAP
	 * @param  string $dn       Dintinguised Name
	 * @param  sting $password
	 * @return boolean          value of binding
	 */
	public function login($dn, $password) {
		return @ldap_bind($this->ldap, $dn, $password);
	}

	/**
	 * Get the error code
	 * @return int
	 */
	public function errno() {
		return ldap_errno($this->ldap);
	}

	/**
	 * Get the error message
	 * @return string
	 */
	public function error() {
		return ldap_error($this->ldap);
	}

}
