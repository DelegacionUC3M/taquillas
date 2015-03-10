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
		$db = new DB;
		$search;
		if (empty($attributes)){
			$db->run('SELECT * FROM sanciones');
		}
		else{
			$cont = 0;
			$search = 'SELECT * FROM sanciones WHERE';
			foreach ($attr as $key -> $value) {
				if($cont == count($attributes)-1){
					$search .= ' '.$key.'=:'.$key;
				}
				else{
					$search .= ' '.$key.'=:'.$key.' AND';
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
	 * Inserta un usuario sancionado en la tabla sancionados
	 * @return void
	 */
	public function insert() {
		$db = new DB;
		$db->run('INSERT INTO sanciones VALUES user_id=?, fecha_sancion=?, taquilla_id=?', array($this->user_id,$this->fecha_sancion, $this->taquilla_id));
	}

	/**
	 * Elimina un usuario sancioando de la tabla sancionos
	 * @return void
	 */
	public function delete() {
		$db = new DB;
		$db->run('DELETE FROM sanciones WHERE user_id=?',array($this->user_id));
	}
}

?>