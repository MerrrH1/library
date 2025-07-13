<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\UserModel;
use CodeIgniter\HTTP\ResponseInterface;

class UserController extends BaseController
{
    public function login()
    {
        $data = [];
        return view('auth/login', $data);
    }

    public function processLogin()
    {
        $rules = [
            'username' => 'required|min_length[3]',
            'password' => 'required|min_length[6]'
        ];
        
        if ($this->validate($rules)) {
            $userModel = new UserModel();
            $username = $this->request->getVar('username');
            $password = $this->request->getVar('password');
            
            $user = $userModel->getUserByUsername($username);
            
            $currentURI = $this->request->getUri();
            $path = $currentURI->getPath();
            log_message('info', 'Form disubmit ke path: ' . $path);
            if ($user) {
                if (password_verify($password, $user['password'])) {
                    $session_data = [
                        'user_id' => $user['id'],
                        'username' => $user['username'],
                        'name' => $user['name'],
                        'isLoggedIn' => true
                    ];
                    session()->set($session_data);
                    return redirect()->to('/');
                } else {
                    session()->setFlashdata('error', 'Username atau Password salah!');
                    return redirect()->to('/login')->withInput();
                }
            } else {
                session()->setFlashdata('error', 'Username tidak terdaftar!');
                return redirect()->to('/login')->withInput();
            }
        } else {
            $data['validation'] = $this->validator;
            echo view('auth/login', $data);
        }
    }

    public function logout() {
        session()->destroy();
        return redirect()->to('/login');
    }

    // --- New Registration Methods ---

    public function register()
    {
        $data = [];
        return view('auth/register', $data);
    }

    public function processRegister()
    {
        $rules = [
            'name' => 'required|min_length[3]',
            'username' => 'required|min_length[3]|is_unique[users.username]',
            'password' => 'required|min_length[6]',
            'confirm_password' => 'required|matches[password]'
        ];

        if ($this->validate($rules)) {
            $userModel = new UserModel();
            $data = [
                'name' => $this->request->getVar('name'),
                'username' => $this->request->getVar('username'),
                'email' => $this->request->getVar('email'),
                'password' => password_hash($this->request->getVar('password'), PASSWORD_DEFAULT),
            ];

            $userModel->save($data); // Save the new user to the database

            session()->setFlashdata('success', 'Akun berhasil dibuat! Silakan login.');
            return redirect()->to('/login');
        } else {
            $data['validation'] = $this->validator;
            echo view('auth/register', $data);
        }
    }
}