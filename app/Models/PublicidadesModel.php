<?php

namespace App\Models;

use CodeIgniter\Model;

class PublicidadesModel extends Model
{
	
	protected $table = 'publicidades';
	protected $allowedFields = [
        "imagem",
        "link",
        "cliente",
        "duracao"
    ];
	
	public function getCount()
	{
		return $this->countAll();
	}

    public function getLimit($limit, $offset)
    {
        return $this->findAll($limit, $offset);
    }

	public function getAll()
	{
		return $this->findAll();
	}

	public function newPublicidade($publicidade)
    {
        return $this->save($publicidade);
    }

    public function deletePublicidade($id)
    {   
        $this->where('id',$id);
        return $this->delete();
    }
    
    public function getPublicidadeEdit($id)
    {
        return $this->where('id', $id)->findAll();
    }
    
    public function editPublicidade($id,$data)
    {
       return $this->where('id',$id)->set($data)->update();
    }
}

