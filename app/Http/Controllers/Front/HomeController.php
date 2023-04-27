<?php

namespace App\Http\Controllers\Front;
use App\helpers\FakerURL;
use App\Http\Controllers\Controller;
use App\Http\Requests\BuyProduct;
use App\Models\Order;
use App\Models\Payment;
use App\Models\Product;
use Illuminate\Support\Facades\DB;
use Stripe\Charge;
use Stripe\Stripe;

class HomeController extends Controller
{
    public function index()
    {
        $products = Product::get();
        return view('front.index',compact('products'));
    }

    public function detail($productId)
    {
        $product = Product::findOrFail(FakerURL::id_d($productId));
        return view('front.detail',compact('product'));
    }

    public function productBuy(BuyProduct $request,$productFakerId)
    {
        DB::beginTransaction();
        try {
            $product = Product::findOrFail(FakerURL::id_d($productFakerId));
            $productHalfPrice = $product->price / 2;
            $request = $request->all();
            $stripe = new \Stripe\StripeClient(env('STRIPE_SECRET_KEY'));
            $cardDetail = [
                'number'    => $request['card_number'],
                'exp_month' => $request['expiry_month'],
                'exp_year'  => $request['expiry_year'],
                'cvc'       => $request['card_cvc']
            ];
            $firstToken = $stripe->tokens->create([
                'card' => $cardDetail
            ]);
            if (!isset($firstToken['id'])) {
                return response()->json([
                    'status' => 'error',
                    'msg'    => 'The Stripe Token was not generated correctly'
                ]);
            }
            /*Capture True Part*/
            $firstCharge = $stripe->charges->create([
                'card' => $firstToken['id'],
                'currency' => 'usd',
                'amount' => $productHalfPrice.'00',
                'description' => 'Product first half payment',
                'receipt_email' => $request['email'],
                'capture' => true
            ]);
            if ($firstCharge['status'] == 'succeeded'){
                $order = Order::create([
                    'email' => $request['email'],
                    'product_id' => $product->id
                ]);
                if (!empty($order)) {
                    $firstPaymentRes = Payment::create([
                        'order_id' => $order->id,
                        'charge_id' => $firstCharge['id'],
                        'status' => 1
                    ]);
                    if (!empty($firstPaymentRes)) {
                        $secondToken = $stripe->tokens->create([
                            'card' => $cardDetail
                        ]);
                        if (!isset($secondToken['id'])) {
                            return response()->json([
                                'status' => 'error',
                                'msg'    => 'The Stripe Token was not generated correctly'
                            ]);
                        }
                        /*Capture False Part*/
                        $secondCharge = $stripe->charges->create([
                            'card' => $secondToken['id'],
                            'currency' => 'usd',
                            'amount' => $productHalfPrice.'00',
                            'description' => 'Product second half payment',
                            'receipt_email' => $request['email'],
                            'capture' => false
                        ]);
                        if ($secondCharge['status'] == 'succeeded'){
                            $emailSendRes = sendEmail('email.confirm_order',$order,'Order Confirmation');
                            if (!empty($emailSendRes)) {
                                $secondPaymentRes = Payment::create([
                                    'order_id' => $order->id,
                                    'charge_id' => $secondCharge['id'],
                                    'status' => 0
                                ]);
                                if (!empty($secondPaymentRes)) {
                                    DB::commit();
                                    return response()->json([
                                        'status' => 'success',
                                        'msg'    => 'Transaction has been successfully completed'
                                    ]);
                                }
                            }
                        }
                    }
                }
            }
            return response()->json([
                'status' => 'error',
                'msg'    => 'Transaction has been failed'
            ]);
        } catch (\Exception $e) {
            DB::rollback();
            return response()->json([
                'status' => 'error',
                'msg'    => 'Transaction has been failed',
                'error'  => $e->getMessage()
            ]);
        }
    }

    public function orderConfirm($orderId)
    {
        $order = Order::findOrFail(FakerURL::id_d($orderId));
        $payment = Payment::where([
            'order_id' => $order->id,
            'status'   => 0
        ])->first();
        if (!empty($payment)) {
            Stripe::setApiKey(env('STRIPE_SECRET_KEY'));
            $charge = Charge::retrieve($payment->charge_id);
            $res = $charge->capture();
            if ($res['status'] == 'succeeded'){
                $paymentRes = $payment->update(['status' => 1]);
                if (!empty($paymentRes)) {
                    return redirect()->route('order.thankYou');
                }
            }
        }
        abort(404);
    }

    public function orderThankyou()
    {
        return view('front.thank_you');
    }
}
