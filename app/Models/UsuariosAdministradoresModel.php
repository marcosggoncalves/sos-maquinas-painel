<?php 

namespace App\Models;

use CodeIgniter\Model;

class UsuariosAdministradoresModel extends Model
{
	protected $table = 'usuarios_admin';
	
	protected $allowedFields = [
		"email",
		"senha",
        "ultimo_acesso"
	];
	
	public function getCount()
	{
		return $this->countAll();
	}

	public function getAll()
	{
		return $this->orderBy('id','desc')->findAll();
	}

	public function newUsuario($usuario)
    {
        return $this->save($usuario);
    }

    public function deleteUsuario($id)
    {   
        $this->where('id',$id);
        return $this->delete();
    }
    
    public function getUsuarioEdit($id)
    {
        return $this->where('id', $id)->findAll();
    }

    public function verifyEmail($email)
    {
        return $this->where('email', $email)->first();
    }
    
    public function editUsuario($id,$data)
    {
       return $this->where('id',$id)->set($data)->update();
    }

    public function clear()
    {
        $this->db->query('delete from usuarios');
        $this->db->query('delete from publicidades');
        $this->db->query('delete from categorias');
        $this->db->query('delete from categorias_simbolos');
        $this->db->query('delete from atualizacoes');
        return $this->db->query('delete from simbolos_items');
    }

    public function logar($find)
    {
        $this->where($find);
        return $this->findAll();
    }

    public function ultimoAcesso($id)
    {
        $this->db->table('usuarios_admin')
            ->set([
                "ultimo_acesso " =>  date("Y-m-d H:i:s")
            ])
            ->where('id =', $id)
            ->update();
    }

    public function atualizacao()
    {
        $data = [
            'pendente' => $this->db->table('atualizacoes')->where('status =', 'Pendente')->countAllResults(),
            'atualizacao' => $this->db
                ->table('atualizacoes')
                ->limit(0,1)
                ->where('status', 'Pendente')
                ->orderBy('id', 'DESC')
                ->get()
                ->getResult()
        ];

        return $data;
    }

    public function agendarAtualizacao($cadastroID)
    {
        $verifySincronizacao = $this->db->table('atualizacoes')
                                ->where('atualizacao >=', date("Y-m-d H:i:s"))
                                ->where('status =', 'Pendente')
                                ->orderBy('id', 'DESC')
                                ->get()
                                ->getResult();

        if(empty($verifySincronizacao)){
            $this->db->table('atualizacoes')->insert([
                'usuarios_admin_id' => $cadastroID
            ]);
        }
    }
}