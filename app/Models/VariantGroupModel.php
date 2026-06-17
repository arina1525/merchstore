<?php

namespace App\Models;

use CodeIgniter\Model;

class VariantGroupModel extends Model
{
    protected $table = 'variant_groups';

    protected $primaryKey = 'id';

    protected $allowedFields = [
        'product_id',
        'name'
    ];
}