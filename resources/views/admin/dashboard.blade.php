@extends('layouts.admin')
@section('body1')
<!-- [ Header ] end -->



  <!-- [ Main Content ] start -->
  <div class="pc-container">
    <div class="pc-content">
      <!-- [ breadcrumb ] start -->
      <div class="page-header">
        <div class="page-block">
          <div class="row align-items-center">
            <h2 class="mb-0">Trang thống kê thông tin</h2>
          </div>
        </div>
      </div>
      <!-- [ breadcrumb ] end -->
      <!-- [ Main Content ] start -->
      <div class="row">
        <!-- [ sample-page ] start -->
        <div class="col-md-6 col-xl-3">
            <div class="card">
              <div class="card-body">
                <h6 class="mb-2 f-w-400 text-muted">Tổng lượt xem</h6>
                <h4 class="mb-3">{{ $totalViews }} </h4>
                <p class="mb-0 text-muted text-sm">Tổng lượt xem tất cả sản phẩm</p>
              </div>
            </div>
          </div>

          <div class="col-md-6 col-xl-3">
            <div class="card">
              <div class="card-body">
                <h6 class="mb-2 f-w-400 text-muted">Tổng người dùng</h6>
                <h4 class="mb-3">{{ $totalUsers }}</h4>
                <p class="mb-0 text-muted text-sm">Tổng số người dùng</p>
              </div>
            </div>
          </div>

          <div class="col-md-6 col-xl-3">
            <div class="card">
              <div class="card-body">
                <h6 class="mb-2 f-w-400 text-muted">Tổng đơn hàng</h6>
                <h4 class="mb-3">{{ $totalOrders }} </h4>
                <p class="mb-0 text-muted text-sm">Tổng số đơn hàng đã hoàn thành</p>
              </div>
            </div>
          </div>

          <div class="col-md-6 col-xl-3">
            <div class="card">
              <div class="card-body">
                <h6 class="mb-2 f-w-400 text-muted">Tổng doanh thu</h6>
                <h4 class="mb-3">${{ number_format($totalSales) }} VND</h4>
                <p class="mb-0 text-muted text-sm">Tổng doanh thu từ các đơn hàng đã hoàn thành</p>
              </div>
            </div>
          </div>




          <div class="col-md-12 col-xl-8">
            <div class="d-flex align-items-center justify-content-between mb-3">
              <h5 class="mb-0">Doanh thu</h5>
              <ul class="nav nav-pills justify-content-end mb-0" id="revenue-tab" role="tablist">
                <li class="nav-item" role="presentation">
                  <button class="nav-link" id="revenue-month-tab" data-bs-toggle="pill" data-bs-target="#revenue-month"
                    type="button" role="tab" aria-controls="revenue-month" aria-selected="false">Tháng</button>
                </li>
                <li class="nav-item" role="presentation">
                  <button class="nav-link active" id="revenue-week-tab" data-bs-toggle="pill" data-bs-target="#revenue-week"
                    type="button" role="tab" aria-controls="revenue-week" aria-selected="true">Tuần</button>
                </li>
              </ul>
            </div>
            <div class="card">
              <div class="card-body">
                <div class="tab-content" id="revenue-tabContent">
                  <div class="tab-pane fade" id="revenue-month" role="tabpanel" aria-labelledby="revenue-month-tab">
                    <canvas id="monthlyRevenueChart"></canvas>
                  </div>
                  <div class="tab-pane fade show active" id="revenue-week" role="tabpanel" aria-labelledby="revenue-week-tab">
                    <canvas id="weeklyRevenueChart"></canvas>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
          <script>
            // Data từ controller
            const weeklyRevenue = @json($weeklySales); // [{label: 'Mon', total: 1000000}, ...]
            const monthlyRevenue = @json($monthlySales); // {1: 1tr, 2: 2tr, ..., 12: x}

            // Chuẩn hóa data
            const weekLabels = weeklyRevenue.map(item => item.label);
            const weekData = weeklyRevenue.map(item => item.total);

            const monthLabels = ["T1", "T2", "T3", "T4", "T5", "T6", "T7", "T8", "T9", "T10", "T11", "T12"];
            const monthData = monthLabels.map((_, i) => monthlyRevenue[i + 1] ?? 0);

            // Gradient helper
            function createGradient(ctx, color) {
              const gradient = ctx.createLinearGradient(0, 0, 0, 300);
              gradient.addColorStop(0, color + '88'); // màu đậm hơn trên
              gradient.addColorStop(1, color + '00'); // trong suốt dưới
              return gradient;
            }

            // Vẽ tuần
            const weeklyCtx = document.getElementById('weeklyRevenueChart').getContext('2d');
            const weeklyGradient = createGradient(weeklyCtx, '#36a2eb');

            new Chart(weeklyCtx, {
              type: 'line',
              data: {
                labels: weekLabels,
                datasets: [{
                  label: 'Doanh thu tuần',
                  data: weekData,
                  fill: true,
                  backgroundColor: weeklyGradient,
                  borderColor: '#36a2eb',
                  tension: 0.4,
                  pointRadius: 3,
                  pointBackgroundColor: '#36a2eb'
                }]
              },
              options: {
                responsive: true,
                scales: {
                  y: {
                    beginAtZero: true,
                    ticks: {
                      callback: val => val.toLocaleString('vi-VN') + ' ₫'
                    }
                  }
                }
              }
            });

            // Vẽ tháng
            const monthlyCtx = document.getElementById('monthlyRevenueChart').getContext('2d');
            const monthlyGradient = createGradient(monthlyCtx, '#ff6384');

            new Chart(monthlyCtx, {
              type: 'line',
              data: {
                labels: monthLabels,
                datasets: [{
                  label: 'Doanh thu tháng',
                  data: monthData,
                  fill: true,
                  backgroundColor: monthlyGradient,
                  borderColor: '#ff6384',
                  tension: 0.4,
                  pointRadius: 3,
                  pointBackgroundColor: '#ff6384'
                }]
              },
              options: {
                responsive: true,
                scales: {
                  y: {
                    beginAtZero: true,
                    ticks: {
                      callback: val => val.toLocaleString('vi-VN') + ' ₫'
                    }
                  }
                }
              }
            });
          </script>

