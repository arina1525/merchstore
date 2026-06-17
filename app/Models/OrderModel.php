<?php

namespace App\Models;

use CodeIgniter\Model;

class OrderModel extends Model
{
    protected $table = 'orders';

    protected $allowedFields = [

        'user_id',
        'order_code',
        'invoice_number',
        'address_id',
        'shipping_cost',
        'total_price',
        'payment_status',
        'order_status',

        'xendit_invoice_id',
        'payment_url'
    ];
}
