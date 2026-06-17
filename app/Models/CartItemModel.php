<?php

namespace App\Models;

use CodeIgniter\Model;

class CartItemModel extends Model
{
    protected $table = 'cart_items';

    protected $primaryKey = 'id';

    protected $allowedFields = [
        'user_id',
        'product_id',
        'qty',
        'base_price',
        'total_price',
        'preview_image',
        'design_file',
        'svg_file',
        'hole_x',
        'hole_y'
    ];
}