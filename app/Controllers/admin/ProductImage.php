<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;

use App\Models\ProductModel;
use App\Models\ProductImageModel;

class ProductImage extends BaseController
{
    public function index($productId)
    {
        $productModel = new ProductModel();
        $imageModel = new ProductImageModel();

        $data['product'] =
            $productModel->find($productId);

        $data['images'] =
            $imageModel
                ->where(
                    'product_id',
                    $productId
                )
                ->findAll();

        return view(
            'admin/product_images/index',
            $data
        );
    }
    public function store($productId)
    {
        $imageModel =
            new ProductImageModel();

        $file =
            $this->request->getFile('image');

        if ($file->isValid())
        {
            $newName =
                $file->getRandomName();

            $file->move(
                'uploads/products',
                $newName
            );

            $imageModel->save([

                'product_id' =>
                    $productId,

                'image' =>
                    $newName

            ]);
        }

        return redirect()->back();
    }
    public function delete($id)
    {
        $imageModel =
            new ProductImageModel();

        $image =
            $imageModel->find($id);

        if($image)
        {
            $file =
                FCPATH .
                'uploads/products/' .
                $image['image'];

            if(file_exists($file))
            {
                unlink($file);
            }

            $imageModel->delete($id);
        }

        return redirect()->back();
    }
}