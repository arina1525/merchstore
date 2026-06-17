<?php

namespace App\Models;

use CodeIgniter\Model;

class CartItemVariantModel extends Model
{
    protected $table = 'cart_item_variants';

    protected $primaryKey = 'id';

    protected $allowedFields = [
        'cart_item_id',
        'variant_id'
    ];
}