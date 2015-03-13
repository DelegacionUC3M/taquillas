<?php

class Taquilla {

	public $id;
	public $num_taquilla;
	public $campus;
	public $edificio;
	public $planta;
	public $zona;
	public $tipo;
	public $estado;
	public $user_id;
	public $fecha;

	/**
	 * Encuentra usuarios sancionados segun los atributos pasados por array. En caso de pasar un array vacío funciona como un findAll.
	 * @param  array  $attributes 	array que incluye los parámetros de búsquedas. Las key del array deben ser: 'id' o 'num_taquilla' o 'campus' o 'edificio' o 'planta' o 'zona' o 'tipo' o 'estado' o 'user_id' o 'fecha'.
	 * @return arrayt $taquillas 	array con el resultado de la búsqueda.
	 */
	public static function findByAttributes($attributes = array()) {
		$db = new DB;
		$search;
		if (empty($attributes)){
			$db->run('SELECT * FROM taquillas;');
		}
		else{
			$cont = 0;
			$search = 'SELECT * FROM taquillas WHERE';
			foreach ($attr as $key -> $value) {
				if($cont == count($attributes)-1){
					$search .= ' '.$key.'=:'.$key.';';
				}
				else{
					$search .= ' '.$key.'=:'.$key.' AND';
				}
				$cont++;
			}
			$db->run($search);
		}
		$taquillas = array();
		$data = $db->data();
		foreach ($data as $row) {
			$taquilla = new Taquilla;
			foreach ($row as $key => $value) {
				$taquilla->$key = $value;
			}
			$taquillas[] = $taquilla;
		}
		return $taquillas;
	}

	/**
	 * Actualiza los valores de la taquilla.
	 * @return void
	 */
	public function save (){
		$db = new DB;
		$db->run('UPDATE taquillas SET estado=?, user_id=?, fecha=? WHERE id=?;', array($this->estado,$this->user_id, $this->fecha, $this->id));
	}
}

?>
