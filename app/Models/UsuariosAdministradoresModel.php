<?php 

namespace App\Models;

use CodeIgniter\Model;

class UsuariosAdministradoresModel extends Model
{
	protected $table = 'usuarios_admin';
	
	protected $allowedFields = [
		"email",
		"senha"
	];
	
	public function getCount()
	{
		return $this->countAll();
	}

	public function getAll()
	{
		return $this->findAll();
	}

	public function newUsuario($usuario)
    {
        return $this->save($usuario);
    }

    public function deleteUsuario($id)
    {   
        $this->where('id',$id);
        return $this->delete();
    }
    
    public function getUsuarioEdit($id)
    {
        return $this->where('id', $id)->findAll();
    }

    public function verifyEmail($email)
    {
        return $this->where('email', $email)->first();
    }
    
    public function editUsuario($id,$data)
    {
       return $this->where('id',$id)->set($data)->update();
    }

    public function clear()
    {
        $this->db->query('delete from usuarios');
        $this->db->query('delete from publicidades');
        $this->db->query('delete from categorias');
        $this->db->query('delete from categorias_simbolos');
        return $this->db->query('delete from simbolos_items');
    }

    public function logar($find)
    {
        $this->where($find);
        return $this->findAll();
    }
}