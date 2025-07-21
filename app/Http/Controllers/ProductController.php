<?php

namespace App\Http\Controllers;

use App\Helpers\Response;
use App\Models\Product;
use App\Services\ProductService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    /**
     * Получить все продукты
     */
    public function index(): JsonResponse
    {
        $products = ProductService::getAll();
        return Response::respond($products);
    }
}
