<?php

	class managerController extends Controller {

		function gestionUsuariosAction() {
			if (BLOQUEAR == 1){
				$this->render('appBloqueada');
			} else if ($this->security(true) && $_SESSION['user']->rol>=100) {
				$this->render('gestionUsuarios');
			}
		}

		function listarAction() {
			if (BLOQUEAR == 1){
				$this->render('appBloqueada');
			} else if ($this->security(true) && $_SESSION['user']->rol>=100) {
				$lista = DBDelegados::findAll();
				$this->render('listarUsuario',array('lista'=>$lista));
			}
		}

		function anadirUsuarioAction() {
			if (BLOQUEAR == 1){
				$this->render('appBloqueada');
			} else if ($this->security(true) && $_SESSION['user']->rol>=100) {
				$error = "";
				if (isset($_POST['anadirUsuario'])) {
					if(is_null(DBDelegados::findByNIA($_POST['nia']))) {
						$error = 'Usuario no encontrado';
					} else if (!is_null(DBDelegados::findByNIAPermisos($_POST['nia']))) {
						$error = 'Usuario ya existente en la tabla permisos';
					} else {
						DBDelegados::anadirUsuario($_POST['nia'], $_POST['rol']);
						$error = 'Usuario añadido correctamente';
					}
				}
				$this->render('guardarUsuario', array('error' => $error));
			}
		}

		function modificarUsuarioAction() {
			if (BLOQUEAR == 1){
				$this->render('appBloqueada');
			} else if ($this->security(true) && $_SESSION['user']->rol>=100) {
				$mensaje = "";

				if(isset($_POST['modificarUsuario'])) {
					DBDelegados::save($_GET['id'], $_POST['rol']);
					$mensaje = 'Usuario modificado correctamente';
				} else if (isset($_POST['eliminarUsuario'])) {
					DBDelegados::remove($_GET['id']);
					$mensaje = 'Usuario eliminado correctamente';
				}
				$user = DBDelegados::findById($_GET['id']);
				$this->render('modificarUsuario', array('mensaje'=>$mensaje, 'usuario'=>$user));

			}
		}

		function bloquearAction() {
			if ($this->security(true) && $_SESSION['user']->rol>=100) {
				if (isset($_POST['confirmar_bloqueo'])) {
					Taquilla::bloquearApp();
				}
				else if (isset($_POST['confirmar_desbloqueo'])) {
					Taquilla::desbloquearApp();
				}
				$this->render('bloquear');
			}
		}

		function resetearAction(){
			if (BLOQUEAR == 1){
				$this->render('appBloqueada');
			} else if ($this->security(true) && $_SESSION['user']->rol>=100) {
				$mensaje = "";
				if (isset($_POST['confirmar_reseteo'])) {
					Taquilla::resetearTaquilla();
					$mensaje = "RESETEO COMPLETADO CORRECTAMENTE";
				}
				$this->render('resetear', array('mensaje'=>$mensaje));
			}
		}
	}
?>