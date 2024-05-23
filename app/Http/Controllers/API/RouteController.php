<?php

namespace App\Http\Controllers\API;

use App\Models\Order;
use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class RouteController extends Controller
{
    public function productList() {
        $products = Product::get();
        return response()->json($data,200);
    }

    public function categoryList() {
        $category = Category::get();
        return response()->json($category,200);
    }

    public function orderList() {
        $order = Order::get();
        $products = Product::get();
        $category = Category::get();
        $data = [
            'order'=>$order,
            'product'=>$products,
            'category'=>$category
        ];
        return response()->json($data,200);
    }

}
