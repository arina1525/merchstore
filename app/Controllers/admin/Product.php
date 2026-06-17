<?php

namespace App\Controllers\Admin;
use App\Models\ProductModel;
use App\Models\CategoryModel;
use App\Models\VariantGroupModel;
use App\Models\VariantModel;

use App\Controllers\BaseController;

class Product extends BaseController
{
    public function index()
    {
        $productModel = new ProductModel();

        $products = $productModel
            ->select('products.*, categories.name as category_name')
            ->join(
                'categories',
                'categories.id = products.category_id'
            )
            ->findAll();

        $groupModel = new VariantGroupModel();
        $variantModel = new VariantModel();

        foreach ($products as &$product)
        {
            $firstGroup = $groupModel
                ->where(
                    'product_id',
                    $product['id']
                )
                ->first();

            if ($firstGroup)
            {
                $stock = $variantModel
                    ->where(
                        'group_id',
                        $firstGroup['id']
                    )
                    ->selectSum('stock')
                    ->first();

                $product['stock_total'] =
                    $stock['stock'] ?? 0;
            }
            else
            {
                $product['stock_total'] = 0;
            }
        }

        $data['products'] = $products;

        return view(
            'admin/products/index',
            $data
        );
    }

    public function create()
    {
        $categoryModel = new CategoryModel();

        $data['categories'] =
            $categoryModel->findAll();

        return view(
            'admin/products/create',
            $data
        );
    }
    public function store()
    {
        $productModel = new ProductModel();

        $productModel->save([

            'category_id' =>
                $this->request->getPost('category_id'),

            'name' =>
                $this->request->getPost('name'),

            'description' =>
                $this->request->getPost('description'),

            'price' =>
                $this->request->getPost('price'),

            'stock' =>
                $this->request->getPost('stock'),

            'status' =>
                $this->request->getPost('status'),

        ]);

        return redirect()
            ->to('/admin/products');
    }
    public function edit($id)
    {
        $productModel = new ProductModel();
        $categoryModel = new CategoryModel();

        $data['product'] =
            $productModel->find($id);

        $data['categories'] =
            $categoryModel->findAll();

        return view(
            'admin/products/edit',
            $data
        );
    }
    public function update($id)
    {
        $productModel = new ProductModel();

        $productModel->update($id, [

            'category_id' =>
                $this->request->getPost('category_id'),

            'name' =>
                $this->request->getPost('name'),

            'description' =>
                $this->request->getPost('description'),

            'price' =>
                $this->request->getPost('price'),

            'stock' =>
                $this->request->getPost('stock'),

            'status' =>
                $this->request->getPost('status'),

        ]);

        return redirect()
            ->to('/admin/products');
    }
    public function delete($id)
    {
        $productModel = new ProductModel();

        $productModel->delete($id);

        return redirect()
            ->to('/admin/products');
    }
}