<div class="col-md-12 col-xl-4">
    <h5 class="mb-3">Sản phẩm mới</h5>
    <div class="card">
      <div class="card-body">
        <h6 class="mb-2 f-w-400 text-muted">Sản phẩm mới trong tuần</h6>
        <h3 class="mb-3">{{ $newProductsCount }} sản phẩm</h3>
        <canvas id="product-overview-chart" height="250"></canvas>
      </div>
    </div>
  </div>
  <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
  <script>
    const dailyProductData = @json($dailyProducts); // [5, 2, 4, 7, 3, 6, 1]
    const weekDays = ["Mon", "Tue", "Wed", "Thu", "Fri", "Sat", "Sun"];

    const ctx = document.getElementById("product-overview-chart").getContext("2d");

new Chart(ctx, {
  type: 'bar',
  data: {
    labels: weekDays,
    datasets: [{
      label: "Sản phẩm mới",
      data: dailyProductData,
      backgroundColor: '#36a2eb',
      borderRadius: 4,
      barThickness: 18 // chỉnh nhỏ hơn chút cho đẹp
    }]
  },
  options: {
    plugins: { legend: { display: false } },
    scales: {
      y: {
        beginAtZero: true,
        ticks: {
          precision: 0,
          stepSize: 1,
          max: Math.max(...dailyProductData) + 2 // đặt max vừa đủ
        },
        grid: { display: false }
      },
      x: {
        grid: { display: false }
      }
    },
    responsive: true,
    maintainAspectRatio: true // giữ tỉ lệ nhỏ gọn
  }
});

  </script>



