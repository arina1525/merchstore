<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\ProductModel;
use App\Models\VariantGroupModel;

class VariantGroup extends BaseController
{
    public function index($productId)
    {
        $productModel = new ProductModel();
        $groupModel = new VariantGroupModel();

        $data['product'] =
            $productModel->find($productId);

        $data['groups'] =
            $groupModel
                ->where(
                    'product_id',
                    $productId
                )
                ->findAll();

        return view(
            'admin/variants/index',
            $data
        );
    }
    public function create($productId)
    {
        $productModel = new ProductModel();

        $data['product'] =
            $productModel->find($productId);

        return view(
            'admin/variants/create',
            $data
        );
    }
    public function store($productId)
    {
        $groupModel =
            new VariantGroupModel();

        $groupModel->save([

            'product_id' => $productId,

            'name' =>
                $this->request->getPost('name')

        ]);

        return redirect()->to(
            '/admin/products/variants/' .
            $productId
        );
    }
    public function edit($id)
    {
        $groupModel = new VariantGroupModel();

        $data['group'] =
            $groupModel->find($id);

        return view(
            'admin/variants/edit',
            $data
        );
    }
    public function update($id)
    {
        $groupModel =
            new VariantGroupModel();

        $group =
            $groupModel->find($id);

        $groupModel->update($id, [

            'name' =>
                $this->request->getPost('name')

        ]);

        return redirect()->to(
            '/admin/products/variants/' .
            $group['product_id']
        );
    }
    public function delete($id)
    {
        $groupModel =
            new VariantGroupModel();

        $group =
            $groupModel->find($id);

        $groupModel->delete($id);

        return redirect()->to(
            '/admin/products/variants/' .
            $group['product_id']
        );
    }
}