<?php

namespace App\Http\Controllers;

use App\Data\OrderData;
use App\Helpers\Response;
use App\Services\OrderService;
use Illuminate\Http\JsonResponse;

class OrderController extends Controller
{
    /**
     * Вывод всех заказов пользователя
     * @param string $user_id
     * @return JsonResponse
     **/
    public function index(string $user_id): JsonResponse
    {
        return Response::respond(OrderService::getByUserId($user_id));
    }

    /**
     * Создание заказа
     * @param OrderData $data
     * @return JsonResponse
    **/
    public function store(OrderData $data): JsonResponse
    {
        return Response::respond(OrderService::create($data));
    }
}
