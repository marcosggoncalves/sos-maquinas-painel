<?php 

namespace App\Models;

use CodeIgniter\Model;

class SicronizacaoModel extends Model
{
	protected $table = 'atualizacoes';
	
    public function getAtualizacoes()
    {
        return $this->db->table('atualizacoes')
            ->join('usuarios_admin', 'atualizacoes.usuarios_admin_id = usuarios_admin.id')
            ->get()
            ->getResult('array'); 
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
                                ->where('atualizacao >', date("Y-m-d H:i:s"))
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

    public function concluirAtualizacao()
    {
        $verifySincronizacao = $this->db->table('atualizacoes')
                                ->where('status =', 'Pendente')
                                ->orderBy('id', 'DESC')
                                ->get()
                                ->getResult();
        
        if(empty($verifySincronizacao)){
            return [
                "status" => false,
                "message" => "Não há atualizações no momento!"
            ];
        }

        if(date("Y-m-d H:i:s") >= $verifySincronizacao[0]->atualizacao){
            $status = $this->db->table('atualizacoes')
            ->set([
                "realizado" =>  date("Y-m-d H:i:s"),
                "status" => "Concluido"
            ])
            ->where('status =', 'Pendente')
            ->orderBy('id', 'DESC')
            ->update();

            return  [
                "status" => $status,
                "message" => $status ? 'Sincronização realizada com sucesso!': 'Não foi possivel realizar sincronização, tente novamente !'
            ];
        }
        
        return  [
            "status" => true,
            "message" => "Sincronização realizada com sucesso!"
        ];
    }
}