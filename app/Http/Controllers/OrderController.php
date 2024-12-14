<?php

namespace App\Http\Controllers;

use App\Models\Campaign;
use App\Models\Order;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{
    //
    public function order()
    {
        $session_products = session()->get("basket",[]);

        $session_products = checkCampaignValidation($session_products);
        $campaignId=0;
        $cost=0;
        foreach($session_products as $product){
            if(isset($product['campaign_id'])){
                $campaignId=$product['campaign_id'];
            }
            else{
                $cost+=floatval($product['price']);
            }
        }
        $user = Auth::user();
        $orderData = [
            'user_id' => $user->id,
            'active_campaign' => $campaignId,
            'products' => json_encode($session_products),
            'total_cost' => $cost,
            'created_at' => now(),
            'updated_at' => now()
        ];
    
        $order = Order::create($orderData);
        session()->put("basket",[]);

        return $session_products;
    }
}
