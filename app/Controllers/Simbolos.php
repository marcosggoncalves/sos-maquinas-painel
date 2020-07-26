<?php 

namespace App\Controllers;

use App\Models\CategoriasSimbolosModel;
use App\Models\SimbolosItemsModel;
use App\Models\CategoriasModel;
use App\Models\SicronizacaoModel;

class Simbolos extends BaseController
{
	public function __construct()
    {
		helper('url');
		helper('form');

		$this->simbolosModel = new CategoriasSimbolosModel();
		$this->categoriasModel = new CategoriasModel();
		$this->simbolosItemModel = new SimbolosItemsModel();
		$this->sicronizacaoModel  = new SicronizacaoModel();

	}

	public function index()
	{
		$pager = \Config\Services::pager();

		$data = [
			'titulo' => 'SOS Máquinas | Simbolos',
			'simbolos' => $this->simbolosModel->getAll()->paginate(15),
			'categorias' => $this->categoriasModel->getAll(),
			'pager' => $this->simbolosModel->pager
		];

		return view('simbolos', $data);
	}

	public function visualizar($id)
	{	
		$pager = \Config\Services::pager();

		$simbolo = $this->simbolosModel->getSimboloEdit($id);

		$data = [
			'status'=>false,
			'message'=> 'Simbolo não encontrada!'
		];
 
		if(empty($simbolo)){
			$this->session->setFlashdata('save', $data);
			return redirect()->to('/simbolos');
		}

		$data = [
			'titulo' => "SOS Máquinas | " . $simbolo[0]['titulo'],
			'simbolo' => $simbolo[0],
			'categorias' => $this->categoriasModel->getAll(),
			'itens' => $this->simbolosItemModel->orderBy('id',' desc')->paginate(15),
			'pager' => $this->simbolosItemModel->pager
		];

		return view('simbolo', $data);
	}

	public function cadastrar()
	{

		$validation = \Config\Services::validation();

		$validate = $this->validate([
			'titulo'  => 'required',
			'descricao'  => 'required',
			'imagem' => [
                'uploaded[imagem]',
                'mime_in[imagem,image/jpg,image/jpeg,image/gif,image/png]',
                'max_size[imagem,7096]'
            ],
		]);

		
		if(!$validate){
			$data = [
				'validate'=>$this->validator->listErrors(),
				'status'=>false,
				'message'=>'Não foi possivel cadastrar novo simbolo!'
			];
	
			$this->session->setFlashdata('save', $data);
			return redirect()->to('/simbolos');
		}else{
			$Img = $this->request->getFile('imagem');
			$newName = $Img->getRandomName();
			$Img->move('uploads',$newName);
			
			$data = [
				'status'=>false,
				'message'=>'Não foi possivel cadastrar nova categoria!'
			];
			
			$simbolo = [
				'imagem' => 'uploads/'.$Img->getName(),
				'titulo' => $this->request->getVar('titulo'),
				'descricao' => $this->request->getVar('descricao'),
				'categoria_id' => $this->request->getVar('categoria_id'),
			];
			
			$save = $this->simbolosModel->newSimbolo($simbolo);

			if($save){
				$data['message'] = "Novo simbolo cadastrado com sucesso!";
				$data['status'] = true;
			}

			$this->sicronizacaoModel->agendarAtualizacao($this->session->get('login')['user'][0]['id']);
			$this->session->setFlashdata('save', $data);
			return redirect()->to('/simbolos');
		} 
	}

	public function excluir($id)
	{
		$simbolo = $this->simbolosModel->getSimboloEdit($id);

		$data = [
			'status'=>false,
			'message'=>'Simbolo foi excluido com sucesso, porém não encontramos há imagem!'
		];

		if(empty($simbolo)){
			$this->session->setFlashdata('save', $data);
			return redirect()->to('/simbolos');
		}

		if(file_exists($simbolo[0]['imagem'])){
			$excluirFile = unlink($simbolo[0]['imagem']);
	
			if($excluirFile){
				$data['message'] = "Simbolo excluido com sucesso.";
				$data['status'] = true;
			}
		}

		$this->simbolosModel->deleteSimbolo($id);
		$this->sicronizacaoModel->agendarAtualizacao($this->session->get('login')['user'][0]['id']);
		$this->session->setFlashdata('save', $data);
		return redirect()->to('/simbolos');
	}

