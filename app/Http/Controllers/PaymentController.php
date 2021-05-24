<?php

namespace App\Http\Controllers;
use PayPal\Api\Payer;
use PayPal\Api\Amount;
use PayPal\Api\Payment;
use PayPal\Api\Transaction;
use PayPal\Rest\ApiContext;
use Illuminate\Http\Request;
use PayPal\Api\RedirectUrls;
use PayPal\Api\PaymentExecution;
use PayPal\Auth\OAuthTokenCredential;
use Illuminate\Support\Facades\Config;
use PayPal\Exception\PayPalConnectionException;

class PaymentController extends Controller
{
    private $apiContext;

    public function __construct()
    {
        $payPalConfig= Config::get('paypal');
        
        $this->apiContext = new ApiContext(
            new OAuthTokenCredential(
                $payPalConfig['client_id'],
                $payPalConfig['secret']
            )
        );
    }

    public function payWithPaypal()
    {
        $payer = new Payer();//Creamos el usuario que va a pagar
        $payer->setPaymentMethod('paypal');

        $amount = new Amount();//Creamos la cantidad que va a pagar
        $amount->setTotal('3.99');//precio fijo tendria que obtenerlo del formulario
        $amount->setCurrency('EUR');

        $transaction = new Transaction();//creamos una transaccion
        $transaction->setAmount($amount);
        
        $callbackUrl = url('/paypal/status');

        $redirectUrls = new RedirectUrls();
        $redirectUrls->setReturnUrl($callbackUrl)
            ->setCancelUrl($callbackUrl);

        $payment = new Payment();//Informacion de la venta
        $payment->setIntent('venta')
            ->setPayer($payer)//Asociamos el usuario
            ->setTransactions(array($transaction))//Asociamos la transaccion
            ->setRedirectUrls($redirectUrls);//Redireccionamos 

        try {
            $payment->create($this->apiContext);//Llamamos a la variable que contienen nuestras credenciales de Paypal y creamos el pago
            return redirect()->away($payment->getApprovalLink());//redirect away se utiliza para rutas externas
        } catch (PayPalConnectionException $ex) {
            echo $ex->getData();
        }
    }

    public function payPalStatus(Request $request)
    {
        dd($request->all());
       /* $paymentId = $request->input('paymentId');
        $payerId = $request->input('PayerID');
        $token = $request->input('token');

        if (!$paymentId || !$payerId || !$token) {
            $status = 'Lo sentimos! El pago a través de PayPal no se pudo realizar.';
            return redirect('/paypal/failed')->with(compact('status'));
        }

        $payment = Payment::get($paymentId, $this->apiContext);

        $execution = new PaymentExecution();
        $execution->setPayerId($payerId);

        
        $result = $payment->execute($execution, $this->apiContext);

        if ($result->getState() === 'approved') {
            $status = 'Gracias! El pago a través de PayPal se ha ralizado correctamente.';
            return redirect('/results')->with(compact('status'));
        }

        $status = 'Lo sentimos! El pago a través de PayPal no se pudo realizar.';
        return redirect('/results')->with(compact('status'));*/
    }
}
