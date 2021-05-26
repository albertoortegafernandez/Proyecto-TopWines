<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\OrderDetail;
use App\Models\User;
use Auth;

use Illuminate\Http\Request;


class OrderController extends Controller
{

    public function index()
    {
        $this->authorize('viewAny',Order::class);
        $pedidos=Order::query()->paginate(10);
        return view('order.index',['pedidos'=>$pedidos]);
    }

    public function details($id)
    {
        $order=Order::find($id);
        $this->authorize('details',$order);
        $detalles=OrderDetail::where('order_id',$order->id)->get();
       return view('order.details',['order'=>$order,'detalles'=>$detalles]);
    }
}
