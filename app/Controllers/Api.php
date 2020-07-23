<?php 

namespace App\Controllers;

use App\Models\UsuariosModel;
use App\Models\UsuariosAdministradoresModel;
use App\Models\CategoriasModel;
use App\Models\PublicidadesModel;
use App\Models\CategoriasSimbolosModel;

use CodeIgniter\API\ResponseTrait;

class Api extends BaseController
{
	 use ResponseTrait;

	public function __construct()
    {
		helper('url');
		helper('form');

		$this->usuariosModel = new UsuariosModel();
		$this->usuariosAdminModel = new UsuariosAdministradoresModel();
		$this->publicidadesModel = new PublicidadesModel();
		$this->categoriasModel = new CategoriasModel();
		$this->categoriasSimbolosModel = new CategoriasSimbolosModel();
	}

	public function publicidades()
	{
		 return $this->respond([
		 	'success' => true,
		 	'publicidades' => $this->publicidadesModel->getAll(0,10)
		 ], 200);
	}

	public function categorias()
	{
		 return $this->respond([
		 	'success' => true,
		 	'categorias' => $this->categoriasModel->getAll()
		 ], 200);
	}

	public function simbolos()
	{
		 return $this->respond([
		 	'success' => true,
		 	'categorias' => $this->categoriasSimbolosModel->getAll()
		 ], 200);
	}
}