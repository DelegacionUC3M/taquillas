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
			if ($this->security(false)){
				header('Location: /taquillas/inicio');
			}
			else {
				if (isset($_POST['nia']) && isset($_POST['password'])){
					$ldapUser = LDAP_Gateway::login($_POST['nia'],$_POST['password']);
					try {
						if($ldapUser) {
							$user = new User($ldapUser->getUserId(), $ldapUser->getUserNameFormatted(), $ldapUser->getDn());
							$_SESSION['user'] = $user;

							if (isset(S_GET['url'])) {
								header('Location: ' . $_GET['url']);
							}
							else{
								header('Location: /taquillas/inicio/reserva');
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
		 * Valida la sesión del usuario y carga el reserva con las distintas opciones
		 *
		 * @return void
		 */
		function condiciones() {
			if ($this->security(false)){
				header('Location: /taquillas/inicio');
			}
			else {

			}
		}

		function reservar() {
			
		}
	}

?>