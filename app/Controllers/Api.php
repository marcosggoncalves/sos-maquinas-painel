<?php 

namespace App\Controllers;

use App\Models\UsuariosModel;
use App\Models\UsuariosAdministradoresModel;
use App\Models\CategoriasModel;
use App\Models\AnunciosModel;
use App\Models\CategoriasSimbolosModel;
use App\Models\SimbolosItemsModel;
use App\Models\SicronizacaoModel;

use CodeIgniter\RESTful\ResourceController;

class Api extends ResourceController
{	
	public function __construct()
    {
		$this->usuariosModel = new UsuariosModel();
		$this->usuariosAdminModel = new UsuariosAdministradoresModel();
		$this->anunciosModel = new AnunciosModel();
		$this->categoriasModel = new CategoriasModel();
		$this->categoriasSimbolosModel = new CategoriasSimbolosModel();
		$this->simbolosItemModel = new SimbolosItemsModel();
		$this->sicronizacaoModel  = new SicronizacaoModel();
	}

	public function data()
	{
		$data = [
			'success' => true,
			'publicidades' => $this->anunciosModel->getSQLInserts(),
			'categorias' => $this->categoriasModel->getSQLInserts(),
			'simbolos' => $this->categoriasSimbolosModel->getSQLInserts(),
			'simbolosItens' => $this->simbolosItemModel->getSQLInserts()
		];

		 return $this->respond($data, 200);
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
				'usuario' => $entrar[0]
			];

			return $this->respond($data, 200);
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
			
			return $this->respond($data, 200);
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

			$save = $this->usuariosModel->editUsuario($id,$usuario);

			if($save){
				$data = [
					'status'=>true,
					'message'=>'Cadastro alterado com sucesso!',
					'usuario' => $this->usuariosModel->get($id)
				];
			}else{
				$data = [
					'status'=>false,
					'message'=>'Não foi possivel realizar cadastro, tente novamente !'
				];
			}
			
			return $this->respond($data, 200);
		}
	}

	public function sincronizar()
	{
		$sincronizar = $this->sicronizacaoModel->concluirAtualizacao();

		return $this->respond($sincronizar, 200);
	}
}