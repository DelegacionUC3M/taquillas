<?php

	class taquillaController extends Controller {

	/**
	 * Renderiza el panel
	 * 
	 * @return void
	 */
	function panelAction(){
		if ($this->security(false)) {
			$this->render('panel');
		}

		$this->render('inicio');
	}

	/**
	 * Permite reservar una taquilla.
	 * 
	 * @return void
	 */
	function reservarAction() {
		if (BLOQUEAR == 1){
			$this->render('appBloqueada');
		} else if ($this->security(true)) {
			$error ='';
			if(isset($_POST['formulario'])) {
				if(isset($_POST['campus']) && isset($_POST['edificio']) && isset($_POST['planta']) && isset($_POST['zona']) && isset($_POST['tipo']) ) {
					
					$busqueda = array('user_id' => $_SESSION['user']->uid);
					$taqDisponibles = Taquilla::findByAttributes($busqueda);
					$edificio = explode(' ', $_POST['edificio']);
					$busqueda = array(
						'campus' => $_POST['campus'],
						'edificio' => $edificio[0],
						'planta' => $_POST['planta'],
						'zona' => "'".$_POST['zona']."'",
						'tipo' => "'".$_POST['tipo']."'",
						'estado' => 1,
						'user_id' => NULL,
						);
					if (!empty($_POST['num_taquilla'])){
						$busqueda['num_taquilla'] = $_POST['num_taquilla'];
					}
					$taqDisponibles = Taquilla::findByAttributes($busqueda);
					//Encuentra taquillas libres
					if (!empty($taqDisponibles)) {
						$reserva;
						//Si se ha buscado por id se le asigna
						if (!empty($_POST['num_taquilla'])) {
							$reserva = new Taquilla;
							$reserva = $taqDisponibles[0];
							$reserva->user_id = $_SESSION['user']->nia;
						} else {
							//Si no se busca por id es aleatorio
							$aleatorio = rand (0,count($taqDisponibles)-1);
							$reserva = new Taquilla;
							$reserva = $taqDisponibles[$aleatorio];
							$reserva->user_id = $_SESSION['user']->nia;
						}
						$this->render('confirmar',array('reserva'=>$reserva));

					} else {
						//No hay taquillas libres
						$error = 'No hay taquillas libres';
					}
				}
				else{
					//Algún campo vacío
					$error = 'Todos los campos son obligatorios';
				}
			}
			$this->render('reserva',array('error'=>$error));
		}
	}

	/**
	 * Confirma la reserva de la taquilla y actualiza los datos en la BD.
	 * 
	 * @return void
	 */
	function confirmarAction() {
		if (BLOQUEAR == 1){
			$this->render('appBloqueada');
		} else if ($this->security(true)) {
			$error ='';
			if(isset($_POST['confirmar'])) {
				if (isset($_GET['id'])){
					$busqueda = array(
						'id' => $_GET['id']
						);
					$taqDisponibles = Taquilla::findByAttributes($busqueda);
					//Encuentra taquillas libres
					$reserva = new Taquilla;
					$reserva = $taqDisponibles[0];
					$reserva->user_id = $_SESSION['user']->uid;
					$reserva->fecha = date("d-m-Y");
					$reserva->estado = 2;
					$reserva->save();
					if ($_SESSION['user']->rol < 50){
						$this->render('confirmar',array('confirm'=>'¡Reserva confirmada!','reserva'=>$reserva));
					}
					else if ($_SESSION['user']->rol > 50){
						$this->render('confirmarAsig',array('confirm'=>'¡Reserva confirmada!','reserva'=>$reserva));
					}

				} else {
					$error = 'Ups, algo salió mal, reserva de nuevo una taquilla';
				}
			}
			$this->render('confirmar',array('error'=>$error));
		}
	}

	/**
	 * Devuelve un JSON con la lista de edificios
	 * 
	 * @return void
	 */
	function getEdificiosAction(){
		header('Content-Type: application/json');

		$edf = Taquilla::attrBusqueda();
		echo json_encode($edf);
	}


	function getStatsTotalEPSAction(){
		header('Content-Type: application/json');

		$taq = Taquilla::stats(2);
		//Generar array de salida
		$taq = Taquilla::generarSalida($taq);
		echo json_encode($taq);
	}

	function getStatsEPS1Action(){
		header('Content-Type: application/json');

		$taq = Taquilla::stats(2,1);
		//Generar array de salida
		$taq = Taquilla::generarSalida($taq);
		echo json_encode($taq);
	}

	function getStatsEPS2Action(){
		header('Content-Type: application/json');

		$taq = Taquilla::stats(2,2);
		//Generar array de salida
		$taq = Taquilla::generarSalida($taq);
		echo json_encode($taq);
	}

	function getStatsEPS4Action(){
		header('Content-Type: application/json');

		$taq = Taquilla::stats(2,4);
		//Generar array de salida
		$taq = Taquilla::generarSalida($taq);
		echo json_encode($taq);
	}

	function getStatsEPS7Action(){
		header('Content-Type: application/json');

		$taq = Taquilla::stats(2,7);
		//Generar array de salida
		$taq = Taquilla::generarSalida($taq);
		echo json_encode($taq);
	}

	function getStatsTotalCSJAction(){
		header('Content-Type: application/json');

		$taq = Taquilla::stats(1);
		//Generar array de salida
		$taq = Taquilla::generarSalida($taq);
		echo json_encode($taq);
	}

	function getStatsCSJ4Action(){
		header('Content-Type: application/json');

		$taq = Taquilla::stats(1,4);
		//Generar array de salida
		$taq = Taquilla::generarSalida($taq);
		echo json_encode($taq);
	}

	function getStatsCSJ5Action(){
		header('Content-Type: application/json');

		$taq = Taquilla::stats(1,5);
		//Generar array de salida
		$taq = Taquilla::generarSalida($taq);
		echo json_encode($taq);
	}

	function getStatsCSJ6Action(){
		header('Content-Type: application/json');

		$taq = Taquilla::stats(1,6);
		//Generar array de salida
		$taq = Taquilla::generarSalida($taq);
		echo json_encode($taq);
	}

	function getStatsCSJ7Action(){
		header('Content-Type: application/json');

		$taq = Taquilla::stats(1,7);
		//Generar array de salida
		$taq = Taquilla::generarSalida($taq);
		echo json_encode($taq);
	}

	function getStatsCSJ9Action(){
		header('Content-Type: application/json');

		$taq = Taquilla::stats(1,9);
		//Generar array de salida
		$taq = Taquilla::generarSalida($taq);
		echo json_encode($taq);
	}

	function getStatsCSJ10Action(){
		header('Content-Type: application/json');

		$taq = Taquilla::stats(1,10);
		//Generar array de salida
		$taq = Taquilla::generarSalida($taq);
		echo json_encode($taq);
	}
	function getStatsCSJ12Action(){
		header('Content-Type: application/json');

		$taq = Taquilla::stats(1,12);
		//Generar array de salida
		$taq = Taquilla::generarSalida($taq);
		echo json_encode($taq);
	}

	function getStatsCSJ15Action(){
		header('Content-Type: application/json');

		$taq = Taquilla::stats(1,15);
		//Generar array de salida
		$taq = Taquilla::generarSalida($taq);
		echo json_encode($taq);
	}



}
?>