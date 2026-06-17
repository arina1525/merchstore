<?php

namespace App\Models;

use CodeIgniter\Model;

class UserAddressModel extends Model
{
    protected $table = 'user_addresses';

    protected $primaryKey = 'id';

    protected $allowedFields = [
        'user_id',
        'receiver_name',
        'phone',
        'province',
        'city',
        'postal_code',
        'address',
        'is_default'
    ];
}