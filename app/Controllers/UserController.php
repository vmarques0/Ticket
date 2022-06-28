<?php

namespace App\Controllers;

use App\Controllers\BaseController;

use App\Models\UserModel;

class UserController extends BaseController
{    

    public function login()
    {
        $data = [];

        if($this->request->getMethod() === 'post'){
            $rules = [
                'email' => 'required|min_length[6]|max_length[120]|valid_email',
                'password' => 'required|max_length[255]|validateUser[email, password]',
            ];

            $errors = [
                'password' => [
                    'validateUser' => "Email e senha não conferem!",
                ],
            ];

            if(!$this->validate($rules, $errors)){
                return view('login', ['validation' => $this->validator]);
            }
            else{
                $model = new UserModel();
                $user = $model->where('email', $this->request->getVar('email'))->first();
                $this->setUserSession($user);

                if($user['role'] == 'admin'){
                    return redirect()->to(base_url('admin'));
                }
                if($user['role'] == 'tecnico'){
                    return redirect()->to(base_url('tecnico'));
                }
                if($user['role'] == 'cliente'){
                    return redirect()->to(base_url('cliente'));
                }
            }
            return view('login');
        }
    }

    private function setUserSession($user){
        $data = [
            'id' => $user['id'],
            'name' => $user['name'],
            'phone' => $user['phone'],
            'email' => $user['email'],
            'isLoggedIn' => true,
            'role' => $user['role'],
        ];

        session()->set($data);
        return true;
    }

    public function logout(){
        session()->destroy();
        return view('login');
    }

    public function register(){
        $name     = $this->form_validation->set_rules("name", "Name", "required|trim");
        $email    = $this->form_validation->set_rules("email", "Email", "required|trim");
        $phone = $this->form_validation->set_rules("phone", "Phone", "required|trim");
        $role = $this->form_validation->set_rules("role", "Role", "required|trim");
        $password = $this->form_validation->set_rules("password", "Password", "required|trim");

        if($this->form_validation->run() == TRUE){
            $name = $this->input->post("name");
            $email = $this->input->post("email");
            $phone = $this->input->post("telefone");
            $password = md5($this->input->post("password"));
            $confirm = md5($this->input->post("confirm"));

            $check = $this->register_model->usernameCheck($name, $email);

            if($check == 1){
                redirect(base_url("register"));
            }
            else{

                if($password != $confirm){
                        redirect(base_url("register"));
                    }
                else{
                    $this->register_model->userInsert(array(
                        "name"     => $name,
                        "email" => $email,
                        "phone" => $phone,
                        "role" => $role,
                        "password"     => $password,
                    ));
                }
                redirect(base_url("login"));
            }
        }
        else{
            redirect(base_url("register"));
        }
    }
}
