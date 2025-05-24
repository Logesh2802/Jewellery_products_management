<?php

namespace App\Models;

use CodeIgniter\Model;

class JewelleryProductModel extends Model
{
    protected $table = 'jewellery_products';
    protected $primaryKey = 'id';

    protected $allowedFields = ['product_name', 'description', 'price', 'category', 'image'];

    protected $useTimestamps = true;
    protected $createdField = 'created_at';
    protected $updatedField = 'updated_at';
}
