<?php 

namespace App\Models;

use CodeIgniter\Model;

class UsuariosModel extends Model
{
	protected $table = 'usuarios';
	protected $allowedFields = [];
	
	public function getCount()
	{
		return $this->countAll();
	}

	public function getLimit($limit, $offset)
	{
		return $this->findAll($limit, $offset);
	}

	public function getAll()
	{
		return $this->findAll();
	}

	public function logar($find)
    {
        $this->where($find);
        return $this->findAll();
    }

    public function newUsuario($usuario)
    {
        return $this->save($usuario);
    }

    public function editUsuario($id,$data)
    {
       return $this->where('id',$id)->set($data)->update();
    }
}