<?php 
namespace App\Controllers;

use App\Models\TodoModel;

class Todo extends BaseController
{

	public function index()
	{

		header('Access-Control-Allow-Origin: *');
		header('Access-Control-Allow-Headers: *');
		header('Access-Control-Allow-Methods: POST, GET, DELETE');

		$method = $this->request->getMethod(true);

		if($method == "GET"){

			$todomodel = new TodoModel();

			$result = $todomodel->getTodo();

			$data = array(

				"data" => $result
			);

			return $this->response->setJSON($data);

		}
		else if($method == "POST"){

			$todomodel = new TodoModel();

			$todo = $this->request->getPost("todo");

			if($todo != null){

				$result = $todomodel->insertTodo($todo);

			}
			else{

				$result = false;

			}

			if($result){

				$data = array(

					"result" => "ok"
				);
	
			

			}
			else{

				$data = array(

					"result" => "Error"
				);

			}

			return $this->response->setJSON($data);	

		}
		else if($method == "DELETE"){

			$todomodel = new TodoModel();

			$todo = $this->request->getGet("id_todo");

			if($todo != null){

				$result = $todomodel->deleteTodo($todo);

			}
			else{

				$result = false;

			}

			if($result){

				$data = array(

					"result" => "ok"
				);
	
			

			}
			else{

				$data = array(

					"result" => "Error"
				);

			}

			return $this->response->setJSON($data);	

		}		

	}



	//--------------------------------------------------------------------

}
