<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Cart;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Product;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CheckoutController extends Controller
{
    public function index(){
        $old_cartitems = Cart::where('user_id',Auth::id())->get();
        foreach ($old_cartitems as $item) {
            if(!Product::where('id',$item->prod_id)->where('qty','>=',$item->prod_qty)->exists())
            {
                $removeItem = Cart::where('user_id',Auth::id())->where('prod_id',$item->prod_id)->first();
                $removeItem->delete();
            }
        }
        $cartitems = Cart::where('user_id',Auth::id())->get();

        return view('frontend.checkout',compact('cartitems'));
    }

    public function placeorder(Request $request){
        $order = new Order();
        $order->user_id = Auth::id();
        $order->fname = $request->input('fname');
        $order->lname = $request->input('lname');
        $order->email = $request->input('email');
        $order->phone = $request->input('phone');
        $order->address1 = $request->input('address1');
        $order->address2 = $request->input('address2');
        $order->city = $request->input('city');
        $order->state = $request->input('state');
        $order->country = $request->input('country');
        $order->pincode = $request->input('pincode');

        $total = 0;
        $cartitems_total = Cart::where('user_id',Auth::id())->get();
        foreach ($cartitems_total as $prod) {
            $total += $prod->products->selling_price * $prod->prod_qty;
        }

        $order->total_price = $total;

        $order->tracking_no = 'admin'.rand(1111,9999);
        $order->save();

        $order->id;

        $cartitems = Cart::where('user_id',Auth::id())->get();
        foreach ($cartitems as $item){
            OrderItem::create([
                'order_id'=>$order->id,
                'prod_id'=> $item->prod_id,
                'qty'=>$item->prod_qty,
                'price'=>$item->products->selling_price,
            ]);

            // Reducing number of quantity after placing order
            $prod = Product::where('id',$item->prod_id)->first();
            $prod->qty = $prod->qty - $item -> prod_qty;
            $prod->update();
        }

        //Filling in users table for easy access next time
        if(Auth::user()->address1 == null)
        {
        $user = User::where('id',Auth::id())->first();
        $user->name = $request->input('fname');
        $user->lname = $request->input('lname');
        $user->phone = $request->input('phone');
        $user->address1 = $request->input('address1');
        $user->address2 = $request->input('address2');
        $user->city = $request->input('city');
        $user->state = $request->input('state');
        $user->country = $request->input('country');
        $user->pincode = $request->input('pincode');
        $user->update();

        }
        $cartitems = Cart::where('user_id',Auth::id())->get();
        Cart::destroy($cartitems);

        return redirect('/')->with('status', 'Order Placed Successfully');
    }


    public function verifypayment(Request $request){
        $amount =$request->amount;
        $token =$request->token;
        $args = http_build_query(array(
            'token' => $token,
            'amount'  => $amount
          ));
          
          $url = "https://khalti.com/api/v2/payment/verify/";
          
          # Make the call using API.
          $ch = curl_init();
          curl_setopt($ch, CURLOPT_URL, $url);
          curl_setopt($ch, CURLOPT_POST, 1);
          curl_setopt($ch, CURLOPT_POSTFIELDS,$args);
          curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
          
          $headers = ['Authorization: Key test_secret_key_e75bed6b8ffb4b82b93f34c99a82d142'];
          curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
          
          // Response
          $response = curl_exec($ch);
          $status_code = curl_getinfo($ch, CURLINFO_HTTP_CODE);
          curl_close($ch);

          return $response;
    }
    
}
