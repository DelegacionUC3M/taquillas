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

	public function anadirUsuario($nia, $rol) {
		$db = new DB(SQL_DB_DELEGADOS);
		$db->run('SELECT id FROM personas WHERE nia =?', array($nia));

		$data = $db->data();
		$id = $data[0]['id'];
		var_dump($id);
		$db->run('INSERT INTO permisos (id, app_id, rol) VALUES (?, 3, ?)',array($id, $rol));
	}

	public function save($id, $rol){
		$db = new DB(SQL_DB_DELEGADOS);
		$db->run('UPDATE permisos SET rol=? WHERE id=?', array($rol, $id));
	}

	public function remove($id){
		$db = new DB(SQL_DB_DELEGADOS);
		$db->run('DELETE from permisos where id=?',array($id));
	}
	
	public function findAll (){
		$db = new DB(SQL_DB_DELEGADOS);
		$db->run('SELECT * FROM permisos');

		$data = $db->data();
		return $data;	
	}

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

	public function findByNIA($nia) {
		$db = new DB(SQL_DB_DELEGADOS);
		$db->run('SELECT nia FROM personas WHERE nia =?', array($nia));

		$data = $db->data();
		if (!empty($data[0]['nia'])) {
			return $data[0]['nia'];	
		} else {
			return null;
		}
	}

	public function findByNIAPermisos($nia) {
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