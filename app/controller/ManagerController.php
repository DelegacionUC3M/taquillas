<?php

	class ManagerController extends Controller {

		/**
		 *Comprueba la identidad del usuario y si es correcta realiza una llamada
		 * a la función panel.
		 * En caso de no validarse se redirige al inicio.
		 * 
		 * @return void
		 */
		function index (){
			if ($this->security(false)) {
				$this->panel();
			}
			else {
				$this->render('inicio');
			}
		}

		function gestionUsuarios() {

		}

		function bloquear() {
			if (!$this->security(false)) {
				header('Location: /taquillas/inicio');
			} else {
				if ($_POST['bloqueo']){
					if ($_POST['confirmar_bloqueo']){
						//llamar funcion bloqueo
					}

				}
			}
		}

		function desbloquear() {
			if (!$this->security(false)) {
				header('Location: /taquillas/inicio');
			} else {
				if (isset($_POST['desbloqueo'])){
					if (isset($_POST['confirmar_desbloqueo'])){
						//llamar funcion desbloqueo
					}

				}
			}
		}

		function resetear(){
			if (!$this->security(false)) {
				header('Location: /taquillas/inicio');
			} else {
				if (isset($_POST['resetear'])){
					if (isset($_POST['confirmar_reseteo'])){
						Taquilla::resetearTaquilla();
					}
				}
			}
		}
?>