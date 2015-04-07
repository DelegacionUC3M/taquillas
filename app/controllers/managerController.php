<?php

	class managerController extends Controller {

		function gestionUsuariosAction() {
			if (!$this->security(true) && $_SESSION['user']->rol>=100) {
				$this->render('gestionUsuarios');
			}

		}

		function bloquearAction() {
			if (!$this->security(true) && $_SESSION['user']->rol>=100) {
				if ($_POST['bloqueo']){
					if ($_POST['confirmar_bloqueo']){
						Taquillas::bloquearApp();
					}
				}
				$this->render('bloqueo');
			}
		}

		function desbloquearAction() {
			if (!$this->security(true) && $_SESSION['user']->rol>=100) {
				if (isset($_POST['desbloqueo'])){
					if (isset($_POST['confirmar_desbloqueo'])){
						Taquillas::desbloquearApp();
					}
				}
				$this->render('desbloquear');
			}
		}

		function resetearAction(){
			if (!$this->security(true) && $_SESSION['user']->rol>=100) {
				if (isset($_POST['resetear'])){
					if (isset($_POST['confirmar_reseteo'])){
						Taquilla::resetearTaquilla();
					}
				}
				$this->render('resetear');
			}
		}
?>