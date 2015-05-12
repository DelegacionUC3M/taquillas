<?php

	class managerController extends Controller {

		function gestionUsuariosAction() {
			if ($this->security(true) && $_SESSION['user']->rol>=100) {
				$this->render('gestionUsuarios');
			}
		}

		function bloquearAction() {
			if ($this->security(true) && $_SESSION['user']->rol>=100) {
				if (isset($_POST['confirmar_bloqueo'])) {
					print_r("ENTRA bloqearAction");
					Taquilla::bloquearApp();
				}
				$this->render('bloquear');
			}
		}

		function desbloquearAction() {
			if ($this->security(true) && $_SESSION['user']->rol>=100) {
				if (isset($_POST['confirmar_desbloqueo'])) {
					Taquilla::desbloquearApp();
				}
				$this->render('bloquear');
			}
		}

		function resetearAction(){
			if ($this->security(true) && $_SESSION['user']->rol>=100) {
				if (isset($_POST['confirmar_reseteo'])) {
					Taquilla::resetearTaquilla();
				}
				$this->render('resetear');
			}
		}
	}
?>