<div class="col-md-12 col-xl-8">
    <h5 class="mb-3">Thông tin đơn hàng</h5>
    <div class="card tbl-card">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-hover table-borderless mb-0">
                    <thead>
                        <tr>
                            <th>Id đơn hàng</th>
                            <th>Trạng thái đơn hàng</th>
                            <th class="text-end">Tổng tiền đơn hàng</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($orders as $order)
                                <tr>
                                    <td><a href="#" class="text-muted">{{ $order->id }}</a></td>
                                    <td>
                                        <span class="d-flex align-items-center gap-2">
                                            @if($order->status == 'completed')
                                                <i class="fas fa-circle text-success f-10 m-r-5"></i>Hoàn thành
                                            @elseif($order->status == 'pending')
                                                <i class="fas fa-circle text-warning f-10 m-r-5"></i>Đang xử lý
                                            @elseif($order->status == 'shipped')
                                                <i class="fas fa-circle text-info f-10 m-r-5"></i>Đang giao
                                            @else
                                                <i class="fas fa-circle text-danger f-10 m-r-5"></i>Đã hủy
                                            @endif
                                        </span>
                                    </td>
                                    <td class="text-end">{{ number_format($order->total_price) }} VND</td>
                                </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<div class="col-md-12 col-xl-4">
    <h5 class="mb-3">Sản phẩm nổi bật</h5>
    <div class="card">
        <div class="list-group list-group-flush">
            @foreach($featuredProducts as $product)
            <a href="/detail/{{ $product->slug }}" class="list-group-item list-group-item-action d-flex align-items-center justify-content-between">
        <img src="{{ asset('') }}img/{{ $product->image }}" alt="" width="50px">
                    {{ $product->name }}
                    <span class="h5 mb-0" style="font-size: 14px">{{ number_format($product->price) }} VND</span>
                </a>
            @endforeach
        </div>
        <div class="card-body px-2">
            <div id="featured-products-chart"></div>
        </div>
    </div>
</div>




<div class="col-md-12 col-xl-8">
    <h5 class="mb-3">Người dùng mới theo tuần</h5>
    <div class="card">
        <div class="card-body">
            <div id="user-trend-chart" style="height: 300px;"></div>
        </div>
    </div>
</div>
<script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>
<script>
    var options = {
        chart: {
            type: 'line',
            height: 300,
            toolbar: { show: false }
        },
        series: [{
            name: 'Người dùng mới trong tuần',
            data: @json($weeklyUserStats)
        }],
        xaxis: {
            categories: ['T2', 'T3', 'T4', 'T5', 'T6', 'T7', 'CN'], // Tên thứ trong tuần
            title: { text: 'Thứ trong tuần' }
        },
        yaxis: {
            title: { text: 'Số người dùng' }
        },
        stroke: {
            curve: 'smooth',
            width: 3
        },
        colors: ['#00b894'],
        markers: {
            size: 4,
            strokeWidth: 2
        }
    };

    var chart = new ApexCharts(document.querySelector("#user-trend-chart"), options);
    chart.render();
</script>



<div class="col-md-12 col-xl-4">
    <h5 class="mb-3">Lịch sử đơn hàng</h5>
    <div class="card">
        <div class="list-group list-group-flush">
            @foreach($recentOrders as $order)
                <a href="#" class="list-group-item list-group-item-action">
                    <div class="d-flex">
                        <div class="flex-shrink-0">
                            <div class="avtar avtar-s rounded-circle
                                {{ $order->status === 'completed' ? 'text-success bg-light-success' :
                                   ($order->status === 'pending' ? 'text-warning bg-light-warning' : 'text-danger bg-light-danger') }}">
                                <i class="ti ti-shopping-cart f-18"></i>
                            </div>
                        </div>
                        <div class="flex-grow-1 ms-3">
                            <h6 class="mb-1">Đơn hàng mã #{{ $order->id }}</h6>
                            <p class="mb-0 text-muted">{{ $order->created_at->diffForHumans() }}</p>
                        </div>
                        <div class="flex-shrink-0 text-end">
                            <h6 class="mb-1">{{ number_format($order->total_price, 2) }} VND</h6>
                            <p class="mb-0 text-muted text-capitalize">{{ $order->status }}</p>
                        </div>
                    </div>
                </a>
            @endforeach
        </div>
    </div>
</div>

      </div>
    </div>
  </div>
  <!-- [ Main Content ] end -->
  @endsection
