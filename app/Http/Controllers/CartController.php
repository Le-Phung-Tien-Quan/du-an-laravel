<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Order;
use Illuminate\Http\Request;
use Session;


class CartController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (!Session::exists('cart')) {
            Session::put('cart', []);
        }
        $cart = Session::get('cart');
        $totalMoney = 0;

        foreach ($cart as &$item) {
            $product = Product::find($item['id']);
            $item['name'] = $product->name;
            $item['image'] = $product->image;
            $item['slug'] = $product->slug;
            $item['price'] = $product->price;
            $item['sale_price'] = $product->sale_price;
            $item['total'] = ($item['sale_price'] ?: $item['price']) * $item['quantity']; // Đảm bảo tính đúng tổng
            $totalMoney += $item['total'];
        }
        Session::put('cart',$cart);
        $data = [
            'cart' => $cart,
            'totalMoney' => $totalMoney
        ];
        return view('cart.index', $data);
    }



    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Responses
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
{
    if (!Session::exists('cart')) {
        Session::put('cart', []);
    }

    $cart = Session::get('cart');
    $inCart = false;

    foreach ($cart as &$item) {
        // Kiểm tra xem sản phẩm đã có trong giỏ chưa
        if ($item['id'] == $request->id) {
            $item['quantity'] += $request->quantity;  // Cập nhật số lượng
            Session::put('cart', $cart);  // Cập nhật giỏ hàng vào session
            $inCart = true;
            break;
        }
    }

    // Nếu chưa có sản phẩm trong giỏ, thêm mới
    if (!$inCart) {
        Session::push('cart', [
            "id" => $request->id,
            "quantity" => $request->quantity,
        ]);
    }
    return redirect()->back()->with('success', 'Sản phẩm đã được thêm vào giỏ hàng');
}

    // print_r(Session::get('cart'));

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {

    }


    public function updateQuantity(Request $request, $id)
    {
        $cart = Session::get('cart');

        foreach ($cart as &$item) {
            if ($item['id'] == $id) {
                $item['quantity'] = $request->quantity;  // Cập nhật số lượng
                $item['total'] = (isset($item['sale_price']) && $item['sale_price'] > 0 ? $item['sale_price'] : (isset($item['price']) ? $item['price'] : 0)) * $item['quantity'];  // Tính lại tổng
                break;
            }
        }

        Session::put('cart', $cart);  // Lưu giỏ hàng đã cập nhật vào session

        return redirect()->back();  // Tải lại trang
    }



    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $cart = Session::get('cart');

        // Tìm và xóa sản phẩm theo ID
        foreach ($cart as $key => &$item) {
            if ($item['id'] == $id) {
                unset($cart[$key]);  // Xóa sản phẩm khỏi giỏ hàng
                break;
            }
        }

        // Cập nhật lại giỏ hàng vào session
        Session::put('cart', array_values($cart));  // array_values để reset lại key của mảng

        return redirect()->back()->with('success', 'Sản phẩm đã được xóa khỏi giỏ hàng');
    }


}
