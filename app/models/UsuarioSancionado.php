<?php

class UsuarioSancionado {

	public $user_id;
	public $fecha_sancion;
	public $taquilla_id;

	/**
	 * Encuentra usuarios sancionados segun los atributos pasados por array. En caso de pasar un array vacío funciona como un findAll.
	 * @param  array  $attributes 	array que incluye los parámetros de búsquedas. Las key del array deben ser: 'user_id' o 'fecha_sancion' o 'taquilla_id'.
	 * @return array  $sanciones 	array con el resultado de la búsqueda.       
	 */
	public static function findByAttributes($attributes = array()) {
		$db = new DB(SQL_DB);
		$search;
		if (empty($attributes)){
			$db->run('SELECT * FROM sanciones');
		}
		else{
			$cont = 0;
			$search = 'SELECT * FROM sanciones WHERE';
			foreach ($attributes as $key -> $value) {
				if($cont == count($attributes)-1) {
					if (is_null($value)) {
						$search .= ' '.$key.' IS NULL';
					} else {
						$search .= ' '.$key.'=:'.$key;
					}
				} else {
					if (is_null($value)) { 
						$search .= ' '.$key.' IS NULL AND';
					} else {
						$search .= ' '.$key.'=:'.$key.' AND';
					}
					
				}
				$cont++;
			}
			$db->run($search);
		}
		$sanciones = array();
		$data = $db->data();
		foreach ($data as $row) {
			$sancion = new Taquilla;
			foreach ($row as $key => $value) {
				$sancion->$key = $value;
			}
			$sanciones[] = $sancion;
		}
		return $sanciones;
	}

	/**
	 * Inserta un usuario en la tabla sancionados
	 * @return void
	 */
	public function save() {
		$db = new DB(SQL_DB);
		$db->run('INSERT INTO sanciones VALUES user_id=?, fecha_sancion=?, taquilla_id=?', array($this->user_id,$this->fecha_sancion, $this->taquilla_id));
	}

	/**
	 * Elimina un usuario sancionado de la tabla sanciones
	 * @return void
	 */
	public function delete() {
		$db = new DB(SQL_DB);
		$db->run('DELETE FROM sanciones WHERE user_id=?;',array($this->user_id));
	}
}

?>
