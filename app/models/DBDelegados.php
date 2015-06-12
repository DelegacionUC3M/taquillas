<?php 

/**
 * 
 */
class DBDelegados {

	/**
	 * Obtiene el rol de un usuario en función de su nia
	 * @param  string $nia 	nia del usuario
	 * @return string $data rol del usuario
	 */
	public static function getRol ($nia){
		$db = new DB(SQL_DB_DELEGADOS);
		$db->run('SELECT permisos.rol FROM permisos LEFT JOIN personas ON permisos.id = personas.id WHERE personas.nia =? AND permisos.app_id=' . APPID, array($nia));

		$data = $db->data();
		return $data[0]['rol'];		
	}

	/**
	 * Se añade un nuevo usuario a la tabla de permisos.
	 * @param  	string $nia nia del usuario
	 *			string $rol rol del usuario
	 * @return void
	 */
	public function anadirUsuario($nia, $rol) {
		$db = new DB(SQL_DB_DELEGADOS);
		$db->run('SELECT id FROM personas WHERE nia =?', array($nia));

		$data = $db->data();
		$id = $data[0]['id'];
		var_dump($id);
		$db->run('INSERT INTO permisos (id, app_id, rol) VALUES (?, 3, ?)',array($id, $rol));
	}

	/**
	 * Actualiza el rol de un usuario de la tabla permisos
	 * @param  	string $nia nia del usuario
	 *			string $rol rol del usuario
	 * @return void
	 */
	public function save($id, $rol){
		$db = new DB(SQL_DB_DELEGADOS);
		$db->run('UPDATE permisos SET rol=? WHERE id=?', array($rol, $id));
	}

	/**
	 * Elimina un usuario de la tabla de permisos.
	 * @param  	string $nia nia del usuario
	 * @return void
	 */
	public function remove($id){
		$db = new DB(SQL_DB_DELEGADOS);
		$db->run('DELETE from permisos where id=?',array($id));
	}
	
	/**
	 * Encuentra a todos los delegados de la tabla permisos.
	 * 
	 * @return array $data array con todos los elementos de la tabla.
	 */
	public function findAll (){
		$db = new DB(SQL_DB_DELEGADOS);
		$db->run('SELECT * FROM permisos');

		$data = $db->data();
		return $data;	
	}

	/**
	 * Encuentra un delegado por id.
	 * 
	 * @return array $data delegado buscado / null si no existe
	 */
	public function findById($id){
		$db = new DB(SQL_DB_DELEGADOS);
		$db->run('SELECT * FROM permisos WHERE id =?', array($id));

		$data = $db->data();
		if (empty($data)){
			return null;
		} else {
			return $data[0];
		}
	}

	/**
	 * Comprueba si el nia introducido existe.
	 * 
	 * @return nia encontrado / null si no existe
	 */
	public function existsNIA($nia) {
		$db = new DB(SQL_DB_DELEGADOS);
		$db->run('SELECT nia FROM personas WHERE nia =?', array($nia));

		$data = $db->data();
		if (!empty($data[0]['nia'])) {
			return $data[0]['nia'];	
		} else {
			return null;
		}
	}

	/**
	 * Obtiene el id del delegado en la tabla permisos mediante el NIA
	 * 
	 * @return id encontrado / null si no existe
	 */
	public function getIdByNIA($nia) {
		$db = new DB(SQL_DB_DELEGADOS);
		$db->run('SELECT id FROM personas WHERE nia =?', array($nia));

		$data = $db->data();
		$id = $data[0]['id'];

		$db->run('SELECT id FROM permisos WHERE id=?', array($id));
		$data = $db->data();
		if (!empty($data[0]['id'])) {
			return $data[0]['id'];	
		} else {
			return null;
		}
	}
}

?>