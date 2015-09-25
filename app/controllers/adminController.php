<?php

	class adminController extends Controller {
		
		/**
		 * Permite listar las taquillas según un filtro.
		 * 
		 * @return void
		 */
		function listarAction() {
			if (BLOQUEAR == 1){
				$this->render('appBloqueada');
			} else if ($this->security(true) && $_SESSION['user']->rol>=50) {
				if (isset($_POST['busqueda'])) {
					$error = '';
					$search = array();
					$listado;
					var_dump($_POST);
					if (isset($_POST['campus'])) {
						$search['campus'] = $_POST['campus'];
					} if (isset($_POST['edificio'])) {
						$edificio = explode(' ', $_POST['edificio']);
						$search['edificio'] = $edificio[0];
					} if (isset($_POST['planta'])) {
						var_dump("ENTRO EN PLANTA");
						$search['planta'] = $_POST['planta'];
					} if (isset($_POST['zona'])) {
						$search['zona'] = "'".$_POST['zona']."'";
					} if (isset($_POST['tipo'])) {
						$search['tipo'] = "'".$_POST['tipo']."'";
					} if (isset($_POST['user_id'])) {
						$search['user_id'] = $_POST['user_id'];
					} if (isset($_POST['num_taquilla'])) {
						$search['num_taquilla'] = $_POST['num_taquilla'];
					} if (isset($_POST['fecha'])) {
						$search['fecha'] = "'".$_POST['fecha']."'";
					} if (isset($_POST['estado'])) {
						$search['estado'] = $_POST['estado'];
					}
					var_dump($search);
					//Taquillas resultantes de la busqueda
					$listado = Taquilla::findByAttributes($search);
					
					$this->render('listado',array('lista'=>$listado, 'error'=>$error));
				}
				else{
					$this->render('listado');
				}
			}
		}

		/**
		 * Permite modificar los atributos de una taquilla.
		 * 
		 * @return void
		 */
		function gestionAction() {
			if (BLOQUEAR == 1){
				$this->render('appBloqueada');
			} else if ($this->security(true) && $_SESSION['user']->rol>=50) {
				$id;
				$datos;
				$nombre;
				$cambio = "";
				$error = "";

				if (isset($_POST['cobrar'])) {
					if (!empty($_POST['user_id'])) {
						$_SESSION['cobrar'] = 'cobrar';
						$_SESSION['user_id'] = $_POST['user_id'];
						header('Location: /taquillas/admin/cobrar/'.$_GET['id']);
					} else {
						$error = 'NIA necesario';	
					}					
				}
				if (isset($_GET['id'])) {
					$id = $_GET['id'];
					$search = array('id'=>$_GET['id']);
					$taquilla = Taquilla::findByAttributes($search);
					$datos = $taquilla[0];
					$nombre = User::findByNIA($datos->user_id);
					$nombre = $nombre->cn;
				}

				if (isset($_POST['gestion'])) {
					//Comprobación del dueño
					if (!empty($_POST['user_id'])) {
						if(is_null(User::findByNIA($_POST['user_id']))) {
							$error = 'Usuario no encontrado';
						}
						if(empty($_POST['fecha'])) {
							$error .= 'Necesaria una fecha si tiene dueño la taquilla';
						}
					}

					//Comprobación del estado
					if (!empty($_POST['estado'])) {
						if (($_POST['estado'] != 1) && ($_POST['estado'] != 2) && ($_POST['estado'] != 3) && ($_POST['estado'] != 4)) {
							$error .= 'Estado no válido';
						}
						if ($_POST['estado'] == 1 && (!empty($_POST['user_id']) || !empty($_POST['fecha'])) ) {
							$error .= 'Si el estado es libre, no puede tener dueño';
						}
						if (empty($_POST['user_id']) && ($_POST['estado'] == 2 || $_POST['estado'] == 3)) {
							$error .= 'Es necesario que la taquilla tenga un dueño';
						}
					}
					//Comprobación de la fecha
					if (!empty($_POST['fecha'])) {
						if (($_POST['estado'] != 2) && ($_POST['estado'] != 3)) {
							$error .= 'Para que tenga fecha la taquilla debe estar ocupada/reservada';
						}
						if (empty($_POST['user_id'])) {
							$error .= 'Si la taquilla está ocupada/reservada debe tener la fecha de ésta';
						}
					}
					//ejecución correcta. Se comprueba que el mensaje de cambio no se ha modificado.
					if (strcmp($error,"") == 0) {
						$taquilla = Taquilla::findByAttributes(array('id' => $id));
						$datos = $taquilla[0];
						$usr = $_POST['user_id'];
						$fecha = $_POST['fecha'];
						if (empty($usr)){
							$usr = NULL;
						}
						if (empty($fecha)){
							$fecha = NULL;
						}
						$datos->user_id = $usr;
						$datos->estado = $_POST['estado'];
						$datos->fecha = $fecha;
						$datos->save();
						$cambio .= 'Cambios realizados correctamente';
					}					
				}
				$this->render('modificarTaq',array('datos'=>$datos, 'nombre'=>$nombre, 'cambio' => $cambio, 'error' => $error));
			}
		}

		/**
		 * Lista todas las taquillas según el filtro indicado.
		 * 
		 * @return void
		 */
		function gestionTaqAction() {
			if (BLOQUEAR == 1){
				$this->render('appBloqueada');
			} else if ($this->security(true) && $_SESSION['user']->rol>=50) {
				if (isset($_POST['busqueda'])) {
					$search = array();
					$error = "";
					$listado;
					if (empty($_POST['campus']) || empty($_POST['edificio']) || empty($_POST['planta']) 
						|| empty($_POST['zona']) || empty($_POST['tipo']) || empty($_POST['user_id']) 
						|| empty($_POST['num_taquilla']) || empty($_POST['fecha']) || empty($_POST['estado']) ) {
						$error = 'Todos los campos son obligatorios';
					} else {
						$search['campus'] = $_POST['campus'];
						$edificio = explode(' ', $_POST['edificio']);
						$search['edificio'] = $edificio[0];
						$search['planta'] = $_POST['planta'];
						$search['zona'] = "'".$_POST['zona']."'";
						$search['tipo'] = "'".$_POST['tipo']."'";
						$search['user_id'] = $_POST['user_id'];
						$search['num_taquilla'] = $_POST['num_taquilla'];
						$search['fecha'] = "'".$_POST['fecha']."'";
						$search['estado'] = $_POST['estado'];
						//Taquillas resultantes de la busqueda
						$listado = Taquilla::findByAttributes($search);
						if (empty($listado)){
							$error = "Esta taquilla no existe.";
						}
					}					
					$this->render('gestionTaquillas', array('lista' => $listado, 'error' => $error));
				}
				else{
					$this->render('gestionTaquillas');
				}
				
			}
		}

		/**
		 * Permite intercambiar los dueños de 2 taquillas distintas.
		 * Se actualiza la fecha de la taquilla, a la fecha actual.
		 * 
		 * @return void
		 */
		function intercambiarAction() {
			if (BLOQUEAR == 1){
				$this->render('appBloqueada');
			} else if ($this->security(true) && $_SESSION['user']->rol>=50) {
				$error = '';
				$confirm = '';
				$taq1 = null;
				$taq2 = null;
				if (isset($_POST['intercambiar'])) {
					if ((empty($_POST['taquilla1']) || empty($_POST['taquilla2'])) && (empty($_POST['user1']) || empty($_POST['user2']))  ) {
						$error = 'Deben seleccionarse una taquilla de cada usuario';
					}
					else if (!empty($_POST['taquilla1']) || !empty($_POST['taquilla2'])) {
						//Taquilla del usuario 1
						$taq1 = Taquilla::findByAttributes(array('id' => $_POST['taquilla1']));
						//Taquilla del usuario 2
						$taq2 = Taquilla::findByAttributes(array('id' => $_POST['taquilla2']));
						if (is_null($taq1[0])) {
							$error = 'El usuario 1 no tiene taquilla';
							$this->render('intercambiar',array('error' => $error));
						}
						if (is_null($taq2[0])) {
							$error = 'El usuario 2 no tiene taquilla';
							$this->render('intercambiar',array('error' => $error));
						}

					}
					else {
						//Taquilla del usuario 1
						$taq1 = Taquilla::findByAttributes(array('user_id' => $_POST['user1']));
						//Taquilla del usuario 2
						$taq2 = Taquilla::findByAttributes(array('user_id' => $_POST['user2']));
						//Se comprueba que ambos tengan taquillas
						if (is_null($taq1[0])) {
							$error = 'El usuario 1 no tiene taquilla';
							$this->render('intercambiar',array('error' => $error));
						}
						if (is_null($taq2[0])) {
							$error = 'El usuario 2 no tiene taquilla';
							$this->render('intercambiar',array('error' => $error));
						}
					}

					//Se intercambian los usuarios y se guarda
					if (count($taq1) == 1 && count($taq2) == 1){
						$aux = $taq1[0]->user_id;
						$taq1[0]->user_id = $taq2[0]->user_id;
						$taq2[0]->user_id = $aux;
						$taq1[0]->fecha = date("d-m-Y");
						$taq2[0]->fecha = date("d-m-Y");
						$taq1[0]->save();
						$taq2[0]->save();
						$confirm = 'Intercambio realizado correctamente';
					}
				}
				$this->render('intercambiar',array('error' => $error, 'confirm' => $confirm, 'usuario1' => $taq1, 'usuario2' => $taq2));
			}
		}

		/**
		 * Permite reservar una taquilla desde el panel de administrador
		 * 
		 * @return void
		 */
		function asignarAction() {
			if (BLOQUEAR == 1){
				$this->render('appBloqueada');
			} else if ($this->security(true) && $_SESSION['user']->rol>=50) {
				$error = '';
				if (isset($_POST['asignar'])){
					if(isset($_POST['campus']) && isset($_POST['edificio']) && isset($_POST['planta']) && isset($_POST['zona']) && isset($_POST['tipo']) && isset($_POST['user_id'])) {
						$busqueda = array('user_id' => $_POST['user_id'], 'estado' => 2);
						$taqDisponibles = Taquilla::findByAttributes($busqueda);
						//No hay reserva
						if(count($taqDisponibles) == 0) {
							$edificio = explode(' ', $_POST['edificio']);
							$busqueda = array(
								'campus' => $_POST['campus'],
								'edificio' => $edificio[0],
								'planta' => $_POST['planta'],
								'zona' => "'".$_POST['zona']."'",
								'tipo' => "'".$_POST['tipo']."'",
								'estado' => 1,
								'user_id' => NULL,
								);
							if (!empty($_POST['num_taquilla'])){
								$busqueda['num_taquilla'] = $_POST['num_taquilla'];
							}
							$taqDisponibles = Taquilla::findByAttributes($busqueda);
							//Encuentra taquillas libres
							if (!empty($taqDisponibles)) {
								//Si se ha buscado por id se le asigna
								if (!empty($_POST['num_taquilla'])) {
									$reserva = new Taquilla;
									$reserva = $taqDisponibles[0];
									$reserva->user_id = $_POST['user_id'];
								} else {
									//Si no se busca por id es aleatorio
									$aleatorio = rand (0,count($taqDisponibles)-1);
									$reserva = new Taquilla;
									$reserva = $taqDisponibles[$aleatorio];
									$reserva->user_id = $_POST['user_id'];
								}
								$email = User::findByNIA($_POST['user_id'])->mail;
								$nombre = User::findByNIA($_POST['user_id'])->cn;
								$this->render('confirmarAsig',array('reserva'=>$reserva, 'email'=>$email, 'nombre'=>$nombre));
							} else {
								//No hay taquillas libres
								$error = 'No hay taquillas libres';
								$this->render('asigCobra',array('error' => $error));
							}
						}
						//Caso de que ya exista 1 o + reservas, se elige la 1º.
						else if ($taqDisponibles[0]->estado == 2) {
							$reserva = $taqDisponibles[0];
							$email = User::findByNIA($_POST['user_id'])->mail;
							$nombre = User::findByNIA($_POST['user_id'])->cn;
							$this->render('confirmarAsig',array('reserva'=>$reserva, 'email'=>$email, 'nombre'=>$nombre));
						}
						else{
							$error = 'Ha ocurrido un error';
							$this->render('asigCobra',array('error' => $error));
						}
					} else {
						//Algún campo vacío
						$error = 'Todos los campos son obligatorios';
						$this->render('asigCobra',array('error' => $error));
					}
				}
				else{
					$this->render('asigCobra',array('error' => $error));
				}
			}
		}

		/**
		 * Asigna, cobra y genera un recibo correspondiente al alquiler de la taquilla
		 * 
		 * @return void
		 */
		function cobrarAction() {
			if (BLOQUEAR == 1){
				$this->render('appBloqueada');
			} else if ($this->security(true) && $_SESSION['user']->rol>=50) {
				$error = '';
				$confirm = '';
				$taq;
				if (isset($_POST['cobrar']) || isset($_SESSION['cobrar'])) {
					if (isset($_GET['id'])) {
						$busq = array(
							'id' => $_GET['id']
							);
						
						$taq = Taquilla::findByAttributes($busq)[0];
						$taq->estado = 3;
						$taq->user_id = (isset($_POST['user_id']) ? $_POST['user_id'] : $_SESSION['user_id']);
						if (empty($taq->fecha)){
							$taq->fecha = date("d-m-Y");
						}
						if (isset($_SESSION['cobrar'])) {
							unset($_SESSION['cobrar']);
							unset($_SESSION['user_id']);
						}
						//se ha guardado la taquilla, ahora se pasa a generar el PDF
						$taq->save();

						$numero = $taq->num_taquilla;
					    $campus = $taq->campus;
					    $edificio = $taq->edificio;
			            $niu = $taq->user_id;
			            $alumno = User::findByNIA($niu)->cn;
			            $edificio = Taquilla::$nombreEdificios[$campus][$edificio];
			            $zona = $taq->zona;
			            $planta = $taq->planta;
			            $tipo = $taq->tipo;
			            $fecha = $taq->fecha;


			            // Renderiza el PDF
						$pdf = new PDF();
			            $pdf->SetTitle('Comprobante de Pago',true);
			            $pdf->SetAuthor('App Taquillas',true);
			            $pdf->SetMargins(20, 12, 20);
			            $pdf->AliasNbPages();
			            $pdf->AddPage();
			            $html1 = utf8_decode(
			            "<p>El alumno/a <b>$alumno</b> con <b>NIU $niu</b>, ha realizado el pago de la taquilla <b>$numero</b> del edificio <b>$edificio</b> zona <b>$zona</b> planta <b>$planta</b> tipo <b>$tipo</b> el dia <u>$fecha</u>.");
			            if ($tipo == 'simple') {
			                $html1 .= " El coste es de 4 (cuatro) euros.";
			            } else if ($tipo == 'doble') {
			                $html1 .= " El coste es de 6 (seis) euros.";
			            } else {
			                $html1 .= " El coste es de 6 (seis) euros.";
			            }
			            $html1 .= "</p>";
			            $pdf->SetTextColor(16, 13, 98);
			            $pdf->SetFont('Times', '', 10);
			            $pdf->WriteHTML($html1);
			            $pdf->Ln(10);
			            $html2 = "</br>CONDICIONES GENERALES DE CONTRATACION APLICABLE A LOS USUARIOS DE LAS TAQUILLAS.";
			            $pdf->SetFont('Times', '', 12);
			            $pdf->WriteHTML($html2);
			            $pdf->Ln(10);
			            $pdf->SetFont('Times', '', 8);
			            $normas="";
			            if ($campus == '1'){
			            	$normas = utf8_decode(
							"

							Art. 1: La cesión del uso y disfrute de una taquilla implica el conocimiento y la aceptación incondicional de las condiciones generales que a continuación se detallan.

							Art. 2: La titularidad de todas las taquillas corresponde a la Universidad Carlos III de Madrid, que encomienda en exclusiva a la Delegación de Estudiantes de la Facultad de Ciencias Sociales y Jurídicas la gestión de todas las existentes en el Campus de dicha Facultad.

							Art. 3: Por Aplicación del artículo anterior, nunca se podrá otorgar a ningún solicitante más que el mero uso y disfrute de la taquilla, siendo obligación de éste el debido mantenimiento de la misma mientras conste como usuario. Tanto la Delegación de Estudiantes, como la UC3M no es responsable en ningún caso de los objetos depositados dentro de una taquilla.

							Art. 4: Será necesario identificarse mediante el Número de Identificación Académica que aparece en el carné de estudiantes para solicitar una taquilla.

							Art. 5: 1o.- Se abrirá un proceso de asignación de taquillas durante el mes de octubre de cada curso académico mediante el procedimiento de la Delegación de Estudiantes estime en cada momento según las necesidades del momento. Así mismo, es potestad de la Delegación la fijación de un precio por el uso de las taquillas.
							        2o.- En este proceso se designará al usuario o usuarios de la taquilla, que sólo podrán variar previa notificación a la Delegación de Estudiantes.

							Art. 6: 1o.- Una taquilla puede asignarse a una sola persona o a un grupo de ellas, según las condiciones que cada año se establezcan.
							        2o.- Una persona sólo puede aparecer como usuario de una taquilla, sin importar el número de personas que figuren como usuarios de la misma, aunque dependiendo del caso en particular podrá haber alguna excepción, valorando cada caso la Delegación de Estudiantes.

							Art. 7: Con independencia del momento de asignación de la taquilla, el periodo de uso de la misma finalizará en el mes de octubre del curso académico siguiente al de la asignación, sin posibilidad de prórroga.

							Art. 8: Finalizado el periodo de uso, las taquillas podrán ser abiertas por la Delegación de Estudiantes sin previo aviso al titular, quedando los efectos que estuvieran en las mismas a cargo de la Delegación durante un periodo de dos meses. Transcurrido ese plazo, la Delegación de Estudiantes se deshará de dichos objetos requisados.

							Art. 9: 1o.- Para efectuar la retirada de los efectos retirados de las taquillas, mientras estén en posesión de la Delegación, será necesario presentar el carné de estudiante u otro documento de identificación y rellenar un formulario declarando que es propietario de los objetos que se retiran.
							        2o.- Tanto la Delegación de Estudiantes no se hace responsable del deterioro que pudieran haber sufrido los objetos durante su depósito en sus instalaciones.

							Art. 10: 1o.- Las taquillas ocupadas sin haber sido solicitadas a la Delegación podrán ser desalojadas por ésta sin previo aviso, quedando lo contenido en ellas sujeto a lo expuesto en los artículos 8 y 9 de la presente norma.
							         2o.- El usuario que encuentre la taquilla que le ha sido asignada ocupada en el momento de hacer uso de ella deberá ponerse en contacto con la Delegación de Estudiantes para su desalojo.

							LOS ABAJO FIRMANTES DECLARAN HABER LEÍDO LAS NORMAS DE USO DE LAS TAQUILLAS Y ACEPTARLAS.");
			            } else {
			            	$normas = utf8_decode(
			            		"
			            	1) El pago de alquiler comprende todo el curso académico y permite su uso desde el día de su pago hasta el 15 de Septiembre del año siguiente.
			            	2) Las taquillas deberán quedar libres de candado después de esa fecha, a partir de la Delegación de Estudiantes procederá a la apertura de las que aún continuaran cerradas, para permitir la entrada de los nuevos adjudicatarios. Aquellas personas que no desalojen en los plazos establecidos serán penalizados. Todos los enseres retirados de las taquillas serán almacenados durante 30 dias naturales, siendo destruidos a partir de esa fecha si no son reclamados por el anterior usuario de la taquilla.
			            	3) Los adjudicatarios se comprometen al cuidado permanente de la taquilla que les ha correspondido, y a no depositar en la misma elementos o sustancias peligrosas o molestas, ni que puedan dañar los muebles ni a los usuarios de las demás taquillas.
			            	4) Cualquier desperfecto no causado por el usuario deberá ser reportado a la Delegación de Estudiantes, a fin de que sea subsanándolo antes posible.
			            	5) Delegación de Estudiantes y la Universidad Carlos III de Madrid no se responsabilizan de los robos o sustracciones que pudieran darse en las taquillas.

							Firma:"
			            	);
			            }
			            

			            $pdf->MultiCell(0, 4, $normas, 0, 'J');
			            //Por seguriad calculo una especie de firma
			            $pdf->SetFont('Times', '', 10);
			            $pdf->Ln(10);
			            $firma = "Firma digital: ".sha1($campus.$edificio.$planta.$zona.$tipo.$numero.$niu);
			            $pdf->MultiCell(0, 4, $firma, 0, 'R');
			            $nombre = 'ResguardoNIU';
			            $pdf->AddPage();
			            //MultiCell(float w, float h, string txt [, mixed border [, string align [, boolean fill]]])
			            $html1 = utf8_decode(
			            "El alumno/a <b>$alumno</b> con <b>NIU $niu</b>, ha realizado el pago de la taquilla <b>$numero</b> del edificio <b>$edificio</b> zona <b>$zona</b> planta <b>$planta</b> tipo <b>$tipo</b> el dia <u>$fecha</u>.
			             CONDICIONES GENERALES DE CONTRATACIÓN APLICABLE A LOS USUARIOS DE LAS TAQUILLAS.");
			            if ($tipo == 'simple') {
			                $html1 .= " El coste es de 4 (cuatro) euros.";
			            } else if ($tipo == 'doble') {
			                $html1 .= " El coste es de 6 (seis) euros.";
			            } else {
			                $html1 .= " El coste es de 6 (seis) euros.";
			            }
			            $pdf->SetTextColor(16, 13, 98);
			            $pdf->SetFont('Times', '', 10);
			            $pdf->WriteHTML($html1);
			            $pdf->Ln(10);
			            $html2 = "</br>CONDICIONES GENERALES DE CONTRATACION APLICABLE A LOS USUARIOS DE LAS TAQUILLAS.";
			            $pdf->SetFont('Times', '', 12);
			            $pdf->WriteHTML($html2);
			            $pdf->Ln(10);
			            $pdf->SetFont('Times', '', 8);
			            if ($campus == '1'){
			            	$normas = utf8_decode(
							"

							Art. 1: La cesión del uso y disfrute de una taquilla implica el conocimiento y la aceptación incondicional de las condiciones generales que a continuación se detallan.

							Art. 2: La titularidad de todas las taquillas corresponde a la Universidad Carlos III de Madrid, que encomienda en exclusiva a la Delegación de Estudiantes de la Facultad de Ciencias Sociales y Jurídicas la gestión de todas las existentes en el Campus de dicha Facultad.

							Art. 3: Por Aplicación del artículo anterior, nunca se podrá otorgar a ningún solicitante más que el mero uso y disfrute de la taquilla, siendo obligación de éste el debido mantenimiento de la misma mientras conste como usuario. Tanto la Delegación de Estudiantes, como la UC3M no es responsable en ningún caso de los objetos depositados dentro de una taquilla.

							Art. 4: Será necesario identificarse mediante el Número de Identificación Académica que aparece en el carné de estudiantes para solicitar una taquilla.

							Art. 5: 1o.- Se abrirá un proceso de asignación de taquillas durante el mes de octubre de cada curso académico mediante el procedimiento de la Delegación de Estudiantes estime en cada momento según las necesidades del momento. Así mismo, es potestad de la Delegación la fijación de un precio por el uso de las taquillas.
							        2o.- En este proceso se designará al usuario o usuarios de la taquilla, que sólo podrán variar previa notificación a la Delegación de Estudiantes.

							Art. 6: 1o.- Una taquilla puede asignarse a una sola persona o a un grupo de ellas, según las condiciones que cada año se establezcan.
							        2o.- Una persona sólo puede aparecer como usuario de una taquilla, sin importar el número de personas que figuren como usuarios de la misma, aunque dependiendo del caso en particular podrá haber alguna excepción, valorando cada caso la Delegación de Estudiantes.

							Art. 7: Con independencia del momento de asignación de la taquilla, el periodo de uso de la misma finalizará en el mes de octubre del curso académico siguiente al de la asignación, sin posibilidad de prórroga.

							Art. 8: Finalizado el periodo de uso, las taquillas podrán ser abiertas por la Delegación de Estudiantes sin previo aviso al titular, quedando los efectos que estuvieran en las mismas a cargo de la Delegación durante un periodo de dos meses. Transcurrido ese plazo, la Delegación de Estudiantes se deshará de dichos objetos requisados.

							Art. 9: 1o.- Para efectuar la retirada de los efectos retirados de las taquillas, mientras estén en posesión de la Delegación, será necesario presentar el carné de estudiante u otro documento de identificación y rellenar un formulario declarando que es propietario de los objetos que se retiran.
							        2o.- Tanto la Delegación de Estudiantes no se hace responsable del deterioro que pudieran haber sufrido los objetos durante su depósito en sus instalaciones.

							Art. 10: 1o.- Las taquillas ocupadas sin haber sido solicitadas a la Delegación podrán ser desalojadas por ésta sin previo aviso, quedando lo contenido en ellas sujeto a lo expuesto en los artículos 8 y 9 de la presente norma.
							         2o.- El usuario que encuentre la taquilla que le ha sido asignada ocupada en el momento de hacer uso de ella deberá ponerse en contacto con la Delegación de Estudiantes para su desalojo.

							LOS ABAJO FIRMANTES DECLARAN HABER LEÍDO LAS NORMAS DE USO DE LAS TAQUILLAS Y ACEPTARLAS.");
			            } else {
			            	$normas = utf8_decode(
			            		"
			            	1) El pago de alquiler comprende todo el curso académico y permite su uso desde el día de su pago hasta el 15 de Septiembre del año siguiente.
			            	2) Las taquillas deberán quedar libres de candado después de esa fecha, a partir de la Delegación de Estudiantes procederá a la apertura de las que aún continuaran cerradas, para permitir la entrada de los nuevos adjudicatarios. Aquellas personas que no desalojen en los plazos establecidos serán penalizados. Todos los enseres retirados de las taquillas serán almacenados durante 30 dias naturales, siendo destruidos a partir de esa fecha si no son reclamados por el anterior usuario de la taquilla.
			            	3) Los adjudicatarios se comprometen al cuidado permanente de la taquilla que les ha correspondido, y a no depositar en la misma elementos o sustancias peligrosas o molestas, ni que puedan dañar los muebles ni a los usuarios de las demás taquillas.
			            	4) Cualquier desperfecto no causado por el usuario deberá ser reportado a la Delegación de Estudiantes, a fin de que sea subsanándolo antes posible.
			            	5) Delegación de Estudiantes y la Universidad Carlos III de Madrid no se responsabilizan de los robos o sustracciones que pudieran darse en las taquillas.

							Firma:"
			            	);
			            }

			            $pdf->MultiCell(0, 4, $normas, 0, 'J');
			            //Por seguriad calculo una especie de firma
			            $pdf->SetFont('Times', '', 10);
			            $pdf->Ln(10);
			            $firma = "Firma digital: ".sha1($campus.$edificio.$planta.$zona.$tipo.$numero.$niu);
			            $pdf->MultiCell(0, 4, $firma, 0, 'R');
			            $nombre = 'ResguardoNIU';
			           	$pdf->Output($nombre, 'I');
					}
					else{
						$error = 'Ups, algo salió mal';
					}
				}
				else{
					$this->render('confirmarAsig', array('error' => $error, 'confirm' => $confirm, 'reserva'=>$taq));
				}
			}
		}

		/**
		 * Permite generar una firma en función a los datos introducidos
		 * para compararla con otra.
		 * 
		 * @return void
		 */
		function firmaAction() {
			if (BLOQUEAR == 1) {
				$this->render('appBloqueada');
			} else if ($this->security(true) && $_SESSION['user']->rol>=50) {
				$firma = '';
				$resultado = '';
				if (isset($_POST['firma'])) {
					$numero = $_POST['num_taquilla'];
				    $campus = $_POST['campus'];
				    $edificio = $_POST['edificio'];
		            $niu = $_POST['user_id'];
		            $zona = $_POST['zona'].' ';
		            $planta = $_POST['planta'];
		            $tipo = $_POST['tipo'];
		            $firma = sha1($campus.$edificio.$planta.$zona.$tipo.$numero.$niu);
		            if (strcmp($firma,$_POST['firmaComp']) == 0) {
		            	$resultado = 'Ambas firmas son iguales';
		            }
		            else{
		            	$resultado = 'Firmas distintas';
		            }
				}
				$this->render('comprobarFirma', array('firma' => $firma, 'resultado' => $resultado, 'introducido' => $_POST['firmaComp']));
			}
		}

		/**
		 * Renderiza la vista de Estadísticas
		 * 
		 * @return void
		 */
		function statsAction() {
			if (BLOQUEAR == 1){
				$this->render('appBloqueada');
			} else if ($this->security(true) && $_SESSION['user']->rol>=50) {
				$this->render('stats');
			}
		}
	}

?>

