<?php

	class adminController extends Controller {
		
		function listarAction() {
			if ($this->security(true) && $_SESSION['user']->rol>=50) {
				if (isset($_POST['busqueda'])) {
					$search = array();
					if (!empty($_POST['campus'])) {
						$search['campus'] = $_POST['campus'];
					} if (!empty($_POST['edificio'])) {
						$edificio = explode(' ', $_POST['edificio']);
						$search['edificio'] = $edificio[0];
					} if (!empty($_POST['planta'])) {
						$search['planta'] = $_POST['planta'];
					} if (!empty($_POST['zona'])){
						$search['zona'] = "'".$_POST['zona']."'";
					} if (!empty($_POST['tipo'])){
						$search['tipo'] = "'".$_POST['tipo']."'";
					}
					//Taquillas resultantes de la busqueda
					$listado = Taquilla::findByAttributes($search);
					$this->render('listado',array('lista'=>$listado));
				}
				else{
					$this->render('listado');
				}
			}
		}

		function gestionAction() {
			if ($this->security(true) && $_SESSION['user']->rol>=50) {
				$id;
				$datos;
				$cambio = "";
				if (isset($_GET['id'])) {
					$id = $_GET['id'];
					$search = array('id'=>$_GET['id']);
					$taquilla = Taquilla::findByAttributes($search);
					$datos = $taquilla[0];
				}
				if (isset($_POST['gestion'])) {
					print_r("hola caracola ".$id);
					//Comprobación del dueño
					if (!empty($_POST['user_id'])) {
						print_r("USER ID ".$_POST['user_id']);
						if(is_null(User::findByNIA($_POST['user_id']))) {
							$cambio = 'Usuario no encontrado';
						}
						if(empty($_POST['fecha'])) {
							$cambio .= 'Necesaria una fecha si tiene dueño la taquilla';
						}
						if (!is_null(Taquilla::findByAttributes(array('id' => $_POST['user_id'])))) {
							$cambio .= 'Un usuario no puede tener más de 1 taquilla';
						}
					}

					//Comprobación del estado
					if (!empty($_POST['estado'])) {
						print_r("ESTADO ".$_POST['estado']);
						if (($_POST['estado'] != 1) && ($_POST['estado'] != 2) && ($_POST['estado'] != 3) && ($_POST['estado'] != 4) && ($_POST['estado'] != 5)) {
							$cambio .= 'Estado no válido';
						}
						if ($_POST['estado'] == 1 && (!empty($_POST['user_id']) || !empty($_POST['fecha'])) ) {
							print_r("if usr libre");
							$cambio .= 'Si el estado es libre, no puede tener dueño';
						}
						if (empty($_POST['user_id']) && ($_POST['estado'] == 2 || $_POST['estado'] == 3)) {
							print_r("dueño obligatorio");
							$cambio .= 'Es necesario que la taquilla tenga un dueño';
						}
					}
					//Comprobación de la fecha
					if (!empty($_POST['fecha'])) {
						print_r("FECHA ".$_POST['fecha']);
						if (($_POST['estado'] != 2) && ($_POST['estado'] != 3)) {
							$cambio .= 'Para que tenga fecha la taquilla debe estar ocupada/reservada';
						}
						if (empty($_POST['user_id'])) {
							$cambio .= 'Si la taquilla está ocupada/reservada debe tener la fecha de ésta';
						}
					}
					//ejecución correcta. Se comprueba que el mensaje de cambio no se ha modificado.
					if (strcmp($cambio,"") == 0) {
						print_r("hola check GUAI ");
						$taquilla = Taquilla::findByAttributes(array('id' => $id));
						$datos = $taquilla[0];
						$usr = $_POST['user_id'];
						$fecha = $_POST['fecha'];
						if (empty($usr)){
							print_r("ENTRA NULL USR");
							$usr = NULL;
						}
						if (empty($fecha)){
							print_r("ENTRA NULL FECHA");
							$fecha = NULL;
						}
						$datos->user_id = $usr;
						$datos->estado = $_POST['estado'];
						$datos->fecha = $fecha;
						$datos->save();
						$cambio .= 'Cambios realizados correctamente';
					}					
				}
				$this->render('modificarTaq',array('datos'=>$datos, 'cambio' => $cambio));
			}
		}

		function gestionTaqAction() {
			if ($this->security(true) && $_SESSION['user']->rol>=50) {
				if (isset($_POST['busqueda'])) {
					$search = array();
					
					if (!empty($_POST['campus'])) {
						$search['campus'] = $_POST['campus'];
					} if (!empty($_POST['edificio'])) {
						$edificio = explode(' ', $_POST['edificio']);
						$search['edificio'] = $edificio[0];
					} if (!empty($_POST['planta'])) {
						$search['planta'] = $_POST['planta'];
					} if (!empty($_POST['zona'])){
						$search['zona'] = "'".$_POST['zona']."'";
					} if (!empty($_POST['tipo'])){
						$search['tipo'] = "'".$_POST['tipo']."'";
					} if (!empty($_POST['id'])){
						$search['id'] = $_POST['id'];
					} if (!empty($_POST['user_id'])){
						$search['user_id'] = $_POST['user_id'];
					} if (!empty($_POST['num_taquilla'])){
						$search['num_taquilla'] = $_POST['num_taquilla'];
					} if (!empty($_POST['fecha'])){
						$search['fecha'] = "'".$_POST['fecha']."'";
					} if (!empty($_POST['estado'])){
						$search['estado'] = $_POST['estado'];
					}
					//Taquillas resultantes de la busqueda
					$listado = Taquilla::findByAttributes($search);
					$error = "";
					if (empty($listado)){
						$error = "Esta taquilla no existe.";
					}
					$this->render('gestionTaquillas', array('lista' => $listado, 'error' => $error));
				}
				else{
					$this->render('gestionTaquillas');
				}
				
			}
		}

		function asignarAction() {
			if ($this->security(true) && $_SESSION['user']->rol>=50) {
				$this->render('asignar');
			}
		}

		function cobrarAction() {
			if ($this->security(true) && $_SESSION['user']->rol>=50) {
				$this->render('cobrar');
			}
		}

		function firmaAction() {
			if ($this->security(true) && $_SESSION['user']->rol>=50) {
				$this->render('firma');
			}
		}

		function statsAction() {
			if ($this->security(true) && $_SESSION['user']->rol>=50) {
				$this->render('estadisticas');
			}
		}
	}
?>

