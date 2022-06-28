<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

use App\Models\UserModel;

class UserSeeder extends Seeder
{
    public function run()
    {
        $user_object = new UserModel();
        $user_object->insertBatch([
            [
                "name" => "José da Silva",
                "email" => "jose@ticket.com",
                "phone" => "5535999991234",
                "role" => "admin",
                "password" => password_hash("123", PASSWORD_DEFAULT)
            ],

            [
                "name" => "João de Souza",
                "email" => "joao@ticket.com",
                "phone" => "5535988884321",
                "role" => "tecnico",
                "password" => password_hash("321", PASSWORD_DEFAULT)
            ],

            [
                "name" => "Rubens da Silva",
                "email" => "rubens@ticket.com",
                "phone" => "5535988884321",
                "role" => "cliente",
                "password" => password_hash("123", PASSWORD_DEFAULT)
            ],
        ]);
    }
}
