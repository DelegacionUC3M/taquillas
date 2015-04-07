<?php

	class taquillaController extends Controller {

	function panelAction(){
		if ($this->security(true)) {
			$this->render('panel');
		}
	}

	function reservarAction() {
		if ($this->security(true)) {
			$error;
			if(isset($_POST['formulario'])) {
				if(!empty($_POST['campus']) && !empty($_POST['edificio']) && !empty($_POST['planta']) && !empty($_POST['zona']) && !empty($_POST['tipo']) && !empty($_POST['user_id']) ) {
					
					$busqueda = array('user_id' => $_POST['user_id']);
					$taqDisponibles = array();
					$taqDisponibles = Taquilla::findByAttributes($busqueda);
					//Si no hay taquillas con el id del usuario -> reserva
					if (is_null($taqDisponibles[0])) {
						$busqueda = array(
							'campus' => $_POST['campus'],
							'edificio' => $_POST['edificio'],
							'planta' => $_POST['planta'],
							'zona' => $_POST['zona'],
							'tipo' => $_POST['tipo'],
							'user_id' => NULL,
							);
						if (!empty($_POST['id_taquilla'])){
							$busqueda['id'] = $_POST['id_taquilla'];
							}
						
						$taqDisponibles = Taquilla::findByAttributes($busqueda);
						//Encuentra taquillas libres
						if (!empty($taqDisponibles)) {
							//Si se ha buscado por id se le asigna
							if (!empty($_POST['id_taquilla'])) {
								$reserva = new Taquilla;
								$reserva = $taqDisponibles[0];
								$reserva->user_id = $_SESSION['user']->nia;
								$reserva->save();
							} else {
								//Si no se busca por id es aleatorio
								$aleatorio = rand (0,count($taqDisponibles)-1);
								$reserva = new Taquilla;
								$reserva = $taqDisponibles[$aleatorio];
								$reserva->user_id = $_SESSION['user']->nia;
								$reserva->save();
							}
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
}
?>