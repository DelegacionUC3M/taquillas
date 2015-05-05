<?php

	class adminController extends Controller {
		
		function listarAction() {
			if ($this->security(true) && $_SESSION['user']->rol>=50) {
				if (isset($_POST['busqueda'])) {
					$search = array();
					if (!empty($_POST['campus'])) {
						$search['campus'] = $_POST['campus'];
					} if (!empty($_POST['edificio'])) {
						$edificio = explode(' ', $_POST['edificio']);
						$search['edificio'] = $edificio[0];
					} if (!empty($_POST['planta'])) {
						$search['planta'] = $_POST['planta'];
					} if (!empty($_POST['zona'])){
						$search['zona'] = "'".$_POST['zona']."'";
					} if (!empty($_POST['tipo'])){
						$search['tipo'] = "'".$_POST['tipo']."'";
					}
					//Taquillas resultantes de la busqueda
					var_dump($search);
					$listado = Taquilla::findByAttributes($search);
					$this->render('listado',array('lista'=>$listado));
				}
				else{
					$this->render('listado');
				}
			}
		}

		function asignarAction() {
			if ($this->security(true) && $_SESSION['user']->rol>=50) {
				$this->render('asignar');
			}
		}

		function cobrarAction() {
			if ($this->security(true) && $_SESSION['user']->rol>=50) {
				$this->render('cobrar');
			}
		}

		function gestionAction() {
			if ($this->security(true) && $_SESSION['user']->rol>=50) {
				if (isset($_GET['id'])){
					$search = array('id'=>$_GET['id']);
					print_r($_GET['id']);
					$taquilla = Taquilla::findByAttributes($search);
					$this->render('modificarTaq',array('datos'=>$taquilla[0]));
				}
				else{
					$this->render('modificarTaq');
				}
			}
		}

		function firmaAction() {
			if ($this->security(true) && $_SESSION['user']->rol>=50) {
				$this->render('firma');
			}
		}

		function statsAction() {
			if ($this->security(true) && $_SESSION['user']->rol>=50) {
				$this->render('estadisticas');
			}
		}


	}
?>