<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\VariantModel;
use App\Models\VariantGroupModel;

class Variant extends BaseController
{
    public function index($groupId)
    {
        $groupModel = new VariantGroupModel();
        $variantModel = new VariantModel();

        $data['group'] =
            $groupModel->find($groupId);

        $data['variants'] =
            $variantModel
                ->where('group_id', $groupId)
                ->findAll();

        return view(
            'admin/variant_options/index',
            $data
        );
    }
    public function create($groupId)
    {
        $groupModel = new VariantGroupModel();

        $data['group'] =
            $groupModel->find($groupId);

        return view(
            'admin/variant_options/create',
            $data
        );
    }
    public function store($groupId)
    {
        $variantModel =
            new VariantModel();

        $variantModel->save([

            'group_id' => $groupId,

            'name' =>
                $this->request->getPost('name'),

            'additional_price' =>
                $this->request->getPost('additional_price'),

            'stock' =>
                $this->request->getPost('stock')

        ]);

        return redirect()->to(
            '/admin/variants/' . $groupId
        );
    }
    public function edit($id)
    {
        $variantModel =
            new VariantModel();

        $data['variant'] =
            $variantModel->find($id);

        return view(
            'admin/variant_options/edit',
            $data
        );
    }
    public function update($id)
    {
        $variantModel =
            new VariantModel();

        $variant =
            $variantModel->find($id);

        $variantModel->update($id,[

            'name' =>
                $this->request->getPost('name'),

            'additional_price' =>
                $this->request->getPost('additional_price'),

            'stock' =>
                $this->request->getPost('stock')

        ]);

        return redirect()->to(
            '/admin/variants/' .
            $variant['group_id']
        );
    }
    public function delete($id)
    {
        $variantModel =
            new VariantModel();

        $variant =
            $variantModel->find($id);

        $variantModel->delete($id);

        return redirect()->to(
            '/admin/variants/' .
            $variant['group_id']
        );
    }
}