<?php

namespace App\Models;

use CodeIgniter\Model;

class CategoriasSimbolosModel extends Model
{
	
	protected $table = 'categorias_simbolos';

	protected $allowedFields = [
		'descricao',
		'imagem',
		'titulo',
		'categoria_id'
	];

	public function getCount()
	{
		return $this->countAll();
	}

	public function getAll()
	{	
		return $this->db->table('categorias_simbolos')
			->select("categorias_simbolos.id, categorias_simbolos.titulo, categorias_simbolos.imagem, categorias_simbolos.descricao, categorias_simbolos.categoria_id, categorias.categoria")
			->join('categorias', 'categorias.id = categoria_id')
			->get()
			->getResult('array');  
	}

	public function newSimbolo($simbolo)
    {
        return $this->save($simbolo);
    }

    public function deleteSimbolo($id)
    {   
        $this->where('id',$id);
        return $this->delete();
    }
    
    public function getSimboloEdit($id)
    {
        return $this->where('id', $id)->findAll();
    }
    
    public function editSimbolo($id,$data)
    {
       return $this->where('id',$id)->set($data)->update();
    }
}

