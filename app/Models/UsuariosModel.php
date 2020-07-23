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

	public function getAll($limit, $offset)
	{
		return $this->findAll($limit, $offset);
	}
}