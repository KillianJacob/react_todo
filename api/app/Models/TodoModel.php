<?php namespace App\Models;

use CodeIgniter\Model;

class TodoModel extends Model
{

    function __construct(){

        $this->db = \Config\Database::connect();

    }

    public function getTodo(){

        $builder = $this->db->table('todo');
        $query   = $builder->get();

        return $query->getResult();

    }

    public function insertTodo($todo){

        try{

        $builder = $this->db->table('todo');

        $data = [
            'todo' => $todo
        ];
        
        $builder->insert($data);

        return true;

        }catch(Exception $e){

            return false;

        }

    }

    public function deleteTodo($id_todo){

        try{

        $builder = $this->db->table('todo');
        
        $builder->delete(['id_todo' => $id_todo]);

        return true;

        }catch(Exception $e){

            return false;

        }

    }


}