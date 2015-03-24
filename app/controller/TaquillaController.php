<?php

	class TaquillaController extends Controller {

		/**
		 *Comprueba la identidad del usuario y si es correcta realiza una llamada
		 * a la función reserva.
		 * En caso de no validarse se redirige al inicio.
		 * 
		 * @return void
		 */
		function index (){
			if ($this->security(false)) {
				$this->condiciones();
			}
			else {
				$this->render('inicio');
			}
		}

		/**
		 * Comprueba la existencia de una sesión de usuario, de no existir
		 * redirecciona al login.
		 * 
		 * @return void
		 */
		function login() {
			if ($this->security(false)) {
				header('Location: /taquillas/inicio');
			}
			else {
				if (isset($_POST['nia']) && isset($_POST['password'])) {
					$ldapUser = LDAP_Gateway::login($_POST['nia'],$_POST['password']);
					try {
						if($ldapUser) {
							$user = new User($ldapUser->getUserId(), $ldapUser->getUserNameFormatted(), $ldapUser->getDn());
							$_SESSION['user'] = $user;

							if (isset($_GET['url'])) {
								header('Location: ' . $_GET['url']);
							}
							else{
								header('Location: /taquillas/inicio');
							}
						}
						else {
							$error = 'Usuario o contraseña incorrectos';
							$this->render('login', array('error'=>$error));
						}
					}
					catch (Exception $e) {
						$error = 'Ha ocurrido un problema con la autenticación. Intentalo de nuevo';
						$this->render('login', array('error'=>$error));
					}
				}
				else {
					$this->render('login');
				}
			}
		}


		/**
		 * Cierra la sesión del usuario
		 * 
		 * @return void
		 */
		function logout () {
			session_destroy();
			session_regenerate_id(true);
			header('Location: /taquillas/inicio');
		}

		/**
		 * Valida la sesión del usuario y carga la vista de las condiciones
		 *
		 * @return void
		 */
		function condiciones() {
			if (!$this->security(false)) {
				header('Location: /taquillas/inicio');
				
			}
			else {
				$this->render('condiciones');
			}
		}

		function reservar() {
			if (!$this->security(false)) {
				header('Location: /taquillas/inicio');
			} else {
				if(isset([$_POST['formulario']])) {
					if(!empty([$_POST['campus']]) && !empty([$_POST['edificio']]) && !empty([$_POST['planta']]) && !empty([$_POST['zona']]) && !empty([$_POST['tipo']]) && !empty([$_POST['user_id']]) ) {
						
						$busqueda = array('user_id' => $_POST['user_id']);
						$taqDisponibles = new array();
						$taqDisponibles = Taquilla::findByAttributes($busqueda);
						//Si no hay taquillas con el id del usuario -> reserva
						if (is_null($taqDisponibles[0])) {
							$busqueda = array(
								'campus' => $_POST['campus'];
								'edificio' => $_POST['edificio'];
								'planta' => $_POST['planta'];
								'zona' => $_POST['zona'];
								'tipo' => $_POST['tipo'];
								if (!is_null($_POST['id_taquilla']){
									'id' => $_POST['id_taquilla'];
									}
								'user_id' => NULL;
								);
							
							$taqDisponibles = Taquilla::findByAttributes($busqueda);
							//Encuentra taquillas libres
							if (!empty($taqDisponibles)) {
								//Si se ha buscado por id se le asigna
								if (!is_null($_POST['id_taquilla']) {
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
								$this->render('reservar',array('error'=>'No hay taquillas libres'));
							}

						} else {
							//Si el usuario ya tiene alguna taquilla
							$this->render('reservar',array('error'=>'¡No puedes reservar mas de una taquilla!'));
						}
					}
					else{
						//Algún campo vacío
						$this->render('reservar',array('error'=>'Todos los campos son obligatorios'));
					}
				}
			}
		}


	}
?>