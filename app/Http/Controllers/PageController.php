<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Category;
use App\Models\User;


class PageController extends Controller
{
    function home(){
        $products = Product::all();
        $views = Product::orderBy('views', 'desc')->take(4)->get();
        $categories = Category::all();
        $phongkhach = Product::whereIn('category_id', [1, 4, 7])
                           ->orderBy('views', 'desc')
                           ->take(4)
                           ->get();
        $phongbep = Product::whereIn('category_id', [1, 2])
                           ->orderBy('views', 'desc')
                           ->take(4)
                           ->get();

        // Debug giá trị của sale_price cho từng sản phẩm trong $phongbep
        foreach ($phongbep as $item) {
            \Log::info('Sale Price: ' . $item->sale_price);
        }

        return view('page.home', [
            'products' => $products,
            'categories' => $categories,
            'views' => $views,
            'phongkhach' => $phongkhach,
            'phongbep' => $phongbep
        ]);
    }


    function user(){
        return view('layouts.user');
    }
    function contact(){
        return view('page.contact');
    }
}