	public function alterar($id)
	{
		$simbolo = $this->simbolosModel->getSimboloEdit($id);

		$validate = $this->validate([
			'titulo'  => 'required',
			'descricao'  => 'required'
		]);
		
		if(!$validate){
			$data = [
				'validate'=>$this->validator->listErrors(),
				'status'=>false,
				'message'=>'Não foi possivel alterar informações da simbolo, tente novamente!'
			];
	
			$this->session->setFlashdata('save', $data);
			return redirect()->to('/simbolos/visualizar/' . $simbolo['id']);
		}

		$simboloEdit = [
			'titulo' => $this->request->getVar('titulo'),
			'descricao' => $this->request->getVar('descricao'),
			'categoria_id' => $this->request->getVar('categoria_id'),
		];

		$simboloImagem = $this->request->getFile('imagem');

		if($simboloImagem != ""){

			$data = [
				'status'=>false,
				'message'=>'Não foi possivel alterar simbolo !'
			];

			if(file_exists($simbolo[0]['imagem'])){
				$excluirFile = unlink($simbolo[0]['imagem']);
		
				if(!$excluirFile){
					$this->session->setFlashdata('save', $data);
					return redirect()->to('/simbolos/visualizar/' . $simbolo['id']);
				}
			}

			$newName = $simboloImagem->getRandomName();
			$simboloImagem->move('uploads',$newName);
			$simboloEdit['imagem'] =  'uploads/'.$simboloImagem->getName();
		}

		$savedit = $this->simbolosModel->editSimbolo($id,$simboloEdit);

		if($savedit){
			$data['message'] = "Simbolo alterado com sucesso!";
			$data['status'] = true;
		}

		$this->sicronizacaoModel->agendarAtualizacao($this->session->get('login')['user'][0]['id']);
		$this->session->setFlashdata('save', $data);
		return redirect()->to('/simbolos');
	}

	// Adicionar, excluir e alterar causas e soluções dos simbolos

	public function itemCadastrar($id)
	{
		$validation = \Config\Services::validation();

		$validate = $this->validate([
			'categoria_simbolo_id'  => 'required',
			'tipo'  => 'required',
			'descricao'  => 'required'
		]);
		
		if(!$validate){
			$data = [
				'validate'=>$this->validator->listErrors(),
				'status'=>false,
				'message'=>'Não foi possivel cadastrar novo item !'
			];
	
			$this->session->setFlashdata('save', $data);
			return redirect()->to("/simbolos/visualizar/" . $id);
		}else{
			// Salvar item

			$simbolo = [
				'categoria_simbolo_id'  => $this->request->getVar('categoria_simbolo_id'),
				'tipo'  => $this->request->getVar('tipo'),
				'descricao'  => $this->request->getVar('descricao')
			];

			$save = $this->simbolosItemModel->newSimboloItem($simbolo);

			if(!$save){
				$data = [
					'status'=>false,
					'message'=>'Não foi possivel cadastrar novo item!'
				];

				$this->session->setFlashdata('save', $data);
			}else{
				$data = [
					'status'=>true,
					'message'=>'Item foi cadastrado com sucesso!'
				];

				$this->session->setFlashdata('save', $data);
			}

			$this->sicronizacaoModel->agendarAtualizacao($this->session->get('login')['user'][0]['id']);
			return redirect()->to("/simbolos/visualizar/" . $id);
		}
	}

	public function itemExcluir($id,$categoria_id)
	{
		$delete = $this->simbolosItemModel->deleteSimboloItem($id);

		if(!$delete){
			$data = [
				'status'=>false,
				'message'=>'Não foi possivel excluir item!'
			];

			$this->session->setFlashdata('save', $data);
		}else{
			$data = [
				'status'=>true,
				'message'=>'Item foi removido do sistema!'
			];

			$this->session->setFlashdata('save', $data);
		}

		$this->sicronizacaoModel->agendarAtualizacao($this->session->get('login')['user'][0]['id']);
		return redirect()->to('/simbolos/visualizar/'.$categoria_id);
	}

	public function itemAlterar($id)
	{

		$itemSimbolo = $this->simbolosItemModel->getSimboloEditItem($id);

		$data = [
			'status'=>false,
			'message'=> 'Item não encontrada!'
		];

		if(empty($itemSimbolo)){
			$this->session->setFlashdata('save', $data);
			return redirect()->to('/simbolos');
		}

		$validation = \Config\Services::validation();

		$validate = $this->validate([
			'idSimbolo'  => 'required',
			'tipoList'  => 'required',
			'descSimbolo'  => 'required'
		]);
		
		if(!$validate){
			$data = [
				'validate'=>$this->validator->listErrors(),
				'status'=>false,
				'message'=>'Não foi possivel cadastrar novo item !'
			];
	
			$this->session->setFlashdata('save', $data);
			return redirect()->to("/simbolos/visualizar/" . $itemSimbolo[0]['categoria_simbolo_id']);
		}else{
			// Alterar item

			$simbolo = [
				'categoria_simbolo_id'  => $this->request->getVar('idSimbolo'),
				'tipo'  => $this->request->getVar('tipoList'),
				'descricao'  => $this->request->getVar('descSimbolo')
			];

			$save = $this->simbolosItemModel->editSimboloItem($id,$simbolo);

			if(!$save){
				$data = [
					'status'=>false,
					'message'=>'Não foi possivel alterar item!'
				];

				$this->session->setFlashdata('save', $data);
			}else{
				$data = [
					'status'=>true,
					'message'=>'Item foi alterado com sucesso!'
				];

				$this->session->setFlashdata('save', $data);
			}

			$this->sicronizacaoModel->agendarAtualizacao($this->session->get('login')['user'][0]['id']);
			return redirect()->to("/simbolos/visualizar/" . $itemSimbolo[0]['categoria_simbolo_id']);
		}
	}
}