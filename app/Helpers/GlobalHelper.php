<?php

use App\Models\Campaign;
use App\Models\Order;
use App\Models\Product;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
function checkCampaignValidation($basket)
{
    $period=getPeriodOfValidCampaign();
    if($period!=0){
        $basket=validateCampaignForBasket ($basket, $period);
    }
    else {
        $basket=reCreateBasket($basket);
    }
    return $basket;
}

function reCreateBasket($products){
    $db_products=Product::whereIn("id",$products)->get();
    $returnList=[];
    foreach($products as $product) {
        $db_product=$db_products->firstWhere('id', $product);
        $returnList[]=["pid"=>$product,"price"=>$db_product->price];
    }
    return $returnList;
}
function validateCampaignForBasket ($products,$campaignId) {
    $campaign=Campaign::find($campaignId);
    $db_products=Product::whereIn("id",$products)->get();
    $returnList=[];
    foreach($products as $product) {
        $db_product=$db_products->firstWhere('id', $product);
        $campaign->min_order_cost-=$db_product->price;
        $returnList[]=["pid"=>$product,"price"=>$db_product->price];
    }
    if($campaign->min_order_cost<=0) {
        foreach($campaign->products as $prod) {
            $returnList[]=["pid"=>$prod->id, "price"=>0, "campaign_id"=>$campaign->id];
        }
    }

    return $returnList;
}

function getPeriodOfValidCampaign()
{
    $user=Auth::user();
    $monthLen=calculateDifference($user->created_at);
    $dateAr=explode("-",$user->created_at);
    if($monthLen==0 && checkMonthlyOrders($user->id)) {
        return $dateAr[1];
    }
    elseif($monthLen==1 && checkUsedCampaigns($user->id, $dateAr[1]) && checkMonthlyOrders($user->id)) {
        return ($dateAr[1]%12)+1;
    }
    elseif($monthLen==2 && checkUsedCampaigns($user->id, $dateAr[1]) && checkUsedCampaigns($user->id,($dateAr[1]%12)+1) && checkMonthlyOrders($user->id)) {
        return (($dateAr[1]+1)%12)+1;
    }
    else{
        return 0;
    }
}

function checkMonthlyOrders($userId){
    return !Order::where('user_id', $userId)
        ->whereMonth('created_at', Carbon::now()->month)
        ->exists();
}

function checkUsedCampaigns($userId, $campaignId) {
    // Kullanıcının siparişlerini ve kampanyayı filtreleyin
    $orders = Order::where('user_id', $userId)
        ->where('active_campaign', $campaignId)
        ->get();

    // Siparişlerin boş olup olmadığını kontrol edin
    return !$orders->isEmpty();
}


function calculateDifference($createdAt)
{
    // 'created_at' verisini Carbon nesnesine dönüştür
    $createdAt = Carbon::parse($createdAt)->startOfMonth();

    // Bugünkü tarihi al
    $now = Carbon::now()->startOfMonth();

    // Sadece tam ay farkını al
    return $createdAt->diffInMonths($now);
}
