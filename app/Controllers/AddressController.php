<?php

namespace App\Controllers;

use App\Models\UserAddressModel;

class AddressController extends BaseController
{
    public function index()
    {
        $addressModel = new UserAddressModel();

        $addresses = $addressModel
            ->where(
                'user_id',
                session()->get('user_id')
            )
            ->findAll();

        return view(
            'addresses/index',
            [
                'addresses' => $addresses
            ]
        );
    }

    public function create()
    {
        return view('addresses/create');
    }

    public function store()
    {
        $addressModel =
            new UserAddressModel();

        $isDefault =
            $this->request
            ->getPost('is_default')
            ? 1
            : 0;

        if ($isDefault) {

            $addressModel
                ->where(
                    'user_id',
                    session()->get('user_id')
                )
                ->set([
                    'is_default' => 0
                ])
                ->update();
        }

        $addressModel->insert([

            'user_id' =>
                session()->get('user_id'),

            'receiver_name' =>
                $this->request
                ->getPost('receiver_name'),

            'phone' =>
                $this->request
                ->getPost('phone'),

            'province' =>
                $this->request
                ->getPost('province'),

            'city' =>
                $this->request
                ->getPost('city'),

            'postal_code' =>
                $this->request
                ->getPost('postal_code'),

            'address' =>
                $this->request
                ->getPost('address'),

            'is_default' =>
                $isDefault
        ]);

        return redirect()
            ->to('/addresses');
    }

    public function delete($id)
    {
        $addressModel =
            new UserAddressModel();

        $addressModel
            ->where(
                'user_id',
                session()->get('user_id')
            )
            ->delete($id);

        return redirect()
            ->to('/addresses');
    }

    public function setDefault($id)
    {
        $addressModel =
            new UserAddressModel();

        $addressModel
            ->where(
                'user_id',
                session()->get('user_id')
            )
            ->set([
                'is_default' => 0
            ])
            ->update();

        $addressModel->update(
            $id,
            [
                'is_default' => 1
            ]
        );

        return redirect()
            ->to('/addresses');
    }
}