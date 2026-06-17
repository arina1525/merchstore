<?php

namespace App\Controllers;

use App\Models\OrderModel;
use App\Models\OrderItemModel;

class AdminOrderController extends BaseController
{
    public function index()
    {
        $orderModel =
            new OrderModel();

        $pendingOrders =
            $orderModel
            ->where(
                'order_status',
                'pending'
            )
            ->orderBy(
                'created_at',
                'DESC'
            )
            ->findAll();

        $processingOrders =
            $orderModel
            ->where(
                'order_status',
                'processing'
            )
            ->orderBy(
                'created_at',
                'DESC'
            )
            ->findAll();

        $shippedOrders =
            $orderModel
            ->where(
                'order_status',
                'shipped'
            )
            ->orderBy(
                'created_at',
                'DESC'
            )
            ->findAll();

        $completedOrders =
            $orderModel
            ->where(
                'order_status',
                'completed'
            )
            ->orderBy(
                'created_at',
                'DESC'
            )
            ->findAll();

        $refundOrders =
            $orderModel
            ->where(
                'order_status',
                'refund_requested'
            )
            ->orderBy(
                'created_at',
                'DESC'
            )
            ->findAll();

        $refundedOrders =
            $orderModel
            ->where(
                'order_status',
                'refunded'
            )
            ->orderBy(
                'created_at',
                'DESC'
            )
            ->findAll();

        $cancelledOrders =
            $orderModel
            ->where(
                'order_status',
                'cancelled'
            )
            ->orderBy(
                'created_at',
                'DESC'
            )
            ->findAll();

        return view(
            'admin/orders/index',
            [
                'pendingOrders' =>
                $pendingOrders,

                'processingOrders' =>
                $processingOrders,

                'shippedOrders' =>
                $shippedOrders,

                'completedOrders' =>
                $completedOrders,

                'refundOrders' =>
                $refundOrders,

                'refundedOrders' =>
                $refundedOrders,

                'cancelledOrders' =>
                $cancelledOrders
            ]
        );
    }

    public function detail($id)
    {
        $orderModel =
            new OrderModel();

        $orderItemModel =
            new OrderItemModel();

        $order =
            $orderModel
            ->find($id);

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
            'admin/orders/detail',
            [
                'order' => $order,
                'items' => $items
            ]
        );
    }

    public function updateStatus()
    {
        $orderId =
            $this->request
            ->getPost('order_id');

        $status =
            $this->request
            ->getPost('status');

        $orderModel =
            new OrderModel();

        $updateData = [

            'order_status' =>
            $status
        ];

        /*
        REFUND
        */

        if ($status == 'refunded') {

            $updateData['payment_status'] =
                'refunded';
        }

        $orderModel->update(
            $orderId,
            $updateData
        );
        $userModel =
    new \App\Models\UserModel();

$order =
    $orderModel->find(
        $orderId
    );

$user =
    $userModel->find(
        $order['user_id']
    );

$email =
    \Config\Services::email();

$email->setTo(
    $user['email']
);

$email->setSubject(
    'Order Status Updated'
);

$email->setMessage(
    '
    <h2>Order Update</h2>

    <p>
        Invoice :
        '.$order['invoice_number'].'
    </p>

    <p>
        New Status :
        '.$status.'
    </p>
    '
);

$email->send();

        return redirect()
            ->back();
    }
}
