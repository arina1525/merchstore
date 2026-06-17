<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;

class Dashboard extends BaseController
{
    public function index()
    {
        $productModel =
            new \App\Models\ProductModel();

        $userModel =
            new \App\Models\UserModel();

        $orderModel =
            new \App\Models\OrderModel();

        $db =
            \Config\Database::connect();

        $totalProducts =
            $productModel
            ->countAll();

        $totalUsers =
            $userModel
            ->where(
                'role',
                'customer'
            )
            ->countAllResults();

        $totalOrders =
            $orderModel
            ->countAll();

        $revenue = 0;

        $paidOrders =
            $orderModel
            ->where(
                'payment_status',
                'paid'
            )
            ->whereNotIn(
                'order_status',
                [
                    'refunded',
                    'cancelled'
                ]
            )
            ->findAll();

        foreach ($paidOrders as $order) {

            $revenue +=
                $order['total_price'];
        }

        $recentOrders =
            $orderModel
            ->orderBy(
                'created_at',
                'DESC'
            )
            ->findAll(5);
        $pendingOrders =
            $orderModel
            ->where(
                'order_status',
                'pending'
            )
            ->countAllResults();

        $processingOrders =
            $orderModel
            ->where(
                'order_status',
                'processing'
            )
            ->countAllResults();

        $refundRequests =
            $orderModel
            ->where(
                'order_status',
                'refund_requested'
            )
            ->countAllResults();
        $topProducts =
            $db->query("
        SELECT

            products.name,

            SUM(
                order_items.quantity
            ) AS sold

        FROM order_items

        JOIN orders
        ON orders.id =
           order_items.order_id

        JOIN products
        ON products.id =
           order_items.product_id

        WHERE
            orders.payment_status = 'paid'

        AND
            orders.order_status NOT IN
            (
                'refunded',
                'cancelled'
            )

        GROUP BY
            products.id

        ORDER BY
            sold DESC,
            products.name ASC

        LIMIT 5
    ")
            ->getResultArray();
        $salesChart =
            $db->query("
        SELECT

            DATE(created_at)
            AS sales_date,

            COUNT(id)
            AS total

        FROM orders

        GROUP BY DATE(created_at)

        ORDER BY sales_date
    ")
            ->getResultArray();

        return view(
            'admin/dashboard',
            [
                'totalProducts' =>
                $totalProducts,

                'totalUsers' =>
                $totalUsers,

                'totalOrders' =>
                $totalOrders,

                'revenue' =>
                $revenue,

                'recentOrders' =>
                $recentOrders,

                'pendingOrders' =>
                $pendingOrders,

                'processingOrders' =>
                $processingOrders,

                'refundRequests' =>
                $refundRequests,

                'topProducts' =>
                $topProducts,

                'salesChart' =>
                $salesChart
            ]
        );
    }
    public function exportPdf()
    {
        $db =
            \Config\Database::connect();

        $orderModel =
            new \App\Models\OrderModel();

        $userModel =
            new \App\Models\UserModel();

        $orders =
            $orderModel
            ->orderBy(
                'created_at',
                'DESC'
            )
            ->findAll();

        $totalOrders =
            count($orders);

        $totalUsers =
            $userModel
            ->where(
                'role',
                'customer'
            )
            ->countAllResults();

        $revenue = 0;

        foreach ($orders as $order) {
            if (
                $order['payment_status']
                == 'paid'
                &&
                !in_array(
                    $order['order_status'],
                    [
                        'refunded',
                        'cancelled'
                    ]
                )
            ) {
                $revenue +=
                    $order['total_price'];
            }
        }

        $topProductData =
            $db->query("
            SELECT

                products.name,

                SUM(
                    order_items.quantity
                ) AS sold

            FROM order_items

            JOIN orders
            ON orders.id =
               order_items.order_id

            JOIN products
            ON products.id =
               order_items.product_id

            WHERE
                orders.payment_status =
                'paid'

            AND
                orders.order_status
                NOT IN
                (
                    'refunded',
                    'cancelled'
                )

            GROUP BY
                products.id

            ORDER BY
                sold DESC

            LIMIT 1
        ")
            ->getRowArray();

        $html =
            view(
                'admin/report_pdf',
                [

                    'orders' =>
                    $orders,

                    'revenue' =>
                    $revenue,

                    'totalOrders' =>
                    $totalOrders,

                    'totalUsers' =>
                    $totalUsers,

                    'topProduct' =>
                    $topProductData['name']
                        ?? '-',

                    'topProductSold' =>
                    $topProductData['sold']
                        ?? 0
                ]
            );

        $dompdf =
            new \Dompdf\Dompdf();

        $dompdf->loadHtml(
            $html
        );

        $dompdf->setPaper(
            'A4',
            'portrait'
        );

        $dompdf->render();

        $dompdf->stream(
            'merchstore-report.pdf',
            [
                'Attachment' => true
            ]
        );
    }

    public function exportCsv()
    {
        $orderModel =
            new \App\Models\OrderModel();

        $orders =
            $orderModel
            ->findAll();

        header(
            'Content-Type: text/csv'
        );

        header(
            'Content-Disposition: attachment; filename="sales-report.csv"'
        );

        $output =
            fopen(
                'php://output',
                'w'
            );

        fputcsv(
            $output,
            [
                'Invoice',
                'Total',
                'Payment',
                'Status'
            ]
        );

        foreach ($orders as $order) {
            fputcsv(
                $output,
                [
                    $order['invoice_number'],
                    $order['total_price'],
                    $order['payment_status'],
                    $order['order_status']
                ]
            );
        }

        fclose(
            $output
        );

        exit;
    }
}
