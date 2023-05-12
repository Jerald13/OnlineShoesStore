<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Product;
use App\Models\User;
use Exception;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\RequestException;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function orderList(){
        if(auth()->user()->getAttribute("isAdmin") != 1) {
            return redirect()->route('usernamelogin');
        }
        $orders = Order::with('user', 'product')->get();
        return view('orders', compact('orders'));
    }

    public function completeOrder($id){
        if(auth()->user()->getAttribute("isAdmin") != 1) {
            return redirect()->route('usernamelogin');
        }
        $order = Order::find($id);
        $order->update(["complete" => 1]);
        return redirect()->route('orderList');
    }

    public function orders(){
        if(auth()->user()== null) {
            return redirect()->route('usernamelogin');
        }

        $orders = Order::where("userid", "=", Auth::id())->orderBy('created_at', 'desc')->get();

        return view('orderlist', compact('orders'));
    }

    public function checkout($id){
        if(auth()->user()== null) {
            return redirect()->route('usernamelogin');
        }
        $product = Product::find($id);
        try {
            $client = new Client();
            $response = $client->request('GET', 'http://localhost:8081/api/getBank');

            $banks = json_decode($response->getBody(), true);
            $error = null;
            return view('checkout', compact('product', 'banks', 'error'));
        }catch(Exception $e){
            $error = "Service Unavailable";
            return view('checkout', compact('product', 'error'));
        }
    }

    public function buyProduct(Request $request){
        if(auth()->user()== null) {
            return redirect()->route('usernamelogin');
        }
        $userId = Auth::id();
        $productId = $request->input('id');
        $price = Product::find($productId)->getAttribute('price');
        $address = $request->input('address');

        $product = Product::find($productId);
        $product->quantity -= 1;
        $product->save();

        Order::create([
            "userId" => $userId,
            "productId" => $productId,
            "totalPrice" => $price,
            "address" => $address
        ]);

        $user = User::find(Auth::id());

        $user->update(["point" => intval($price)]);

        return redirect()->route('orders');
    }
}
