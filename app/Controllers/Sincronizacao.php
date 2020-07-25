<?php 

namespace App\Controllers;

use App\Models\SicronizacaoModel;

class Sincronizacao extends BaseController 
{
	public function __construct()
    {
		helper('url');
		helper('form');

		$this->sicronizacaoModel = new SicronizacaoModel();
	}

	public function index()
	{
		$pager = \Config\Services::pager();

		$data = [
			'titulo' => 'SOS Máquinas | Atualizações de dados aplicativo',
			'atualizacoes' => $this->sicronizacaoModel->join('usuarios_admin', 'atualizacoes.usuarios_admin_id = usuarios_admin.id')->paginate(20),
            'pager' => $this->sicronizacaoModel->pager
		];

		return view("sincronizacao",$data);
	}
}