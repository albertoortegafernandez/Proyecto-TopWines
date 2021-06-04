<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Cart;
use App\Models\Wine;
use App\Models\Order;
use App\Models\OrderDetail;
use Auth;

class CartController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function add(Request $request)
    {
        //Encontramos el vino con ese id
        $wine = Wine::find($request->wine_id);
        //Agregamos el vino con sus propiedades
        Cart::add(array(
            'id' => $wine->id,
            'name' => $wine->name,
            'price' => $wine->price,
            'quantity' => $request->quantity ? $request->quantity : 1, //Si no obtiene la cantidad del formulario por defecto le añadimos 1
            'attributes' => array(
                'origin' => $wine->origin,
                'category' => $wine->category,
                'image' => $wine->image,
            ),

        ));
        return back();
    }

    public function checkout() //ver todos los productos del carrito
    {
        $user = Auth::user();
        return view('checkout', ['user' => $user]);
    }

    public function removeproduct(Request $request)
    {
        //eliminamos el producto con el id recibido
        Cart::remove(['id' => $request->id]);
        return back();
    }

    public function delete()
    {
        //Eliminamos todo el contenido del carrito
        Cart::clear();
        return back();
    }
    public function procesopedido(Request $request) //Funcion tras la confirmación del pedido crear la order  y los detalles
    {
        //Si existen productos en el carrito
        if (count(Cart::getContent())) :
            //creamos la nueva orden
            $order = new Order();
            $order->codigo = 'CODE' . time(); //Añadimos un codigo único a esa orden de compra
            $order->subtotal = number_format(Cart::getSubtotal(), 2);
            $order->iva = number_format(Cart::getSubtotal() * 0.21, 2);
            $order->total = number_format(Cart::getSubtotal() * 1.21, 2);
            $order->estado = 0; //Añadimos estado 0 como pedido realizado, en un futuro podríamos poner estado 1 = pedido enviado y estado=2 pedido entregado al cliente
            $order->user_id = Auth::user()->id;
            $order->save();

            foreach (Cart::getContent() as $detail) : //Recorremos el contenido del carrito para sacar los detalles de cada producto añadido
                $detalle = new OrderDetail();
                $detalle->quantity = $detail->quantity;
                $detalle->wine_id = $detail->id;
                $detalle->order_id = $order->id;
                $detalle->save();// guardamos los detalles
            endforeach;
            Cart::clear(); //Vaciamos el carrito tras crear la orden
            return view("confirmacion", ['order' => $order->codigo]);
        else :
            return redirect('cart-checkout');
        endif;
    }
}
