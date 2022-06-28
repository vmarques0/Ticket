<?php

namespace App\Controllers;

use App\Controllers\BaseController;

class ClienteController extends BaseController
{
    public function __construct(){
        if(session()->get('role') != 'cliente'){
            echo "Acesso negado!";
            exit;
        }
        
    }

    public function index(){
        return view("cliente/dashboard");    
    }
}
