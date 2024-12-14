<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class BasketController extends Controller
{
    public function add($id) {
        $basket = session()->get('basket', []);
        $basket[] = $id;
        session()->put('basket', $basket);

        return response()->json([
            'success' => true,
            'message' => 'Ürün sepete eklendi.',
            'count' => count($basket),
        ]);
    }

    public function get() {
        $sessionProducts=session()->get('basket', []);
        $products = Product::whereIn("id", $sessionProducts)->get();
        foreach ($sessionProducts as $key => $value) {
            $product = $products->firstWhere('id', $value);
            $sessionProducts[$key] = $product;
        }
    
        return view('basket', ['products' => $sessionProducts]);
    }

    public function remove($id)
    {
        $basket = session()->get('basket', []);
        unset($basket[$id]);
        session()->put('basket', $basket);
        
        return response()->json(['success' => true]);
    }
}
