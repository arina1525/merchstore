<?php

namespace App\Controllers;

use App\Models\UserModel;

class Auth extends BaseController
{
    public function login()
    {
        return view('auth/login');
    }

    public function register()
    {
        return view('auth/register');
    }

    public function logout()
    {
        session()->destroy();

        return redirect()->to('/');
    }

    public function saveRegister()
    {
        $userModel = new UserModel();

        $userModel->save([
            'name' => $this->request->getPost('name'),
            'email' => $this->request->getPost('email'),

            'password' => password_hash(
                $this->request->getPost('password'),
                PASSWORD_DEFAULT
            ),

            'role' => 'customer'
        ]);

        return redirect()->to('/login');
    }

    public function checkLogin()
    {
        $userModel = new UserModel();

        $email = $this->request->getPost('email');
        $password = $this->request->getPost('password');

        $user = $userModel
            ->where('email', $email)
            ->first();


        if (
            $user &&
            password_verify(
                $password,
                $user['password']
            )
        ) {
            session()->set([

                'user_id' =>
                $user['id'],

                'name' =>
                $user['name'],

                'role' =>
                $user['role']

            ]);

            if ($user['role'] == 'admin') {

                return redirect()
                    ->to('/admin');
            }

            return redirect()
                ->to('/');
        }
    }
}
