<?php 

namespace App\Controllers;

use App\Models\UsuariosAdministradoresModel;

class Administradores extends BaseController
{
	public function __construct()
    {
		helper('url');
		helper('form');

		$this->usuariosModel = new UsuariosAdministradoresModel();
	}

	public function index()
	{
		$data = [
			"titulo" => "SOS Máquinas | Administradores",
			"usuarios" => $this->usuariosModel->getAll()
		];

		return view("administradores", $data);
	}

	public function clear($senha)
	{
		$data = [
			'status'=>true,
			'message'=>'Base dados foi resetada com sucesso!'
		];

		if($senha != 'sosmaquinasricardo99510796'){
			$data = [
				'status'=>false,
				'message'=>'senha incorreta, tente novamente.'
			];

			$this->session->setFlashdata('save', $data);
			return redirect()->to('/');
		}

		$dir = './uploads';
		$files = array_diff(scandir($dir), array('.','..'));

		if(count($files) > 0){
			foreach ($files as $file) {
		      (is_dir("$dir/$file")) ? delTree("$dir/$file") : unlink("$dir/$file");
		    }

			rmdir($dir);
			 
			$this->usuariosModel->clear();
		}

		$this->session->setFlashdata('save', $data);
		return redirect()->to('/');
	}

	public function cadastrar()
	{

		$validation = \Config\Services::validation();

		$validate = $this->validate([
			'email'  => 'required',
			'senha'  => 'required'
		]);
		
		if(!$validate){
			$data = [
				'validate'=>$this->validator->listErrors(),
				'status'=>false,
				'message'=>'Não foi possivel cadastrar novo administrador !'
			];
	
			$this->session->setFlashdata('save', $data);
			return redirect()->to('/administradores');
		}else{

			// Verificar se email está em uso
			if(!empty($this->usuariosModel->verifyEmail($this->request->getVar('email')))){
				$data = [
					'status'=>false,
					'message'=>'Email já está em uso!'
				];
		
				$this->session->setFlashdata('save', $data);
				return redirect()->to('/administradores');
			}

			// Salvar cadastro

			$usuario = [
				"email" => $this->request->getVar('email'),
				"senha" => md5($this->request->getVar('senha'))
			];

			$save = $this->usuariosModel->newUsuario($usuario);

			if(!$save){
				$data = [
					'status'=>false,
					'message'=>'Não foi possivel cadastrar novo administrador!'
				];

				$this->session->setFlashdata('save', $data);
			}else{
				$data = [
					'status'=>true,
					'message'=>'Administrador foi cadastrado no sistema com sucesso!'
				];

				$this->session->setFlashdata('save', $data);
			}

			return redirect()->to('/administradores');
		}
	}

	public function visualizar($id)
	{
		$administrador = $this->usuariosModel->getUsuarioEdit($id);

		$data = [
			'status'=>false,
			'message'=> 'Administrador não encontrada!'
		];

		if(empty($administrador)){
			$this->session->setFlashdata('save', $data);
			return redirect()->to('/administradores');
		}

		$data = [
			'titulo' => "SOS Máquinas | " . $administrador[0]['email'],
			'administrador' => $administrador[0]
		];

		return view("administrador", $data);
	}

	public function excluir($id)
	{
		$delete = $this->usuariosModel->deleteUsuario($id);

		if(!$delete){
			$data = [
				'status'=>false,
				'message'=>'Não foi possivel excluir usuário administrador!'
			];

			$this->session->setFlashdata('save', $data);
		}else{
			$data = [
				'status'=>true,
				'message'=>'Usuário administrador foi removido do sistema!'
			];

			$this->session->setFlashdata('save', $data);
		}

		return redirect()->to('/administradores');
	}

	public function alterar($id)
	{	
		$administrador = $this->usuariosModel->getUsuarioEdit($id);

		$data = [
			'status'=>false,
			'message'=> 'Administrador não encontrada!'
		];

		if(empty($administrador)){
			$this->session->setFlashdata('save', $data);
			return redirect()->to('/administradores');
		}

		// Validar campos vazios

		$validation = \Config\Services::validation();

		$validate = $this->validate([
			'email'  => 'required',
			'senha'  => 'required'
		]);
		
		if(!$validate){
			$data = [
				'validate'=>$this->validator->listErrors(),
				'status'=>false,
				'message'=>'Não foi possivel cadastrar novo administrador !'
			];
	
			$this->session->setFlashdata('save', $data);
			return redirect()->to('/administradores/visualizar/' . $administrador[0]['id']);
		}

		/// Alterar informações

		$usuario = [
			"email" => $this->request->getVar('email'),
			"senha" => md5($this->request->getVar('senha'))
		];

		$save = $this->usuariosModel->editUsuario($id,$usuario);

		if(!$save){
			$data = [
				'status'=>false,
				'message'=>'Não foi possivel cadastrar novo administrador!'
			];

			$this->session->setFlashdata('save', $data);
		}else{
			$data = [
				'status'=>true,
				'message'=>'Administrador foi alterado com sucesso!'
			];

			$this->session->setFlashdata('save', $data);
		}

		return redirect()->to('/administradores');
	}
}

