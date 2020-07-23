<?php

namespace App\Models;

use CodeIgniter\Model;

class CategoriasModel extends Model
{
	
	protected $table = 'categorias';
	protected $allowedFields = ['id', 'imagem','categoria'];
	
	public function getCount()
	{
		return $this->countAll();
	}

	public function getAll()
	{
		return $this->findAll();
	}

	public function newCategoria($categoria)
    {
        return $this->save($categoria);
    }

    public function deleteCategoria($id)
    {   
        $this->where('id',$id);
        return $this->delete();
    }
    
    public function getCategoriaEdit($id)
    {
        return $this->where('id', $id)->findAll();
    }
    
    public function editCategoria($id,$data)
    {
       return $this->where('id',$id)->set($data)->update();
    }
}

