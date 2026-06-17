<?php

namespace App\Controllers;

use App\Models\ProductModel;
use App\Models\ProductImageModel;
use App\Models\VariantGroupModel;
use App\Models\VariantModel;
use App\Models\CategoryModel;

class Product extends BaseController
{
    public function index()
    {
        $productModel = new ProductModel();
        $categoryModel =
            new CategoryModel();

        $search =
            $this->request
            ->getGet('search');

        $category =
            $this->request
            ->getGet('category');

        $sort =
            $this->request
            ->getGet('sort');

        if ($search) {

            $productModel
                ->like(
                    'name',
                    $search
                );
        }
        if ($category) {

            $productModel
                ->where(
                    'category_id',
                    $category
                );
        }
        switch ($sort) {

            case 'price_asc':

                $productModel
                    ->orderBy(
                        'price',
                        'ASC'
                    );

                break;

            case 'price_desc':

                $productModel
                    ->orderBy(
                        'price',
                        'DESC'
                    );

                break;

            default:

                $productModel
                    ->orderBy(
                        'id',
                        'DESC'
                    );

                break;
        }
        $categories = $categoryModel
        ->findAll();

        $products = $productModel
            ->where('status', 'active')
            ->findAll();

        $imageModel = new ProductImageModel();

        foreach ($products as &$product) {
            $thumbnail = $imageModel
                ->where('product_id', $product['id'])
                ->first();

            $product['thumbnail'] =
                $thumbnail['image'] ?? null;
            $groupModel = new VariantGroupModel();
            $variantModel = new VariantModel();
            $firstGroup = $groupModel
                ->where('product_id', $product['id'])
                ->first();
            if ($firstGroup) {
                $variants = $variantModel
                    ->where(
                        'group_id',
                        $firstGroup['id']
                    )
                    ->findAll();

                if ($variants) {
                    $prices = [];

                    foreach ($variants as $variant) {
                        $prices[] =
                            $product['price']
                            +
                            $variant['additional_price'];
                    }

                    $product['min_price'] =
                        min($prices);

                    $product['max_price'] =
                        max($prices);
                } else {
                    $product['min_price'] =
                        $product['price'];

                    $product['max_price'] =
                        $product['price'];
                }
            }
        }


        $data['products'] = $products;

        return view(
            'products/index', [
            'products' => $products,
            'categories' => $categories,
            'search' => $search,
            'category' => $category,
            'sort' => $sort,
            $data]
        );
    }

    public function detail($id)
    {

        $productModel = new ProductModel();

        $data['product'] =
            $productModel->find($id);
        $imageModel =
            new ProductImageModel();

        $data['images'] =
            $imageModel
            ->where(
                'product_id',
                $id
            )
            ->findAll();
        $groupModel =
            new VariantGroupModel();

        $data['groups'] =
            $groupModel
            ->where(
                'product_id',
                $id
            )
            ->findAll();
        $variantModel =
            new VariantModel();

        foreach ($data['groups'] as &$group) {
            $group['variants'] =
                $variantModel
                ->where(
                    'group_id',
                    $group['id']
                )
                ->findAll();
        }
        return view(
            'products/detail',
            $data
        );
    }
    public function custom($id)
    {
        $productModel = new ProductModel();
        $groupModel = new VariantGroupModel();
        $variantModel = new VariantModel();

        $data['product'] =
            $productModel
            ->select(
                'products.*,
             categories.name as category_name,
             categories.preview_type'
            )
            ->join(
                'categories',
                'categories.id = products.category_id'
            )
            ->find($id);

        $data['groups'] =
            $groupModel
            ->where('product_id', $id)
            ->findAll();

        foreach ($data['groups'] as &$group) {
            $group['variants'] =
                $variantModel
                ->where(
                    'group_id',
                    $group['id']
                )
                ->findAll();
        }

        return view(
            'products/custom',
            $data
        );
    }
}
