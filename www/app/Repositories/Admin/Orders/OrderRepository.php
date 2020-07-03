<?php

namespace App\Repositories\Admin\Orders;

use App\Models\Orders\Order;
use \Exception;

class OrderRepository
{
    /**
     * @param array $params
     * @return mixed
     */
    public function getAllOrders(array $params)
    {
        $userId = $params['user_id'];
        $email = $params['email'];
        $status = $params['status'];
        $orders = Order::orderBy('id', 'DESC');
        if (!empty($userId))
            $orders->where('user_id', $userId);
        if (!empty($email))
            $orders->where('email', $email);
        if (!empty($status))
            $orders->where('status', $status);
        return $orders->paginate(20);
    }

    /**
     * @param int $orderId
     * @return mixed
     * @throws Exception
     */
    public function findOrder(int $orderId)
    {
        $order = Order::find($orderId);
        if (empty($order))
            throw new Exception(trans('errors.noObject'));
        return $order;
    }
}
