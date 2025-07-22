<?php
namespace App\Services;

use App\Data\OrderData;
use App\Models\Order;
use App\Models\Product;
use Illuminate\Support\Facades\DB;

class OrderService extends Service
{
    public static function getByUserId ($userId)
    {
        return Order::where('user_id', $userId)->get();
    }
    public static function create($orderData): OrderData
    {
        return DB::transaction(function () use ($orderData) {
            $order = new Order();
            $order->user_id = $orderData->user_id;
            $order->comment = $orderData->comment;
            $order->total_amount = 0;

            $totalAmount = 0; // Сумма заказа

            //Проходимся по всем продуктам из заказа
            foreach ($orderData->list_products as $productData) {
                $product = Product::findOrFail($productData->product_id);
                $quantity = $productData->quantity;

                $totalAmount += $product->price * $quantity; //Считаем общую сумму заказа
                $order->products()->attach($product->id, ['quantity' => $quantity]);
            }

            $order->total_amount = $totalAmount; // присваиваем общую сумму заказа

            $order->save();

            return $order;
        });
    }
}
