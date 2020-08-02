<?php 

namespace App\Models;

use CodeIgniter\Model;

class UsuariosModel extends Model
{
	protected $table = 'usuarios';
	protected $allowedFields = [
		"email",
		"cpf",	
		"empresa",	
		"marca_veiculo",
		"tipo_veiculo",
		"nome",
		"telefone"
	];
	
	public function getCount()
	{
		return $this->countAll();
	}

	public function getLimit($limit, $offset)
	{
		return $this ->orderBy('id', 'DESC')->findAll($limit, $offset);
	}

	public function getAll()
	{
		return $this->findAll();
	}

	public function get($id)
	{
		return $this->where('id =',$id)->first();
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