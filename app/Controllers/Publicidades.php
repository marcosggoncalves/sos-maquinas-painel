<?php 

namespace App\Controllers;

use App\Models\PublicidadesModel;
use App\Models\SicronizacaoModel;

class publicidades extends BaseController
{
	public function __construct()
    {
		helper('url');
		helper('form');

		$this->publicidadesModel = new PublicidadesModel();
		$this->sicronizacaoModel  = new SicronizacaoModel();
	}

	public function index()
	{
		$pager = \Config\Services::pager();

		$data = [
			'titulo' => 'SOS Máquinas | Publicidades',
			'publicidades' => $this->publicidadesModel->paginate(15),
			'pager' => $this->publicidadesModel->pager
		];

		return view('publicidades', $data);
	}

	public function visualizar($id)
	{
		$publicidade = $this->publicidadesModel->getPublicidadeEdit($id);

		$data = [
			'status'=>false,
			'message'=> 'Publicidade não encontrada!'
		];

		if(empty($publicidade)){
			$this->session->setFlashdata('save', $data);
			return redirect()->to('/publicidades');
		}

		$data = [
			'titulo' => "SOS Máquinas | " . $publicidade[0]['link'],
			'publicidade' => $publicidade[0]
		];

		return view('publicidade', $data);
	}

	public function cadastrar()
	{

		$validation = \Config\Services::validation();

		$validate = $this->validate([
			'cliente'  => 'required',
			'duracao'  => 'required',
			'link'  => 'required',
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
				'message'=>'Não foi possivel cadastrar nova categoria!'
			];
	
			$this->session->setFlashdata('save', $data);
			return redirect()->to('/publicidades');
		}else{
			$Img = $this->request->getFile('imagem');
			$newName = $Img->getRandomName();
			$Img->move('uploads',$newName);
			
			$data = [
				'status'=>false,
				'message'=>'Não foi possivel cadastrar nova publicidade!'
			];
			
			$publicidade = [
				'imagem' => 'uploads/'.$Img->getName(),
				'cliente' => $this->request->getVar('cliente'),
				'duracao' => $this->request->getVar('duracao'),
				'link' => $this->request->getVar('link'),
			];

			$save = $this->publicidadesModel->newPublicidade($publicidade);

			if($save){
				$data['message'] = "Publicidade cadastrada com sucesso!";
				$data['status'] = true;
			}

			$this->sicronizacaoModel->agendarAtualizacao($this->session->get('login')['user'][0]['id']);
			$this->session->setFlashdata('save', $data);
			return redirect()->to('/publicidades');
		} 
	}

	public function excluir($id)
	{
		$publicidade = $this->publicidadesModel->getPublicidadeEdit($id);

		$data = [
			'status'=>false,
			'message'=>'Não foi possivel excluir publicidade!'
		];

		if(empty($publicidade)){
			$this->session->setFlashdata('save', $data);
			return redirect()->to('/publicidades');
		}

		if(file_exists($publicidade[0]['imagem'])){
			$excluirFile = unlink($publicidade[0]['imagem']);
	
			if($excluirFile){
				$data['message'] = "Publicidade foi excluida com sucesso.";
				$data['status'] = true;
			}
		}

		$this->publicidadesModel->deletePublicidade($id);
		$this->sicronizacaoModel->agendarAtualizacao($this->session->get('login')['user'][0]['id']);
		$this->session->setFlashdata('save', $data);
		return redirect()->to('/publicidades');
	}

	public function alterar($id)
	{
		$publicidade = $this->publicidadesModel->getPublicidadeEdit($id);

		$validate = $this->validate([
			'cliente'  => 'required',
			'duracao'  => 'required',
			'link'  => 'required'
		]);
		
		if(!$validate){
			$data = [
				'validate'=>$this->validator->listErrors(),
				'status'=>false,
				'message'=>'Não foi possivel alterar informações da publicidade, tente novamente!'
			];
	
			$this->session->setFlashdata('save', $data);
			return redirect()->to('/publicidades/visualizar/' . $publicidade[0]['id']);
		}

		$publicidadeEdit = [
			'cliente' => $this->request->getVar('cliente'),
			'duracao' => $this->request->getVar('duracao'),
			'link' => $this->request->getVar('link'),
		];

		$publicidadeImagem = $this->request->getFile('imagem');

		if($publicidadeImagem != ""){

			$data = [
				'status'=>false,
				'message'=>'Não foi possivel alterar publicidade !'
			];

			if(file_exists($publicidade[0]['imagem'])){
				$excluirFile = unlink($publicidade[0]['imagem']);
		
				if(!$excluirFile){
					$this->session->setFlashdata('save', $data);
					return redirect()->to('/publicidades');
				}
			}

			$newName = $publicidadeImagem->getRandomName();
			$publicidadeImagem->move('uploads',$newName);
			$publicidadeEdit['imagem'] =  'uploads/'.$publicidadeImagem->getName();
		}

		$savedit = $this->publicidadesModel->editPublicidade($id,$publicidadeEdit);

		if($savedit){
			$data['message'] = "Publicidade alterada com sucesso!";
			$data['status'] = true;
		}
		
		$this->sicronizacaoModel->agendarAtualizacao($this->session->get('login')['user'][0]['id']);
		$this->session->setFlashdata('save', $data);
		return redirect()->to('/publicidades');
	}
}
