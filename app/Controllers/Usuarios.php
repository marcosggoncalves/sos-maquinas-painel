<?php 

namespace App\Controllers;

use App\Models\UsuariosModel;


class Usuarios extends BaseController
{
	public function __construct()
    {
		helper('url');
		helper('form');

		$this->usuariosModel = new UsuariosModel();
	}

	public function index()
	{
		$data = [
			'titulo' => 'SOS Máquinas | Usuários',
			'usuarios' => $this->usuariosModel->getAll(0,100),
		];

		return view('usuarios', $data);
	}
}