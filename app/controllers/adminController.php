<?php

	class adminController extends Controller {
		
		function listarAction() {
			if (BLOQUEAR == 1){
				$this->render('appBloqueada');
			} else if ($this->security(true) && $_SESSION['user']->rol>=50) {
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
			if (BLOQUEAR == 1){
				$this->render('appBloqueada');
			} else if ($this->security(true) && $_SESSION['user']->rol>=50) {
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
					//Comprobación del dueño
					if (!empty($_POST['user_id'])) {
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
						if (($_POST['estado'] != 1) && ($_POST['estado'] != 2) && ($_POST['estado'] != 3) && ($_POST['estado'] != 4) && ($_POST['estado'] != 5)) {
							$cambio .= 'Estado no válido';
						}
						if ($_POST['estado'] == 1 && (!empty($_POST['user_id']) || !empty($_POST['fecha'])) ) {
							$cambio .= 'Si el estado es libre, no puede tener dueño';
						}
						if (empty($_POST['user_id']) && ($_POST['estado'] == 2 || $_POST['estado'] == 3)) {
							$cambio .= 'Es necesario que la taquilla tenga un dueño';
						}
					}
					//Comprobación de la fecha
					if (!empty($_POST['fecha'])) {
						if (($_POST['estado'] != 2) && ($_POST['estado'] != 3)) {
							$cambio .= 'Para que tenga fecha la taquilla debe estar ocupada/reservada';
						}
						if (empty($_POST['user_id'])) {
							$cambio .= 'Si la taquilla está ocupada/reservada debe tener la fecha de ésta';
						}
					}
					//ejecución correcta. Se comprueba que el mensaje de cambio no se ha modificado.
					if (strcmp($cambio,"") == 0) {
						$taquilla = Taquilla::findByAttributes(array('id' => $id));
						$datos = $taquilla[0];
						$usr = $_POST['user_id'];
						$fecha = $_POST['fecha'];
						if (empty($usr)){
							$usr = NULL;
						}
						if (empty($fecha)){
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
			if (BLOQUEAR == 1){
				$this->render('appBloqueada');
			} else if ($this->security(true) && $_SESSION['user']->rol>=50) {
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
			if (BLOQUEAR == 1){
				$this->render('appBloqueada');
			} else if ($this->security(true) && $_SESSION['user']->rol>=50) {
				$error = "";
				if (isset($_POST['asignar'])){
					if(isset($_POST['campus']) && isset($_POST['edificio']) && isset($_POST['planta']) && isset($_POST['zona']) && isset($_POST['tipo']) && isset($_POST['user_id'])) {
						$busqueda = array('user_id' => $_POST['user_id']);
						$taqDisponibles = Taquilla::findByAttributes($busqueda);
						//Puede que ya exista una reserva por lo tanto puede haber 1 o 0.
						if (count($taqDisponibles) < 2) {
							//No hay reserva
							if(count($taqDisponibles) == 0) {
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
									//Si se ha buscado por id se le asigna
									if (!empty($_POST['num_taquilla'])) {
										$reserva = new Taquilla;
										$reserva = $taqDisponibles[0];
										$reserva->user_id = $_POST['user_id'];
									} else {
										//Si no se busca por id es aleatorio
										$aleatorio = rand (0,count($taqDisponibles)-1);
										$reserva = new Taquilla;
										$reserva = $taqDisponibles[$aleatorio];
										$reserva->user_id = $_POST['user_id'];
									}
									$this->render('confirmarAsig',array('reserva'=>$reserva));
								} else {
									//No hay taquillas libres
									$error = 'No hay taquillas libres';
									$this->render('asigCobra',array('error' => $error));
								}
							}
							//Caso de que ya exista 1 reserva
							else if ($taqDisponibles[0]->estado == 2) {
								$reserva = $taqDisponibles[0];
								$this->render('confirmarAsig',array('reserva'=>$reserva));
							}
							else{
								$error = 'El usuario ya ocupa una taquilla';
								$this->render('asigCobra',array('error' => $error));
							}

						}
					} else {
						//Algún campo vacío
						$error = 'Todos los campos son obligatorios';
						$this->render('asigCobra',array('error' => $error));
					}
				}
				else{
					$this->render('asigCobra',array('error' => $error));
				}
			}
		}

		function cobrarAction() {
			if (BLOQUEAR == 1){
				$this->render('appBloqueada');
			} else if ($this->security(true) && $_SESSION['user']->rol>=50) {
				$error = '';
				$confirm = '';
				$taq;
				if (isset($_POST['cobrar'])) {
					if (isset($_GET['id'])) {
						$busq = array(
							'id' => $_GET['id']
							);
						$taq = Taquilla::findByAttributes($busq)[0];
						$taq->estado = 3;
						$taq->user_id = $_POST['user_id'];
						if (empty($taq->fecha)){
							$taq->fecha = date("d-m-Y");
						}
						$taq->save();
						$confirm = 'Taquilla asignada correctamente';
					}
					else{
						$error = 'Ups, algo salió mal';
					}
				}
				$this->render('confirmarAsig', array('error' => $error, 'confirm' => $confirm, 'reserva'=>$taq));
			}
		}

		function firmaAction() {
			if (BLOQUEAR == 1){
				$this->render('appBloqueada');
			} else if ($this->security(true) && $_SESSION['user']->rol>=50) {
				$this->render('firma');
			}
		}

		function statsAction() {
			if (BLOQUEAR == 1){
				$this->render('appBloqueada');
			} else if ($this->security(true) && $_SESSION['user']->rol>=50) {
				$this->render('estadisticas');
			}
		}
	}
?>

