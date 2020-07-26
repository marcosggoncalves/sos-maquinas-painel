<?php 

namespace App\Controllers;

use App\Models\AnunciosModel;
use App\Models\SicronizacaoModel;

class Anuncios extends BaseController
{
	public function __construct()
    {
		helper('url');
		helper('form');

		$this->anunciosModel = new anunciosModel();
		$this->sicronizacaoModel  = new SicronizacaoModel();
	}

	public function index()
	{
		$pager = \Config\Services::pager();

		$data = [
			'titulo' => 'SOS Máquinas | Anuncios',
			'publicidades' => $this->anunciosModel->orderBy('id',' desc')->paginate(15),
			'pager' => $this->anunciosModel->pager
		];

		return view('anuncios', $data);
	}

	public function visualizar($id)
	{
		$publicidade = $this->anunciosModel->getPublicidadeEdit($id);

		$data = [
			'status'=>false,
			'message'=> 'Publicidade não encontrada!'
		];

		if(empty($publicidade)){
			$this->session->setFlashdata('save', $data);
			return redirect()->to('/anuncios');
		}

		$data = [
			'titulo' => "SOS Máquinas | " . $publicidade[0]['link'],
			'publicidade' => $publicidade[0]
		];

		return view('anuncio', $data);
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
			return redirect()->to('/anuncios');
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

			$save = $this->anunciosModel->newPublicidade($publicidade);

			if($save){
				$data['message'] = "Publicidade cadastrada com sucesso!";
				$data['status'] = true;
			}

			$this->sicronizacaoModel->agendarAtualizacao($this->session->get('login')['user'][0]['id']);
			$this->session->setFlashdata('save', $data);
			return redirect()->to('/anuncios');
		} 
	}

	public function excluir($id)
	{
		$publicidade = $this->anunciosModel->getPublicidadeEdit($id);

		$data = [
			'status'=>false,
			'message'=>'Publicidade foi excluida com sucesso, porém não encontramos há imagem!'
		];

		if(empty($publicidade)){
			$this->session->setFlashdata('save', $data);
			return redirect()->to('/anuncios');
		}

		if(file_exists($publicidade[0]['imagem'])){
			$excluirFile = unlink($publicidade[0]['imagem']);
	
			if($excluirFile){
				$data['message'] = "Publicidade foi excluida com sucesso.";
				$data['status'] = true;
			}
		}

		$this->anunciosModel->deletePublicidade($id);
		$this->sicronizacaoModel->agendarAtualizacao($this->session->get('login')['user'][0]['id']);
		$this->session->setFlashdata('save', $data);
		return redirect()->to('/anuncios');
	}

	public function alterar($id)
	{
		$publicidade = $this->anunciosModel->getPublicidadeEdit($id);

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
			return redirect()->to('/anuncios/visualizar/' . $publicidade[0]['id']);
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
					return redirect()->to('/anuncios');
				}
			}

			$newName = $publicidadeImagem->getRandomName();
			$publicidadeImagem->move('uploads',$newName);
			$publicidadeEdit['imagem'] =  'uploads/'.$publicidadeImagem->getName();
		}

		$savedit = $this->anunciosModel->editPublicidade($id,$publicidadeEdit);

		if($savedit){
			$data['message'] = "Publicidade alterada com sucesso!";
			$data['status'] = true;
		}
		
		$this->sicronizacaoModel->agendarAtualizacao($this->session->get('login')['user'][0]['id']);
		$this->session->setFlashdata('save', $data);
		return redirect()->to('/anuncios');
	}
}
