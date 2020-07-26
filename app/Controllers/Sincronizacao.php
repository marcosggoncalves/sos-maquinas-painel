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

		$atualizacoes = $this->sicronizacaoModel
							->select(
								'atualizacoes.id , atualizacoes.atualizacao, usuarios_admin.email, atualizacoes.status, atualizacoes.realizado'
							)
							->join('usuarios_admin', 'atualizacoes.usuarios_admin_id = usuarios_admin.id')
							->orderBy('atualizacoes.id',' desc')
							->paginate(15);

		$data = [
			'titulo' => 'SOS Máquinas | Atualizações de dados aplicativo',
			'atualizacoes' => $atualizacoes,
            'pager' => $this->sicronizacaoModel->pager
		];

		return view("sincronizacao",$data);
	}
}