<?php 

/**
 * 
 */
class DBDelegados.php{

	/**
	 * Obtiene el rol de un usuario en función de su nia
	 * @param  string $nia 	nia del usuario
	 * @return string $data rol del usuario
	 */
	public static function getRol ($nia){
		$db = new DB(SQL_DB_DELEGADOS);
		$db->run('SELECT permisos.rol FROM permisos LEFT JOIN personas ON permisos.id = personas.id WHERE personas.nia =? AND permisos.app_id=4', array($nia));

		$data = $db->data();
		return $data[0]['rol'];		
	}
}

?>