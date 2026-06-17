<?php

namespace App\Controllers;

use App\Models\OrderModel;
use Xendit\Configuration;
use Xendit\Invoice\InvoiceApi;
use Xendit\Invoice\CreateInvoiceRequest;

class PaymentController extends BaseController
{
    public function index($orderId)
    {
        $orderModel =
            new OrderModel();

        $order =
            $orderModel->find($orderId);

        if (!$order) {

            throw new \CodeIgniter\Exceptions\PageNotFoundException();
        }

        /*
        ====================================
        SUDAH PERNAH BUAT INVOICE?
        ====================================
        */

        if (!empty($order['payment_url'])) {

            return redirect()
                ->to(
                    $order['payment_url']
                );
        }

        /*
        ====================================
        XENDIT CONFIG
        ====================================
        */

        Configuration::setXenditKey(
            env('XENDIT_SECRET_KEY')
        );

        $invoiceApi =
            new InvoiceApi();

        $request =
            new CreateInvoiceRequest([
                'external_id' =>
                $order['invoice_number'],

                'amount' =>
                (float)
                $order['total_price'],

                'description' =>
                'Order ' .
                    $order['invoice_number']
            ]);

        $invoice =
            $invoiceApi->createInvoice(
                $request
            );

        $orderModel->update(
            $orderId,
            [
                'xendit_invoice_id' =>
                $invoice->getId(),

                'payment_url' =>
                $invoice->getInvoiceUrl(),

                'payment_status' =>
                'paid',

                'order_status' =>
                'pending'
            ]
        );

        return redirect()
            ->to(
                $invoice->getInvoiceUrl()
            );
    }

    public function webhook()
    {
        $payload =
            json_decode(
                file_get_contents(
                    'php://input'
                ),
                true
            );

        $externalId =
            $payload['external_id']
            ?? null;

        if (!$externalId) {

            return;
        }

        $orderModel =
            new OrderModel();

        $order =
            $orderModel
            ->where(
                'invoice_number',
                $externalId
            )
            ->first();

        if (!$order) {

            return;
        }

        if (
            $payload['status']
            == 'PAID'
        ) {

            $orderModel->update(
                $order['id'],
                [

                    'payment_status' =>
                    'paid',

                    'order_status' =>
                    'processing'
                ]
            );
        }
    }
}
