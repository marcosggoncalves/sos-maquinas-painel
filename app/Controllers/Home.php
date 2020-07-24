<?php 

namespace App\Controllers;

use App\Models\UsuariosModel;
use App\Models\UsuariosAdministradoresModel;
use App\Models\CategoriasModel;
use App\Models\PublicidadesModel;
use App\Models\CategoriasSimbolosModel;


class Home extends BaseController
{
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

	public function index()
	{
		$data = [
			'titulo' => "SOS Máquinas | Painel",
			'countUsuarios' => $this->usuariosModel->getCount(),
			'usuarios' => $this->usuariosModel->getLimit(0,30),
			'countPublicidades' => $this->publicidadesModel->getCount(),
			'publicidades' => $this->publicidadesModel->getLimit(0,6),
			'countCategorias'=> $this->categoriasModel->getCount(),
			'countSimbolos' => $this->categoriasSimbolosModel->getCount()
		];

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
