<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\OrderDetail;
use App\Models\User;
use Auth;

use Illuminate\Http\Request;


class OrderController extends Controller
{

    public function index(Request $request)
    {
        $this->authorize('viewAny',Order::class);
        $user_id = $request->user_id;
        $query = Order::orderBy('created_at','desc');//Ordena en la tabla por orden de fecha mas reciente 
        if (!empty($user_id)) {
            $pedidos = $query->where('user_id', 'like', "%$user_id%");
        }
        $pedidos = $query->paginate(10); //Recogemos los resultados del filtrado

        return view('order.index',['pedidos'=>$pedidos,'user_id'=>$user_id]);
    }

    public function details($id)
    {
        $order=Order::find($id);
        $this->authorize('details',$order);
        $detalles=OrderDetail::where('order_id',$order->id)->get();
       return view('order.details',['order'=>$order,'detalles'=>$detalles]);
    }
}
