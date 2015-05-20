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
	public static $nombreCampus = array(
		1 => 'CCSSJJ',
		2 => 'EPS'
		);
	public static $nombreEdificios = array(
		1 => array(
			4 => '4 - Gómez de la Serna',
			5 => '5 - Giner de los Ríos',
			6 => '6 - Normante',
			7 => '7 - Foronda',
			9 => '9 - Adofo Posada',
			10 => '10 - Campomanes',
			12 => '12 - María Moliner',
			15 => '15 - López Aranguren',
		),
		2 => array(
			1 => '1 - Agustin de Betancourt',
			2 => '2 - Sabatini',
			4 => '4 - Torres Quevedo',
			7 => '7 - Juan Benet',
			),
		);
	
	public function __construct($id=NULL, $num_taquilla=NULL, $campus=NULL, $edificio=NULL, $planta=NULL, $zona=NULL, $tipo=NULL, $estado=NULL, $user_id=NULL, $fecha=NULL){
		$this->id = $id;
		$this->num_taquilla = $num_taquilla;
		$this->campus = $campus;
		$this->edificio = $edificio;
		$this->planta = $planta;
		$this->zona = $zona;
		$this->tipo = $tipo;
		$this->estado = $estado;
		$this->user_id = $user_id;
		$this->fecha = $fecha;
	}

	/**
	 * Encuentra usuarios sancionados segun los atributos pasados por array. En caso de pasar un array vacío funciona como un findAll.
	 * @param  array 	$attributes 	array que incluye los parámetros de búsquedas. Las key del array deben ser: 'id' o 'num_taquilla' o 'campus' o 'edificio' o 'planta' o 'zona' o 'tipo' o 'estado' o 'user_id' o 'fecha'.
	 * @return array 	$taquillas		array con el resultado de la búsqueda.
	 */
	public static function findByAttributes($attributes = array()) {
		$db = new DB(SQL_DB);
		$search;
		if (empty($attributes)) {
			$db->run('SELECT * FROM taquillas ORDER BY campus, edificio');
		} else {
			$cont = 0;
			$search = 'SELECT * FROM taquillas WHERE';
			foreach ($attributes as $key => $value) {
				if($cont == count($attributes)-1) {
					if (is_null($value)) {
						$search .= ' '.$key.' IS NULL';
					} else {
						$search .= ' '.$key.'='.$value;
					}
				} else {
					if (is_null($value)) { 
						$search .= ' '.$key.' IS NULL AND';
					} else {
						$search .= ' '.$key.'='.$value.' AND';
					}
					
				}
				$cont++;
			}
			$search .= ' ORDER BY campus, edificio';
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
		$year = date ('Y');
		$nombreTabla = 'taquillas'.$year;

		$db->run('CREATE TABLE '.$nombreTabla.' ( 
			id serial PRIMARY KEY,
			num_taquilla integer,
			campus smallint,
			edificio smallint NOT NULL,
			planta smallint NOT NULL,
			zona char(2) NOT NULL,
			tipo varchar(20) NOT NULL,
			estado smallint DEFAULT 1,
			user_id integer,
			fecha date,
			UNIQUE (num_taquilla, campus, edificio))');

		$db->run('INSERT INTO '.$nombreTabla.' SELECT * FROM taquillas');
		$db->run('UPDATE taquillas SET estado=1, user_id=NULL, fecha = NULL WHERE estado = 2 OR estado = 3');
	}

	public function bloquearApp() {
		//write BLOQUEO = 1;
		//Se coloca el puntero al final del archivo, se borra la linea y se reescribe modificando el valor de BLOQUEO
		$conf = fopen('config.php', 'r+');
		$contenido = fread($conf,filesize('config.php'));
		fclose($conf);
		 
		// Separar linea por linea
		$contenido = explode(';',$contenido);
		// Modificar linea de BLOQUEAR, que es la última
		$contenido[count($contenido)-2] = "\ndefine('BLOQUEAR',1)";
		// Se deja como estaba
		$contenido = implode(';',$contenido);
		 
		// Guardar Archivo
		$conf = fopen('config.php','w');
		fwrite($conf,$contenido);
		fclose($conf);
	}

	public function desbloquearApp() {
		//write BLOQUEO = 0;
		//Se coloca el puntero al final del archivo, se borra la linea y se reescribe modificando el valor de BLOQUEO
		$conf = fopen('config.php', 'r+');
		$contenido = fread($conf,filesize('config.php'));
		fclose($conf);
		 
		// Separar linea por linea
		$contenido = explode(';',$contenido);
		// Modificar linea de BLOQUEAR, que es la última
		$contenido[count($contenido)-2] = "\ndefine('BLOQUEAR',0)";
		// Se deja como estaba
		$contenido = implode(';',$contenido);
		 
		// Guardar Archivo
		$conf = fopen('config.php','w');
		fwrite($conf,$contenido);
		fclose($conf);
	}

	public function attrBusqueda() {
		$db = new DB(SQL_DB);

		$db->run('SELECT DISTINCT campus,edificio,planta,zona FROM taquillas');
		$aux = $db->data();

		$list = array();
		foreach($aux as $elem){
			//Posición $list[i] con los campus
			if (!isset($list[$elem['campus']])){
				$list[$elem['campus']] = array();
			}
			//Posición $list[campus][i] con los edificios del campus
			if (!isset($list[$elem['campus']][$elem['edificio']])){
				$list[$elem['campus']][$elem['edificio']] = array();
			}
			//Posición $List[campus][edificio][i] con las plantas de los edificios
			if (!isset($list[$elem['campus']][$elem['edificio']][$elem['planta']])){
				$list[$elem['campus']][$elem['edificio']][$elem['planta']] = array();
			}
			//Posición $list[campus][edificio][planta][i] con las zonas de la planta del edificio
			if (!isset($list[$elem['campus']][$elem['edificio']][$elem['planta']][$elem['zona']])){
				$zona = trim($elem['zona'],' ');
				$list[$elem['campus']][$elem['edificio']][$elem['planta']][$zona] = $zona;
			}
		}

		foreach($list as $key => $camp) {
			foreach($camp as $key2 => $edf) {
				$list[$key][Taquilla::$nombreEdificios[$key][$key2]] = $list[$key][$key2];
				unset($list[$key][$key2]);
			}
		}
		
		return $list;

	}
}

?>
