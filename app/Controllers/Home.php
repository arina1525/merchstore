<?php

namespace App\Controllers;

use App\Models\ProductModel;
use App\Models\CategoryModel;
use App\Models\ProductImageModel;

class Home extends BaseController
{
    public function index()
    {
        $db =
            \Config\Database::connect();

        $categoryModel =
            new CategoryModel();

        $productImageModel =
            new ProductImageModel();

        $hottestProducts =
            $db->query("
        SELECT

            products.*,

            SUM(
                order_items.quantity
            ) AS sold

        FROM products

        LEFT JOIN order_items
        ON order_items.product_id =
           products.id

        LEFT JOIN orders
        ON orders.id =
           order_items.order_id

        WHERE
            orders.payment_status = 'paid'

        AND
            orders.order_status NOT IN
            (
                'refunded',
                'cancelled'
            )

        GROUP BY products.id

        ORDER BY
            sold DESC,
            products.name ASC

        LIMIT 5
    ")
            ->getResultArray();

        $categories =
            $categoryModel
            ->findAll();
        foreach ($hottestProducts as &$product) {

            $firstImage =
                $productImageModel
                ->where(
                    'product_id',
                    $product['id']
                )
                ->first();

            $product['image'] =
                $firstImage
                ? $firstImage['image']
                : null;
        }

        return view(
            'home/index',
            [
                'hottestProducts' =>
                $hottestProducts,

                'categories' =>
                $categories
            ]
        );
    }
}
