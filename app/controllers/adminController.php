<?php

	class adminController extends Controller {

		/**
		 *Comprueba la identidad del usuario y si es correcta realiza una llamada
		 * a la función panel.
		 * En caso de no validarse se redirige al inicio.
		 * 
		 * @return void
		 */
		function indexAction() {
			if ($this->security(true) && $_SESSION['user']->rol>=50) {
				$this->render('admin');
			}
		}

		function panelAction(){
			if ($this->security(true) && $_SESSION['user']->rol>=50) {
				$this->render('panel');
			}
		}
		
		function listarAction() {
			if ($this->security(true) && $_SESSION['user']->rol>=50) {
				$this->render('listado');
				if (isset($_POST['busqueda']) {
					$search = array();
					if (!empty($_POST['campus'])) {
						$search['campus'] = $_POST['campus'];
					} if (!empty($_POST['edificio'])) {
						$search['edificio'] = $_POST['edificio'];
					} if (!empty($_POST['planta'])) {
						$search['planta'] = $_POST['planta'];
					} if (!empty($_POST['zona'])){
						$search['zona'] = $_POST['zona'];
					} if (!empty($_POST['tipo'])){
						$search['tipo'] = $_POST['tipo'];
					} if (!empty($_POST['user_id'])) {
						$search['user_id'] = $_POST['user_id'];
					}
					//Taquillas resultantes de la busqueda
					$listado = Taquillas::findByAttributes($search);
					$this->render('listado',array('lista'=>$listado));
				}
			}
		}

		function asignarAction() {
			$this->render('asignar');
		}

		function cobrarAction() {
			$this->render('cobrar');
		}

		function gestionAction() {
			$this->render('');

		}

		function firmaAction() {
			$this->render('firma');
		}

		function statsAction() {
			$this->render('estadisticas');

		}


	}
?>