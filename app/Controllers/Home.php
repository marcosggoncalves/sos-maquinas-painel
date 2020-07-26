<?php 

namespace App\Controllers;

use App\Models\UsuariosModel;
use App\Models\UsuariosAdministradoresModel;
use App\Models\CategoriasModel;
use App\Models\AnunciosModel;
use App\Models\CategoriasSimbolosModel;


class Home extends BaseController
{
	public function __construct()
    {
		helper('url');
		helper('form');

		$this->usuariosModel = new UsuariosModel();
		$this->usuariosAdminModel = new UsuariosAdministradoresModel();
		$this->anunciosModel = new AnunciosModel();
		$this->categoriasModel = new CategoriasModel();
		$this->categoriasSimbolosModel = new CategoriasSimbolosModel();
	}

	public function index()
	{

		$atualizacao = $this->usuariosAdminModel->atualizacao();

		$data = [
			'titulo' => "SOS Máquinas | Painel",
			'countUsuarios' => $this->usuariosModel->getCount(),
			'usuarios' => $this->usuariosModel->getLimit(0,10),
			'countPublicidades' => $this->anunciosModel->getCount(),
			'publicidades' => $this->anunciosModel->getLimit(0,6),
			'countCategorias'=> $this->categoriasModel->getCount(),
			'countSimbolos' => $this->categoriasSimbolosModel->getCount()
		];

		if($atualizacao['pendente'] > 1){
			$data['status'] = false;
			$data['message'] = "Sincronização de dados não está sendo executada corretamente.";
		}

		if($atualizacao['pendente'] === 1){
			$data['status'] = true;
			$data['message'] = "Sincronização criada em " . date_format(date_create($atualizacao['atualizacao'][0]->atualizacao), 'd/m/Y H:i:s') . " foi encontrada, em breve sincronização será feita."; 
		}

		return view('index', $data);
	}

	public function login()
	{
		$data = [
			'titulo' => "SOS Máquinas | Entrar",
		];

		return view('login',$data);
	}

	public function entrar()
	{
		$validation = \Config\Services::validation();

		$validate = $this->validate([
			'email'  => 'required',
			'senha'  => 'required',
		]);
		
		if(!$validate){
			$data = [
				'validate'=>$this->validator->listErrors(),
				'status'=>false,
				'message'=>'Não foi possivel realizar login no sistema!'
			];
	
			$this->session->setFlashdata('save', $data);
			return redirect()->to('/login');
		}else{
			$data = [
				'status'=>false,
				'message'=>'E-mail/senha incorretos'
			];
			$find = [
				'email'=>$this->request->getVar('email'),
				'senha'=> md5($this->request->getVar('senha'))
			];
		
			$entrar = $this->usuariosAdminModel->logar($find);

			if(count($entrar) === 0){
				$this->session->setFlashdata('save', $data);
				return redirect()->to('/login');
			}
			
			$session = [
				'user'=>$entrar,
				'logado'=>true
			];

			$this->session->set('login',$session);
			return redirect()->to('/');
		}
	}

	public function sair(){
		$this->session->destroy();
		return redirect()->to('/login');
	}
}
