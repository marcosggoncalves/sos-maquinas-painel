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
		$pager = \Config\Services::pager();

		$data = [
			'titulo' => 'SOS Máquinas | Usuários',
			'usuarios' => $this->usuariosModel->orderBy('id',' desc')->paginate(15),
			'pager' => $this->usuariosModel->pager
		];

		return view('usuarios', $data);
	}
}