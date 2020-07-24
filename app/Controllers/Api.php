<?php 

namespace App\Controllers;

use App\Models\UsuariosModel;
use App\Models\UsuariosAdministradoresModel;
use App\Models\CategoriasModel;
use App\Models\PublicidadesModel;
use App\Models\CategoriasSimbolosModel;
use App\Models\SimbolosItemsModel;

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
		$this->simbolosItemModel = new SimbolosItemsModel();
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

	public function get_publicidade($id)
	{
		 return $this->respond([
		 	'success' => true,
		 	'publicidade' => $this->publicidadesModel->getPublicidadeEdit($id)
		 ], 200);
	}

	public function get_categoria($id)
	{	
		 return $this->respond([
		 	'success' => true,
		 	'categoria' => $this->categoriasModel->getCategoriaEdit($id)
		 ], 200);
	}

	public function get_items_simbolos($id)
	{	
		 return $this->respond([
		 	'success' => true,
		 	'itens' => $this->simbolosItemModel->getSimboloEditItem($id)
		 ], 200);
	}

	public function logar()
	{
		$validation = \Config\Services::validation();

		$validate = $this->validate([
			'cpf'  => 'required'
		]);
		
		if(!$validate){
			$data = [
				'validate'=> $this->validator->getErrors(),
				'status'=>false,
				'message'=>'Não foi possivel fazer login, tente novamente !'
			];
	
			return $this->respond($data, 200);
		}else{
			$data = [
				'status'=>false,
				'message'=>'CPF não encontrado.'
			];

			$find = [
				'cpf'=>$this->request->getVar('cpf')
			];
		
			$entrar = $this->usuariosModel->logar($find);

			if(count($entrar) === 0){
				return $this->respond($data, 200);
			}
			
			$data = [
				'status'=>true,
				'message'=>'Login efetuado com sucesso!',
				'usuario' => $usuario
			];

			return $this->respond($session, 200);
		}
	}

	public function novo_cadastro()
	{

		$data = [];

		$validation = \Config\Services::validation();

		$validate = $this->validate([
			"email" => 'required',
			"cpf"  => 'required',	
			"empresa"  => 'required',	
			"marca_veiculo"  => 'required',
			"tipo_veiculo" => 'required',
			"nome"  => 'required',
			"telefone" => 'required'
		]);
		
		if(!$validate){
			$data = [
				'validate'=> $this->validator->getErrors(),
				'status'=>false,
				'message'=>'Não foi possivel realizar cadastro, tente novamente !'
			];
	
			return $this->respond($data, 200);
		}else{
			$usuario = [
				"email" => $this->request->getVar('email'),
				"cpf"  => $this->request->getVar('cpf'),	
				"empresa"  => $this->request->getVar('empresa'),	
				"marca_veiculo"  => $this->request->getVar('marca_veiculo'),
				"tipo_veiculo" => $this->request->getVar('tipo_veiculo'),
				"nome"  => $this->request->getVar('nome'),
				"telefone" => $this->request->getVar('telefone')
			];

			$save = $this->usuariosModel->newUsuario($usuario);

			if($save){
				$data = [
					'status'=>true,
					'message'=>'Cadastro efetuado com sucesso!'
				];
			}else{
				$data = [
					'status'=>false,
					'message'=>'Não foi possivel realizar cadastro, tente novamente !'
				];
			}
			
			return $this->respond($session, 200);
		}
	}

	public function editar_cadastro($id)
	{
		$data = [];

		$validation = \Config\Services::validation();

		$validate = $this->validate([
			"email" => 'required',
			"cpf"  => 'required',	
			"empresa"  => 'required',	
			"marca_veiculo"  => 'required',
			"tipo_veiculo" => 'required',
			"nome"  => 'required',
			"telefone" => 'required'
		]);
		
		if(!$validate){
			$data = [
				'validate'=> $this->validator->getErrors(),
				'status'=>false,
				'message'=>'Não foi possivel realizar cadastro, tente novamente !'
			];
	
			return $this->respond($data, 200);
		}else{
			$usuario = [
				"email" => $this->request->getVar('email'),
				"cpf"  => $this->request->getVar('cpf'),	
				"empresa"  => $this->request->getVar('empresa'),	
				"marca_veiculo"  => $this->request->getVar('marca_veiculo'),
				"tipo_veiculo" => $this->request->getVar('tipo_veiculo'),
				"nome"  => $this->request->getVar('nome'),
				"telefone" => $this->request->getVar('telefone')
			];

			$save = $this->usuariosModel->editUsuario($id.$usuario);

			if($save){
				$data = [
					'status'=>true,
					'message'=>'Cadastro efetuado com sucesso!'
				];
			}else{
				$data = [
					'status'=>false,
					'message'=>'Não foi possivel realizar cadastro, tente novamente !'
				];
			}
			
			return $this->respond($session, 200);
		}
	}
}