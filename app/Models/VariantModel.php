<?php

namespace App\Models;

use CodeIgniter\Model;

class VariantModel extends Model
{
    protected $table = 'variants';

    protected $primaryKey = 'id';

    protected $allowedFields = [
        'group_id',
        'name',
        'additional_price',
        'stock'
    ];
}