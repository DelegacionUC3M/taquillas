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
	 * @return array  $taquillas 	array con el resultado de la búsqueda.
	 */
	public static function findByAttributes($attributes = array()) {
		$db = new DB(SQL_DB);
		$search;
		if (empty($attributes)) {
			$db->run('SELECT * FROM taquillas');
		} else {
			$cont = 0;
			$search = 'SELECT * FROM taquillas WHERE';
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
	public function save() {
		$db = new DB(SQL_DB);
		$db->run('UPDATE taquillas SET estado=?, user_id=?, fecha=? WHERE id=?', array($this->estado,$this->user_id, $this->fecha, $this->id));
	}
	

	
	public function resetearTaquilla() {
		$db = new DB(SQL_DB);
		$year = //año con php
		$nombreTabla = 'taquillas'.$year;

		$db->run('CREATE TABLE '.$nombreTabla.' ( 
			id serial PRIMARY KEY,
	        num_taquilla integer,
	        campus_id smallint,
	        edificio_id smallint,
	        planta_id smallint,
	        zona_id char(2),
	        tipo_id varchar(20) NOT NULL,
	        estado_id smallint DEFAULT 1,
	        user_id integer,
	        fecha date,
	        UNIQUE (num_taquilla, campus_id, edificio_id))');

		$db->run('INSERT INTO '.$nombreTabla. ' SELECT * FROM taquillas');
		$db->run('UPDATE taquillas SET estado=1, user_id=NULL, fecha = NULL WHERE estado = 2 OR estado = 3');
	}

	public function bloquearApp() {
		//write BLOQUEO = 1;
	}

	public function desbloquearApp() {
		//write BLOQUEO = 0;
	}

	public function attrBusqueda(){
		$db = new DB(SQL_DB);
		//$list contiene los campus ordenados de menor a mayor: 0,1,2...
		$list = $db->run('SELECT DISTINCT campus FROM taquillas ORDER BY campus ASC');

		//$list contiene en la pos 0, 1, 2... un array con los distintos edificios que posee ese campus.
		foreach($list as $edf){
			$list[$edf] = $db->run('SELECT DISTINCT edificio FROM taquillas WHERE campus='.$edf);
		}
		
		//$list contendrá que cada edificio sus plantas correspondientes
		foreach($list as $edf){
			foreach($list[$edf] as $plt){
				$list[$edf][$plt] = $db->run('SELECT DISTINCT planta FROM taquillas WHERE campus='.$edf.' AND edificio='.$plt);
			}
		}

		//$list tiene que contener en cada planta sus letras.
		foreach($list as $edf){
			foreach($list[$edf] as $plt){
				foreach($list[$edf][$plt] as $zn){
					$list[$edf][$plt][$zn] = $db->run('SELECT DISTINCT zona FROM taquillas WHERE campus='.$edf.' AND edificio='.$plt.' AND zona='.$zn);
				}
			}
		}

	}
}

?>
