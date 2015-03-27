<?php

/**
 * Dead simple wrapper for the database
 *
 * @author Mario Montes González <mmontesgonz@gmail.com>
 * @throws PDOException
 */
class DB {
	/**
	 * Driver to be used by PDO
	 * @var string
	 */
	private $driver = 'pgsql';
	/**
	 * Host of the DB
	 * @var string
	 */
	private $host 	= SQL_HOST;
	/**
	 * User to be used in the conection
	 * @var string
	 */
	private $user 	= SQL_USER;
	/**
	 * Password to be used in the connection
	 * @var sting
	 */
	private $pass 	= SQL_PASSWD;
	/**
	 * Database to be connected to
	 * @var [type]
	 */
	private $dbs;

	/**
	 * PDO Object
	 * @var PDO
	 */
	protected $db;
	/**
	 * PDO Statement
	 * @var PDOStatement
	 */
	protected $stmt;

	function __construct($sqlDb = SQL_DB) {
		$dbs = $sqlDb;
		$this->db = new PDO($this->drive.':host='.$this->host.';dbname='.$this->dbs.';charset=utf8', $this->user, $this->pass);
		$this->db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		$this->db->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
	}

	/**
	 * Prepare and execute the query
	 * @param  string $sql  query to be executed
	 * @param  array  $data data to be injected to the query
	 * @return bool       	true if success
	 */
	public function run($sql, $data = array()) {
		$this->stmt = $this->db->prepare($sql);
		return $this->stmt->execute($data);
	}

	/**
	 * Get data from last query
	 * @return array
	 */
	public function data() {
		return !is_null($this->stmt) ? $this->stmt->fetchAll(PDO::FETCH_ASSOC) : false;
	}

	/**
	 * Count the number of rows returned by last query
	 * @return int
	 */
	public function count() {
		return !is_null($this->stmt) ? $this->stmt->rowCount() : false;
	}

	/**
	 * Get id of the last inserted query
	 * @return id
	 */
	public function lastId() {
		return $this->db->lastInsertId();
	}

	/**
	 * Get error on database handle
	 * @return array
	 */
	public function errorBD() {
		return $this->db->errorInfo();
	}

	/**
	 * Get error on statement handle
	 * @return array
	 */
	public function errorStatement() {
		return !is_null($this->stmt) ? $this->stmt->errorInfo() : false;
	}

}
