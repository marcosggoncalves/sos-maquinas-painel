<?php namespace App\Filters;

use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use CodeIgniter\Filters\FilterInterface;

class Auth implements FilterInterface
{
    public function before(RequestInterface $request, $arguments = null)
    {
        $this->session = \Config\Services::session();
        
        $data = [
            'status'=>false,
            'message'=> 'Nenhuma sessão encontrada!'
        ];

        if ($this->session->get('login')['logado'] != 1){
            $this->session->setFlashdata('save', $data);
            return redirect()->to('/login');
        }
    }

    //--------------------------------------------------------------------

    public function after(RequestInterface $request, ResponseInterface $response, $arguments = null)
    {
        // Do something here
    }
}