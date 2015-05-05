<?php

	class taquillaController extends Controller {

	function panelAction(){
		if ($this->security(true)) {
			$this->render('panel');
		}
	}

	function reservarAction() {
		if ($this->security(true)) {
			$error ='';
			if(isset($_POST['formulario'])) {
				if(isset($_POST['campus']) && isset($_POST['edificio']) && isset($_POST['planta']) && isset($_POST['zona']) && isset($_POST['tipo']) ) {
					
					$busqueda = array('user_id' => $_SESSION['user']->uid);
					$taqDisponibles = Taquilla::findByAttributes($busqueda);
					//Si no hay taquillas con el id del usuario -> reserva
					if (empty($taqDisponibles)) {
						$edificio = explode(' ', $_POST['edificio']);
						$busqueda = array(
							'campus' => $_POST['campus'],
							'edificio' => $edificio[0],
							'planta' => $_POST['planta'],
							'zona' => "'".$_POST['zona']."'",
							'tipo' => "'".$_POST['tipo']."'",
							'user_id' => NULL,
							);
						if (!empty($_POST['num_taquilla'])){
							$busqueda['num_taquilla'] = $_POST['num_taquilla'];
						}
						$taqDisponibles = Taquilla::findByAttributes($busqueda);
						//Encuentra taquillas libres
						if (!empty($taqDisponibles)) {
			
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

					} else {
						//Si el usuario ya tiene alguna taquilla
						$error = '¡No puedes reservar mas de una taquilla!';
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

	function confirmarAction() {
		if ($this->security(true)) {
			$error ='';
			if(isset($_POST['confirmar'])) {
				if(isset($_POST['campus']) && isset($_POST['edificio']) && isset($_POST['planta']) && isset($_POST['zona']) && isset($_POST['tipo']) && isset($_POST['num_taquilla']) ) {
					$edificio = explode(' ', $_POST['edificio']);
					$busqueda = array(
						'num_taquilla' => $_POST['num_taquilla'],
						'campus' => $_POST['campus'],
						'edificio' => $edificio[0],
						'planta' => $_POST['planta'],
						'zona' => "'".$_POST['zona']."'",
						'tipo' => "'".$_POST['tipo']."'",
						'user_id' => NULL,
						);

					$taqDisponibles = Taquilla::findByAttributes($busqueda);
					//Encuentra taquillas libres
					$reserva = new Taquilla;
					$reserva = $taqDisponibles[0];
					$reserva->user_id = $_SESSION['user']->uid;
					$reserva->fecha = date("d-m-Y");
					$reserva->save();
					$this->render('confirmar',array('confirm'=>'¡Reserva confirmada!','reserva'=>$reserva));

				} else {
					$error = 'Ups, algo salió mal, reserva de nuevo una taquilla';
				}
			}
			$this->render('confirmar',array('error'=>$error));
		}
	}
	function getEdificiosAction(){
		header('Content-Type: application/json');

		$edf = Taquilla::attrBusqueda();
		echo json_encode($edf);
	}

}
?>