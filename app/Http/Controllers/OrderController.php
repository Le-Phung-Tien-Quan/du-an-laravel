<?php
namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\OrderDetail;
use App\Models\Product;
use App\Models\Category;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class OrderController extends Controller
{
    // Hiển thị danh sách đơn hàng của người dùng
    public function index()
    {
        $orders = Order::where('user_id', auth()->id())->get();
        return view('orders.index', compact('orders')); // Thay đổi từ profile.show thành orders.index
    }

    // Hiển thị chi tiết đơn hàng
    public function show(Order $order)
    {
        if ($order->user_id !== auth()->id()) {
            return redirect('/orders')->with('error', 'Bạn không có quyền xem đơn hàng này');
        }

        return view('orders.show', compact('order'));
    }
}
