<?php

	class AdminController extends Controller {

		/**
		 *Comprueba la identidad del usuario y si es correcta realiza una llamada
		 * a la función panel.
		 * En caso de no validarse se redirige al inicio.
		 * 
		 * @return void
		 */
		function index () {
			if ($this->security(false)) {
				$this->panel();
			}
			else {
				$this->render('inicio');
			}
		}

		function listar () {

		}

		function asignar() {

		}

		function cobrar() {
			
		}

		function gestion() {

		}

		function firma() {

		}

		function stats() {

		}
	}
?>