<?php
namespace App\Services;

use App\Models\Product;
use App\Services\Service;
use Illuminate\Database\Eloquent\Collection;

class ProductService extends Service
{
    public static function getAll(): Collection
    {
        return Product::all();
    }
}
