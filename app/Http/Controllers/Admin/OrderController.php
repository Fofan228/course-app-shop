<?php

    namespace App\Http\Controllers\Admin;

    use App\Http\Controllers\Controller;
    use App\Models\Order;
    use Illuminate\Http\Request;

    class OrderController extends Controller
    {
        public function index()
        {
            $orders = Order::orderBy('status', 'asc')->paginate(5);
            $statuses = Order::STATUSES;
            return view('admin.order.index',compact('orders', 'statuses'));
        }

        public function show(Order $order)
        {
            $statuses = Order::STATUSES;
            return view('admin.order.show', compact('order', 'statuses'));
        }

        public function edit(Order $order)
        {
            $statuses = Order::STATUSES;
            return view('admin.order.edit', compact('order', 'statuses'));
        }

        public function update(Request $request, Order $order)
        {
            $order->update($request->except(['_token', '_method']));
            session()->flash('Заказ был успешно обновлен');
            return redirect(route('admin.order.show', ['order' => $order->id]));
        }
    }
