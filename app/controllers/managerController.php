<?php

	class managerController extends Controller {

		/**
		 *Comprueba la identidad del usuario y si es correcta realiza una llamada
		 * a la función panel.
		 * En caso de no validarse se redirige al inicio.
		 * 
		 * @return void
		 */
		function indexAction(){
			if ($this->security(false) && $_SESSION['user']->rol>=100) {
				$this->panel();
			}
			else {
				$this->render('inicio');
			}
		}

		function panelAction(){
			if (!$this->security(false) && $_SESSION['user']->rol>=100) {
				header('Location: /taquillas/inicio');
				
			}
			else {
				$this->render('panel');
			}
		}

		function gestionUsuariosAction() {
			$this->render('gestionUsuarios');

		}

		function bloquearAction() {
			if (!$this->security(false) && $_SESSION['user']->rol>=100) {
				header('Location: /taquillas/inicio');
			} else {
				$this->render('bloqueo');
				if ($_POST['bloqueo']){
					if ($_POST['confirmar_bloqueo']){
						Taquillas::bloquearApp();
					}

				}
			}
		}

		function desbloquearAction() {
			if (!$this->security(false) && $_SESSION['user']->rol>=100) {
				header('Location: /taquillas/inicio');
			} else {
				$this->render('desbloquear');
				if (isset($_POST['desbloqueo'])){
					if (isset($_POST['confirmar_desbloqueo'])){
						Taquillas::desbloquearApp();
					}

				}
			}
		}

		function resetearAction(){
			if (!$this->security(false) && $_SESSION['user']->rol>=100) {
				header('Location: /taquillas/inicio');
			} else {
				$this->render('resetear');
				if (isset($_POST['resetear'])){
					if (isset($_POST['confirmar_reseteo'])){
						Taquilla::resetearTaquilla();
					}
				}
			}
		}
?>