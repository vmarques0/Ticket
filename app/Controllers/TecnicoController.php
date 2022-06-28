<?php

namespace App\Controllers;

use App\Controllers\BaseController;

class TecnicoController extends BaseController
{
    public function __construct(){
        if(session()->get('role') != 'tecnico'){
            echo "Acesso negado!";
            exit;
        }
        
    }

    public function index(){
        return view("tecnico/dashboard");    
    }
}
