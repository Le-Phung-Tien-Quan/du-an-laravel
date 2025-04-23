<?php
namespace App\Http\Controllers\admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\Category;
use App\Models\Order;  // Thêm model Order
use App\Models\User;   // Thêm model User
use Carbon\Carbon; // Thêm Carbon để xử lý ngày tháng


class AdminController extends Controller
{
    public function dashboard()
{
    // Tổng lượt xem của tất cả sản phẩm (có thể dùng bảng products để thống kê)
    $totalViews = Product::sum('views');

    // Tổng số đơn hàng đã hoàn thành (completed)
    $totalOrders = Order::where('status', 'completed')->count();

    // Tổng doanh thu từ các đơn hàng đã hoàn thành
    $totalSales = Order::where('status', 'completed')->sum('total_price');

    // Tổng người dùng
    $totalUsers = User::count();

    // Lợi nhuận (Ví dụ: Tổng doanh thu trừ chi phí, nếu có chi phí thì tính vào)
    $profit = $totalSales * 0.1;

    // Tổng số đơn hàng trong tháng
  // Doanh thu theo tháng trong năm hiện tại
$monthlySales = Order::where('status', 'completed')
->whereYear('created_at', Carbon::now()->year)
->selectRaw('MONTH(created_at) as month, SUM(total_price) as total')
->groupBy('month')
->orderBy('month')
->pluck('total', 'month');

// Doanh thu theo tuần trong tháng hiện tại
$weeklySales = [];
$startOfMonth = Carbon::now()->startOfMonth();
$endOfMonth = Carbon::now()->endOfMonth();
$current = $startOfMonth->copy();

while ($current->lt($endOfMonth)) {
$startOfWeek = $current->copy()->startOfWeek();
$endOfWeek = $current->copy()->endOfWeek()->min($endOfMonth);

$weekTotal = Order::where('status', 'completed')
    ->whereBetween('created_at', [$startOfWeek, $endOfWeek])
    ->sum('total_price');

$weeklySales[] = [
    'label' => 'Tuần ' . $startOfWeek->format('d/m') . ' - ' . $endOfWeek->format('d/m'),
    'total' => $weekTotal
];

$current->addWeek();
}
 // Tổng số sản phẩm trong tuần
 $newProductsCount = Product::whereBetween('created_at', [
    Carbon::now()->startOfWeek(),
    Carbon::now()->endOfWeek()
])->count();

// Lấy số lượng theo từng ngày trong tuần (Mon -> Sun)
$productsByDay = Product::selectRaw('DAYOFWEEK(created_at) as day, COUNT(*) as total')
    ->whereBetween('created_at', [Carbon::now()->startOfWeek(), Carbon::now()->endOfWeek()])
    ->groupBy('day')
    ->pluck('total', 'day'); // trả về: [2 => 5, 3 => 7, ...]

// Chuẩn hóa dữ liệu 7 ngày (1 = Chủ nhật, 2 = Thứ 2, ..., 7 = Thứ 7)
$dailyProducts = [];
foreach (range(2, 8) as $d) {
    $day = $d > 7 ? 1 : $d; // chuyển 8 thành 1 (Chủ nhật)
    $dailyProducts[] = $productsByDay[$day] ?? 0;
}

// Lấy tất cả các đơn hàng và các chi tiết đơn hàng bao gồm tên sản phẩm
$orders = Order::with('orderDetails.product')->get();

$featuredProducts = Product::orderByDesc('views') // Order by views in descending order
    ->take(4) // Get the top 3 products
    ->get();

// Người dùng mới trong tuần này
$newUsersThisWeek = User::whereBetween('created_at', [
    Carbon::now()->startOfWeek(),
    Carbon::now()->endOfWeek(),
])->count();

// Người dùng mới trong tháng này
$newUsersThisMonth = User::whereMonth('created_at', Carbon::now()->month)
                         ->whereYear('created_at', Carbon::now()->year)
                         ->count();

// Thống kê theo ngày trong tuần
$weeklyUserStats = [];
$startOfWeek = Carbon::now()->startOfWeek();
for ($i = 0; $i < 7; $i++) {
    $date = $startOfWeek->copy()->addDays($i)->format('Y-m-d');
    $count = User::whereDate('created_at', $date)->count();
    $weeklyUserStats[] = $count;
}
$recentOrders = Order::take(5)->get(); // Lấy 5 đơn hàng bất kỳ


return view('admin.dashboard', compact(
'totalViews', 'totalOrders', 'totalSales', 'totalUsers',
'profit', 'monthlySales', 'weeklySales','newProductsCount', 'dailyProducts','orders','featuredProducts',
'newUsersThisWeek', 'newUsersThisMonth','weeklyUserStats','recentOrders'
));

}
}
