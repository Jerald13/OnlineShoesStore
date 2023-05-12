<?php

namespace App\Http\Controllers;

use App\Models\User;
use Exception;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\RequestException;
use Illuminate\Support\Facades\Auth;

class FreeGiftController extends Controller
{

    public function freeGiftForm()
    {
        if (auth()->user() == null) {
            return redirect()->route('usernamelogin');
        }

        try {
            $client = new Client();
            $response = $client->request('GET', 'http://localhost:8081/api/getFreeGift');
            $error = null;

            $gifts = json_decode($response->getBody(), true);
            return view('freegift', compact('gifts', 'error'));
        } catch (Exception $e) {
            $error = "Service Not Available";
            return view('freegift', compact('error'));
        }
    }

    public function redeem($point, $id)
    {
        if (auth()->user() == null) {
            return redirect()->route('usernamelogin');
        }

        $user = User::find(Auth::id());
        $user->point -= $point;

        $user->save();

        $client = new Client();
        $response = $client->request('GET', 'http://127.0.0.1:8081/api/redeemGift/' . $id);
        return redirect()->route('getFreeGift');
    }
}
