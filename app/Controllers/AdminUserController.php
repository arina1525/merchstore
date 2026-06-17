<?php

namespace App\Controllers;

use App\Models\UserModel;
use App\Models\OrderModel;
use App\Models\UserAddressModel;

class AdminUserController extends BaseController
{
    public function index()
    {
        $userModel =
            new UserModel();

        $orderModel =
            new OrderModel();

        $users =
            $userModel
            ->where(
                'role',
                'customer'
            )
            ->findAll();

        foreach ($users as &$user) {

            $user['total_orders'] =
                $orderModel
                ->where(
                    'user_id',
                    $user['id']
                )
                ->countAllResults();
        }

        return view(
            'admin/users/index',
            [
                'users' => $users
            ]
        );
    }

    public function detail($id)
    {
        $userModel =
            new UserModel();

        $orderModel =
            new OrderModel();

        $addressModel =
            new UserAddressModel();

        $user =
            $userModel
            ->find($id);

        if (!$user) {

            throw new \CodeIgniter\Exceptions\PageNotFoundException();
        }

        $orders =
            $orderModel
            ->where(
                'user_id',
                $id
            )
            ->orderBy(
                'created_at',
                'DESC'
            )
            ->findAll();

        $addresses =
            $addressModel
            ->where(
                'user_id',
                $id
            )
            ->findAll();

        $totalSpent = 0;

        foreach ($orders as $order) {

            if (
                $order['payment_status']
                == 'paid'
            ) {

                $totalSpent +=
                    $order['total_price'];
            }
        }

        return view(
            'admin/users/detail',
            [
                'user' => $user,
                'orders' => $orders,
                'addresses' => $addresses,
                'totalSpent' => $totalSpent
            ]
        );
    }
}