<?php

namespace App\Controllers;

use App\Models\OrderModel;

class OrderController extends BaseController
{
    public function index()
    {
        $model =
            new OrderModel();

        $orders =
            $model
            ->where(
                'user_id',
                session()->get('user_id')
            )
            ->orderBy(
                'created_at',
                'DESC'
            )
            ->findAll();

        return view(
            'orders/index',
            [
                'orders' => $orders
            ]
        );
    }

    public function detail($id)
    {
        $orderModel =
            new \App\Models\OrderModel();

        $orderItemModel =
            new \App\Models\OrderItemModel();

        $order =
            $orderModel
            ->where(
                'id',
                $id
            )
            ->where(
                'user_id',
                session()->get('user_id')
            )
            ->first();

        if (!$order) {

            throw new \CodeIgniter\Exceptions\PageNotFoundException();
        }

        $items =
            $orderItemModel
            ->select(
                'order_items.*, products.name'
            )
            ->join(
                'products',
                'products.id = order_items.product_id'
            )
            ->where(
                'order_id',
                $id
            )
            ->findAll();

        return view(
            'orders/detail',
            [
                'order' => $order,
                'items' => $items
            ]
        );
    }

    public function requestRefund($id)
    {
        $orderModel =
            new \App\Models\OrderModel();

        $order =
            $orderModel
            ->where(
                'id',
                $id
            )
            ->where(
                'user_id',
                session()->get('user_id')
            )
            ->first();

        if (!$order) {

            throw new \CodeIgniter\Exceptions\PageNotFoundException();
        }

        /*
    hanya boleh refund jika:
    paid + pending
    */

        if (
            $order['payment_status'] == 'paid'
            &&
            $order['order_status'] == 'pending'
        ) {

            $orderModel->update(
                $id,
                [
                    'order_status' =>
                    'refund_requested'
                ]
            );
        }

        return redirect()
            ->to(
                '/orders/' . $id
            );
    }
    
}
