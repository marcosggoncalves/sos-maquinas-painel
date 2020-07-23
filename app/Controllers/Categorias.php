<?php 

namespace App\Controllers;

use App\Models\CategoriasModel;

class Categorias extends BaseController
{
	public function __construct()
    {
		helper('url');
		helper('form');

		$this->categoriasModel = new CategoriasModel();
	}

	public function index()
	{
		$data = [
			'titulo' => 'SOS Máquinas | Categorias',
			'categorias' => $this->categoriasModel->getAll()
		];

		return view('categorias', $data);
	}

	public function visualizar($id)
	{
		$categoria = $this->categoriasModel->getCategoriaEdit($id);

		$data = [
			'status'=>false,
			'message'=> 'Categoria não encontrada!'
		];

		if(empty($categoria)){
			$this->session->setFlashdata('save', $data);
			return redirect()->to('/categorias');
		}

		$data = [
			'titulo' => "SOS Máquinas | " . $categoria[0]['categoria'],
			'categoria' => $categoria[0]
		];

		return view('categoria', $data);
	}

	public function cadastrar()
	{

		$validation = \Config\Services::validation();

		$validate = $this->validate([
			'categoria'  => 'required',
			'file' => [
                'uploaded[file]',
                'mime_in[file,image/jpg,image/jpeg,image/gif,image/png]',
                'max_size[file,7096]'
            ],
		]);

		
		if(!$validate){
			$data = [
				'validate'=>$this->validator->listErrors(),
				'status'=>false,
				'message'=>'Não foi possivel cadastrar nova categoria!'
			];
	
			$this->session->setFlashdata('save', $data);
			return redirect()->to('/categorias');
		}else{
			$Img = $this->request->getFile('file');
			$newName = $Img->getRandomName();
			$Img->move('uploads',$newName);
			
			$data = [
				'status'=>false,
				'message'=>'Não foi possivel cadastrar nova categoria!'
			];
			
			$categoria = [
				'imagem' => 'uploads/'.$Img->getName(),
				'categoria' => $this->request->getVar('categoria')
			];
			
			$save = $this->categoriasModel->newCategoria($categoria);

			if($save){
				$data['message'] = "Nova categoria cadastrada com sucesso!";
				$data['status'] = true;
			}

			$this->session->setFlashdata('save', $data);
			return redirect()->to('/categorias');
		} 
	}

	public function excluir($id)
	{
		$categoria = $this->categoriasModel->getCategoriaEdit($id);

		$data = [
			'status'=>false,
			'message'=>'Não foi possivel excluir categoria!'
		];

		if(empty($categoria)){
			$this->session->setFlashdata('save', $data);
			return redirect()->to('/categorias');
		}

		if(file_exists($categoria[0]['imagem'])){
			$excluirFile = unlink($categoria[0]['imagem']);
	
			if($excluirFile){
				$data['message'] = "Categoria excluida com sucesso.";
				$data['status'] = true;
			}
		}

		$this->categoriasModel->deleteCategoria($id);
		$this->session->setFlashdata('save', $data);
		return redirect()->to('/categorias');
	}

	public function alterar($id)
	{
		$categoria = $this->categoriasModel->getCategoriaEdit($id);

		$validate = $this->validate([
			"categoria"  => "required"
		]);
		
		if(!$validate){
			$data = [
				'validate'=>$this->validator->listErrors(),
				'status'=>false,
				'message'=>'Não foi possivel alterar informações da categoria, tente novamente!'
			];
	
			$this->session->setFlashdata('save', $data);
			return redirect()->to('/categorias');
		}

		$categoriaEdit = [
			'categoria' => $this->request->getVar('categoria')
		];

		$categoriaImagem = $this->request->getFile('imagem');

		if($categoriaImagem != ""){

			$data = [
				'status'=>false,
				'message'=>'Não foi possivel alterar categoria !'
			];

			if(file_exists($categoria[0]['imagem'])){
				$excluirFile = unlink($categoria[0]['imagem']);
		
				if(!$excluirFile){
					$this->session->setFlashdata('save', $data);
					return redirect()->to('/categorias');
				}
			}

			$newName = $categoriaImagem->getRandomName();
			$categoriaImagem->move('uploads',$newName);
			$categoriaEdit['imagem'] =  'uploads/'.$categoriaImagem->getName();
		}

		$savedit = $this->categoriasModel->editCategoria($id,$categoriaEdit);

		if($savedit){
			$data['message'] = "Categoria alterada com sucesso!";
			$data['status'] = true;
		}

		$this->session->setFlashdata('save', $data);
		return redirect()->to('/categorias');
	}
}
