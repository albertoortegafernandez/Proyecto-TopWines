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
        $wine = Wine::find($request->wine_id);
        Cart::add(array(
            'id' => $wine->id,
            'name' => $wine->name,
            'price' => $wine->price,
            'quantity' => $request->quantity ? $request->quantity : 1,
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
        $user=Auth::user();
        return view('checkout',['user'=>$user]);
    }

    public function removeproduct(Request $request)
    {
        Cart::remove(['id'=>$request->id]);
        return back();
    }

    public function delete()
    {
        Cart::clear();
        return back();
    }
    public function procesopedido(Request $request)
    {
        if(count(Cart::getContent())):
            //creamos la nueva orden
            $order= new Order();
            $order->codigo= 'CODE'.time();
            $order->subtotal= number_format(Cart::getSubtotal(),2);
            $order->iva= number_format(Cart::getSubtotal()*0.21,2);
            $order->total= number_format(Cart::getSubtotal()*1.21,2);
            $order->estado=0;
            $order->user_id= Auth::user()->id;
            $order->save();

            foreach(Cart::getContent() as $detail):
                $detalle=new OrderDetail();
                $detalle->quantity= $detail->quantity;
                $detalle->wine_id= $detail->id;
                $detalle->order_id= $order->id;
                $detalle->save();
            endforeach;
            Cart::clear();
            return view("confirmacion",['order'=>$order->codigo]);    
        else:
            return redirect('cart-checkout');
        endif;
    }
}
