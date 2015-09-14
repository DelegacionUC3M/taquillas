<?php

	class inicioController extends Controller {

		/**
		 *Comprueba la identidad del usuario y si es correcta realiza una llamada
		 * a la función reserva.
		 * En caso de no validarse se redirige al inicio.
		 *
		 * @return void
		 */
		function indexAction(){
			if ($this->security(false)) {
				header('Location: /taquillas/inicio/condiciones');
			} else {
				header('Location: /taquillas/inicio/login');
				$this->render('inicio', array('section' => 'inicio'));
			}
		}

		/**
		 * Comprueba la existencia de una sesión de usuario, de no existir
		 * redirecciona al login.
		 *
		 * @return void
		 */
		function loginAction() {
			if ($this->security(false)) {
				header('Location: /taquillas/inicio/condiciones');
			}
			else {
				if (isset($_POST['nia']) && isset($_POST['password'])) {
					try {
						$ldap = new LDAP;
						$ldap->run('uid=' . $_POST['nia']);
						$user = $ldap->data()[0];
						$ldapUser = $ldap->login($user['dn'],$_POST['password']);

						if($ldapUser) {
							$user = new User($user['uid'][0], $user['cn'][0],$user['mail'][0], $user['dn']);
							$_SESSION['user'] = $user;

							if (isset($_GET['url'])) {
								header('Location: /taquillas/inicio'. $_GET['url']);
							}
							else{
								header('Location: /taquillas/inicio/condiciones');
							}
						}
						else {
							$error = 'Usuario o contraseña incorrectos';
							$this->render('login', array('error'=>$error,'section'=>'login'));
						}
					}
					catch (Exception $e) {
						$error = 'Ha ocurrido un problema con la autenticación. Intentalo de nuevo';
						$this->render('login', array('error'=>$error,'section'=>'login'));
					}
				}
				else {
					$this->render('login',array('section'=>'login'));
				}
			}
		}


		/**
		 * Cierra la sesión del usuario
		 *
		 * @return void
		 */
		function logoutAction() {
			session_destroy();
			session_regenerate_id(true);
			header('Location: /taquillas/inicio');
		}

		/**
		 * Valida la sesión del usuario y carga la vista de las condiciones
		 *
		 * @return void
		 */
		function condicionesAction() {
			if (BLOQUEAR == 1){
				$this->render('appBloqueada');
			} else if ($this->security(true)) {
				$this->render('condiciones');
			}
		}

	}
?>
