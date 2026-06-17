<?php

namespace App\Controllers;

use App\Models\CartItemModel;
use App\Models\CartItemVariantModel;
use App\Models\ProductModel;
use App\Models\VariantModel;

class CartController extends BaseController
{
    public function add()
    {
        if (!session()->get('user_id')) {

            return $this->response
                ->setStatusCode(401)
                ->setJSON([
                    'status' => false,
                    'message' => 'Harus login terlebih dahulu'
                ]);
        }

        $productId = $this->request->getPost('product_id');
        $qty = $this->request->getPost('qty');

        $variants = json_decode(
            $this->request->getPost('variants'),
            true
        );

        if (!$variants) {
            $variants = [];
        }

        $holeX = $this->request->getPost('hole_x');
        $holeY = $this->request->getPost('hole_y');

        /*
        |--------------------------------------------------------------------------
        | Upload Design
        |--------------------------------------------------------------------------
        */
        $design = $this->request->getFile('design_file');

        $designName = null;

        if ($design && $design->isValid()) {

            $designName =
                $design->getRandomName();

            $design->move(
                FCPATH . 'uploads/designs',
                $designName
            );
        }

        /*
        |--------------------------------------------------------------------------
        | Upload SVG
        |--------------------------------------------------------------------------
        */
        $svg = $this->request->getFile('svg_file');

        $svgName = null;

        if ($svg && $svg->isValid()) {

            $svgName =
                $svg->getRandomName();

            $svg->move(
                FCPATH . 'uploads/svg',
                $svgName
            );
        }

        /*
        |--------------------------------------------------------------------------
        | Simpan Preview Canvas
        |--------------------------------------------------------------------------
        */
        $preview =
            $this->request
            ->getPost('preview_image');

        $previewName = null;

        if ($preview) {

            $preview =
                str_replace(
                    'data:image/png;base64,',
                    '',
                    $preview
                );

            $preview =
                str_replace(
                    ' ',
                    '+',
                    $preview
                );

            $previewName =
                uniqid() . '.png';

            file_put_contents(
                FCPATH .
                    'uploads/previews/' .
                    $previewName,

                base64_decode(
                    $preview
                )
            );
        }

        /*
        |--------------------------------------------------------------------------
        | Hitung Harga
        |--------------------------------------------------------------------------
        */
        $productModel =
            new ProductModel();

        $variantModel =
            new VariantModel();

        $product =
            $productModel
            ->find($productId);

        if (!$product) {

            return $this->response
                ->setJSON([
                    'status' => false,
                    'message' => 'Produk tidak ditemukan'
                ]);
        }

        $basePrice =
            $product['price'];

        $variantPrice = 0;

        foreach (
            $variants
            as $variantId
        ) {

            $variant =
                $variantModel
                ->find($variantId);

            if ($variant) {

                $variantPrice +=
                    $variant['additional_price'];
            }
        }

        $totalPrice =
            ($basePrice + $variantPrice)
            * $qty;

        /*
        |--------------------------------------------------------------------------
        | Simpan Cart Item
        |--------------------------------------------------------------------------
        */
        $cartItemModel =
            new CartItemModel();

        $cartItemId =
            $cartItemModel
            ->insert([

                'user_id' =>
                    session()
                    ->get('user_id'),

                'product_id' =>
                    $productId,

                'qty' =>
                    $qty,

                'base_price' =>
                    $basePrice,

                'total_price' =>
                    $totalPrice,

                'preview_image' =>
                    $previewName,

                'design_file' =>
                    $designName,

                'svg_file' =>
                    $svgName,

                'hole_x' =>
                    $holeX,

                'hole_y' =>
                    $holeY
            ]);

        /*
        |--------------------------------------------------------------------------
        | Simpan Variant
        |--------------------------------------------------------------------------
        */
        $cartVariantModel =
            new CartItemVariantModel();

        foreach (
            $variants
            as $variantId
        ) {

            $cartVariantModel
                ->insert([

                    'cart_item_id' =>
                        $cartItemId,

                    'variant_id' =>
                        $variantId
                ]);
        }

        return $this->response
            ->setJSON([

                'status' => true,

                'message' =>
                    'Produk berhasil ditambahkan ke cart'
            ]);
    }

    public function index()
    {
        $cartItemModel =
            new CartItemModel();

        $variantCartModel =
            new CartItemVariantModel();

        $items =
            $cartItemModel
            ->select(
                'cart_items.*, products.name, products.image'
            )
            ->join(
                'products',
                'products.id = cart_items.product_id'
            )
            ->where(
                'cart_items.user_id',
                session()->get('user_id')
            )
            ->findAll();

        foreach ($items as &$item) {

            $item['variants'] =
                $variantCartModel
                ->select(
                    'variants.name'
                )
                ->join(
                    'variants',
                    'variants.id = cart_item_variants.variant_id'
                )
                ->where(
                    'cart_item_id',
                    $item['id']
                )
                ->findAll();
        }

        return view(
            'cart/index',
            [
                'items' => $items
            ]
        );
    }

    public function remove($id)
    {
        $cartItemModel =
            new CartItemModel();

        $variantCartModel =
            new CartItemVariantModel();

        $item =
            $cartItemModel
            ->find($id);

        if (!$item) {

            return redirect()
                ->to('/cart');
        }

        if (
            !empty(
                $item['preview_image']
            ) &&
            file_exists(
                FCPATH .
                    'uploads/previews/' .
                    $item['preview_image']
            )
        ) {

            unlink(
                FCPATH .
                    'uploads/previews/' .
                    $item['preview_image']
            );
        }

        if (
            !empty(
                $item['design_file']
            ) &&
            file_exists(
                FCPATH .
                    'uploads/designs/' .
                    $item['design_file']
            )
        ) {

            unlink(
                FCPATH .
                    'uploads/designs/' .
                    $item['design_file']
            );
        }

        if (
            !empty(
                $item['svg_file']
            ) &&
            file_exists(
                FCPATH .
                    'uploads/svg/' .
                    $item['svg_file']
            )
        ) {

            unlink(
                FCPATH .
                    'uploads/svg/' .
                    $item['svg_file']
            );
        }

        $variantCartModel
            ->where(
                'cart_item_id',
                $id
            )
            ->delete();

        $cartItemModel
            ->delete($id);

        return redirect()
            ->to('/cart');
    }
}