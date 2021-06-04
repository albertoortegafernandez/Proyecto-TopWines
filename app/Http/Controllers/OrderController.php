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
        //Politica de autorización
        $this->authorize('viewAny',Order::class);
        $user_id = $request->user_id;//Recogemos el id obtenido del formulario de busqueda
        $query = Order::orderBy('created_at','desc');//Ordena en la tabla por orden de fecha mas reciente
        if (!empty($user_id)) {
            $pedidos = $query->where('user_id', 'like', "%$user_id%");
        }
        $pedidos = $query->paginate(10); //Recogemos los resultados del filtrado

        return view('order.index',['pedidos'=>$pedidos,'user_id'=>$user_id]);
    }

    public function details($id)
    {
        //Buscamos el id  recibido perteneciente a la orden con ese id
        $order=Order::find($id);
        //Politicas de autorizacion
        $this->authorize('details',$order);
        //Obtener los detalles del pedido con el id recibido
        $detalles=OrderDetail::where('order_id',$order->id)->get();
       return view('order.details',['order'=>$order,'detalles'=>$detalles]);
    }
}
