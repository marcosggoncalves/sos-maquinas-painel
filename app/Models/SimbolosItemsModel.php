<?php

namespace App\Models;

use CodeIgniter\Model;

class SimbolosItemsModel extends Model
{
	
	protected $table = 'simbolos_items';

	protected $allowedFields = [
		'descricao',
		'tipo',
		'categoria_simbolo_id'
	];

	public function getAll()
    {
        return $this->findAll();
    }

    public function getFilter($id)
    {
        return $this->where('categoria_simbolo_id =', $id)->findAll();
    }

	public function newSimboloItem($simbolo)
    {
        return $this->save($simbolo);
    }

    public function deleteSimboloItem($id)
    {   
        $this->where('id',$id);
        return $this->delete();
    }
    
    public function getSimboloEditItem($id)
    {
        return $this->where('id', $id)->findAll();
    }
    
    public function editSimboloItem($id,$data)
    {
       return $this->where('id',$id)->set($data)->update();
    }
}

