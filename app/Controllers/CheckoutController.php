<?php

namespace App\Controllers;

use App\Models\CartItemModel;
use App\Models\CartItemVariantModel;
use App\Models\UserAddressModel;
use App\Models\OrderModel;
use App\Models\OrderItemModel;

class CheckoutController extends BaseController
{
    public function index()
    {
        if (!session()->get('user_id')) {

            return redirect()
                ->to('/login');
        }

        $addressModel =
            new UserAddressModel();

        $cartItemModel =
            new CartItemModel();

        $variantModel =
            new CartItemVariantModel();

        /*
        =====================
        ADDRESS
        =====================
        */

        $addresses =
            $addressModel
            ->where(
                'user_id',
                session()->get('user_id')
            )
            ->findAll();

        if (empty($addresses)) {

            return redirect()
                ->to('/addresses/create');
        }

        $selectedAddressId =
            $this->request
            ->getGet('address_id');

        if ($selectedAddressId) {

            $selectedAddress =
                $addressModel
                ->where(
                    'user_id',
                    session()->get('user_id')
                )
                ->find($selectedAddressId);
        } else {

            $selectedAddress = null;

            foreach ($addresses as $address) {

                if ($address['is_default']) {

                    $selectedAddress = $address;
                    break;
                }
            }

            if (!$selectedAddress) {

                $selectedAddress =
                    $addresses[0];
            }
        }

        /*
        =====================
        CART
        =====================
        */

        $items =
            $cartItemModel
            ->select(
                'cart_items.*, products.name'
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

        foreach ($items as $key => $item) {

            $items[$key]['variants'] =
                $variantModel
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

        /*
        =====================
        TOTAL
        =====================
        */

        $subtotal = 0;

        foreach ($items as $item) {

            $subtotal +=
                $item['total_price'];
        }

        /*
        =====================
        SHIPPING
        =====================
        */

        switch ($selectedAddress['province']) {

            case 'DKI Jakarta':
                $shippingCost = 10000;
                break;

            case 'Jawa Barat':
                $shippingCost = 15000;
                break;

            case 'Jawa Tengah':
                $shippingCost = 18000;
                break;

            case 'Jawa Timur':
                $shippingCost = 22000;
                break;

            default:
                $shippingCost = 25000;
                break;
        }

        $grandTotal =
            $subtotal +
            $shippingCost;

        return view(
            'checkout/index',
            [
                'addresses' =>
                $addresses,

                'selectedAddress' =>
                $selectedAddress,

                'items' =>
                $items,

                'subtotal' =>
                $subtotal,

                'shippingCost' =>
                $shippingCost,

                'grandTotal' =>
                $grandTotal
            ]
        );
    }
    public function process()
    {
        $userId =
            session()->get('user_id');

        if (!$userId) {

            return redirect()
                ->to('/login');
        }

        $addressId =
            $this->request
            ->getPost('address_id');

        $addressModel =
            new UserAddressModel();

        $address =
            $addressModel
            ->find($addressId);

        if (!$address) {

            return redirect()
                ->back();
        }

        $cartItemModel =
            new CartItemModel();

        $cartItems =
            $cartItemModel
            ->where(
                'user_id',
                $userId
            )
            ->findAll();

        if (empty($cartItems)) {

            return redirect()
                ->to('/cart');
        }

        /*
    ====================
    HITUNG TOTAL
    ====================
    */

        $subtotal = 0;

        foreach ($cartItems as $item) {

            $subtotal +=
                $item['total_price'];
        }

        switch ($address['province']) {

            case 'DKI Jakarta':
                $shippingCost = 10000;
                break;

            case 'Jawa Barat':
                $shippingCost = 15000;
                break;

            case 'Jawa Tengah':
                $shippingCost = 18000;
                break;

            case 'Jawa Timur':
                $shippingCost = 22000;
                break;

            default:
                $shippingCost = 25000;
                break;
        }

        $grandTotal =
            $subtotal +
            $shippingCost;

        /*
    ====================
    BUAT ORDER
    ====================
    */

        $orderModel =
            new OrderModel();

        $orderCode =
            'ORD' .
            date('YmdHis');

        $invoiceNumber =
            'INV' .
            date('YmdHis');

        $orderId =
            $orderModel->insert([

                'user_id' =>
                $userId,

                'order_code' =>
                $orderCode,

                'invoice_number' =>
                $invoiceNumber,

                'address_id' =>
                $addressId,

                'shipping_cost' =>
                $shippingCost,

                'total_price' =>
                $grandTotal,

                'payment_status' =>
                'pending',

                'order_status' =>
                'pending'
            ]);
            $userModel =
    new \App\Models\UserModel();

$user =
    $userModel->find(
        session()->get('user_id')
    );

$email =
    \Config\Services::email();

$email->setTo(
    $user['email']
);

$email->setSubject(
    'Invoice MerchStore'
);

$email->setMessage(
    "
    <h2>Thank You For Your Order</h2>

    <p>
        Invoice Number:
        {$invoiceNumber}
    </p>

    <p>
        Total:
        Rp ".number_format($grandTotal)."
    </p>

    <p>
        Payment Status:
        Pending
    </p>

    <p>
        Thank you for shopping at MerchStore.
    </p>
    "
);

$email->send();

        /*
    ====================
    COPY KE ORDER ITEMS
    ====================
    */

        $orderItemModel =
            new OrderItemModel();

        foreach ($cartItems as $item) {

            $orderItemModel
                ->insert([

                    'order_id' =>
                    $orderId,

                    'product_id' =>
                    $item['product_id'],

                    'quantity' =>
                    $item['qty'],

                    'price' =>
                    $item['base_price'],

                    'subtotal' =>
                    $item['total_price'],

                    'preview_file' =>
                    $item['preview_image'],

                    'design_file' =>
                    $item['design_file'],

                    'svg_file' =>
                    $item['svg_file']
                ]);
        }

        /*
    ====================
    HAPUS CART
    ====================
    */

        $cartItemVariantModel =
            new CartItemVariantModel();

        foreach ($cartItems as $item) {

            $cartItemVariantModel
                ->where(
                    'cart_item_id',
                    $item['id']
                )
                ->delete();
        }

        $cartItemModel
            ->where(
                'user_id',
                $userId
            )
            ->delete();

        /*
    ====================
    PAYMENT PAGE
    ====================
    */

        return redirect()
            ->to(
                '/payment/' .
                    $orderId
            );
    }
}
