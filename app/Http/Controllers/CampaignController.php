<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use \App\Models\Campaign;
class CampaignController extends Controller
{
    public function index()
    {
        $campaigns = Campaign::all();
        return view('campaigns',['campaigns'=>$campaigns]);
    }

    public function get($id)
    {
        //return Campaign::where(['id'=>$id])->get()->toJson();
        return Campaign::find($id)->toJson();
    }

    public function update(Request $request, $id)
    {
        $campaign = Campaign::find($id);

        if ($campaign) {
            $campaign->min_order_cost = $request->input('min_order_cost');
            $campaign->save();
            return response()->json(['success' => true, 'message' => 'Kampanya başarıyla güncellendi']);
        } else {
            return response()->json(['success' => false, 'message' => 'Kampanya bulunamadı']);
        }
    }
}
