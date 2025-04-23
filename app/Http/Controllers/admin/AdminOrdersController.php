<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\OrderDetail;
use App\Models\Product;
use App\Models\Category;

    class AdminOrdersController extends Controller
    {
        /**
         * Display a listing of the resource.
         *
         * @return \Illuminate\Http\Response
         */
        public function index(Request $request)
        {
            $orderstatus = $request->input('status');
            $sort = $request->input('sort');
            $keyword = $request->input('keyword');

            // Tạo query cơ bản cho Order
            $query = Order::with('orderDetails.product');

            // Lọc theo trạng thái
            if ($orderstatus) {
                $query->where('status', $orderstatus);
            }

            // Lọc theo tên người dùng
            if ($keyword) {
                $query->whereHas('user', function ($q) use ($keyword) {
                    $q->where('name', 'like', '%' . $keyword . '%');
                });
            }

            // Sắp xếp theo tên người dùng A-Z hoặc Z-A
            if ($sort == 'az') {
                $query->join('users', 'orders.user_id', '=', 'users.id')
                      ->orderBy('users.name', 'asc')
                      ->select('orders.*');
            } elseif ($sort == 'za') {
                $query->join('users', 'orders.user_id', '=', 'users.id')
                      ->orderBy('users.name', 'desc')
                      ->select('orders.*');
            }

            // Lấy kết quả và phân trang
            $orders = $query->paginate(10)->appends($request->query());

            // Thống kê doanh thu và số lượng đơn hàng
            $totalRevenue = Order::where('status', 'completed')->sum('total_price');
            $totalOrders = Order::count();
            $completedOrders = Order::where('status', 'completed')->count();
            $pendingOrders = Order::where('status', 'pending')->count();

            // Trả về view với dữ liệu
            return view('admin.orders.list', compact(
                'orders',
                'totalRevenue',
                'totalOrders',
                'completedOrders',
                'pendingOrders',
                'orderstatus',
                'sort',
                'keyword'
            ));
        }







        /**
         * Show the form for creating a new resource.
         *
         * @return \Illuminate\Http\Response
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
            //
        }

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
            $order = Order::findOrFail($id);

            // Danh sách các trạng thái hợp lệ, bao gồm 'cancelled'
            $validStatuses = ['pending', 'shipped', 'completed', 'cancelled'];

            // Kiểm tra xem trạng thái có hợp lệ không
            if (!in_array($request->status, $validStatuses)) {
                return back()->withErrors(['status' => 'Trạng thái không hợp lệ.']);
            }

            // Cập nhật trạng thái
            $order->status = $request->status;
            $order->save();

            return redirect('/admin/order')->with('success', 'Trạng thái đơn hàng đã được cập nhật!');
        }


        /**
         * Remove the specified resource from storage.
         *
         * @param  int  $id
         * @return \Illuminate\Http\Response
         */
        public function destroy($id)
        {
            //
        }
    }
