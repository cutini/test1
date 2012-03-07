<?php
class UsersController extends AppController
{
	public function index(){
	}

	public function add(){
		if($this->request->is('ajax')){
			$this->layout = 'ajax';
			if(!empty($this->request->data)){
				$this->autoRender = false;
				// crear una instancia del usuario.
				$this->User->create();
				// setiar el usuario.
				$this->User->set($this->data['User']);
				// validar el usuario.
				if($this->User->validates()){
					if($this->User->save($this->data['User'])){
						// crear salida en JSON.
						$output = array('error' => false);
						echo json_encode($output);
					}
					else{
						// crear salida en JSON.
						$output = array('error' => true, 'errorType' => 'internal');
						echo json_encode($output);
					}
				}
				else{
					// crear salida en JSON.
					$errors = $this->User->validationErrors;
					$output = array('error'	=> true, 'errorType' => 'validation');
					array_push($output, $errors);
					echo json_encode($output);
				}
			}			
		}
	}

	public function delete($id = null){
		$this->autoRender = false;
		if($this->request->is('ajax')){
			if($this->User->delete($id)){
				$output = array("error" => false);
				echo json_encode($output);
 			}
 			else{
 				$output = array("error" => true);
 				echo json_encode($output);
 			}
		}
	}

	public function edit($id = null){
		if($this->request->is('ajax')){
			// establecer layout ajax por defecto.
			$this->layout = 'ajax';
			// solo queremos obtener los datos de la tabla users.
			$this->User->recursive = -1;
			// obtenemos los datos a traves de una consulta con find.
			$user = $this->User->find('first', array('conditions'	=> array('User.id'	=> $id)));	
			// enviamos a la vista.
			$this->set('user', $user);
			if(!empty($this->request->data)){
				$this->autoRender = false;
				// crear una instancia del usuario.
				$this->User->create();
				// establecer id del usuario a editar.	
				$this->User->id = $id;
				// setiar el usuario.
				$this->User->set($this->data['User']);
				// validar el usuario.
				if($this->User->validates()){
					if($this->User->save($this->data['User'])){
						// crear salida en JSON.
						$output = array('error' => false);
						echo json_encode($output);
					}
					else{
						// crear salida en JSON.
						$output = array('error' => true, 'errorType' => 'internal');
						echo json_encode($output);
					}
				}
				else{
					// crear salida en JSON.
					$errors = $this->User->validationErrors;
					$output = array('error'	=> true, 'errorType' => 'validation');
					array_push($output, $errors);
					echo json_encode($output);
				}
			}
		}
	}

	public function find(){
		
		$this->autoRender = 'ajax';
		$this->User->recursive = -1;
		$users = $this->User->find('all');
		$this->set('users', $users);
	}

}
?>