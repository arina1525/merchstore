<?php

namespace App\Controllers;

use App\Models\UserModel;

class ProfileController extends BaseController
{
    public function index()
    {
        if (!session()->get('user_id')) {

            return redirect()
                ->to('/login');
        }

        $userModel =
            new UserModel();

        $user =
            $userModel->find(
                session()->get('user_id')
            );

        return view(
            'profile/index',
            [
                'user' => $user
            ]
        );
    }

    public function update()
    {
        $userModel =
            new UserModel();

        $userModel->update(
            session()->get('user_id'),
            [
                'name' =>
                    $this->request
                        ->getPost('name'),

                'phone' =>
                    $this->request
                        ->getPost('phone'),

                'updated_at' =>
                    date('Y-m-d H:i:s')
            ]
        );

        return redirect()
            ->to('/profile')
            ->with(
                'success',
                'Profile updated successfully'
            );
    }
}