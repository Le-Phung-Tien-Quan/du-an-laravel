@extends('layouts.admin')

@section('body1')
<link rel="stylesheet" href="{{ asset('css/plugins/dataTables.bootstrap5.min.css') }}">
<link rel="stylesheet" href="{{ asset('css/plugins/responsive.bootstrap5.min.css') }}">

<section class="pc-container">
  <div class="pc-content">
    <div class="page-header">
      <div class="page-block">
        <div class="row align-items-center">
          <div class="col-md-12">
            <div class="page-header-title d-flex justify-content-between">
              <h2 class="mb-0">Quản lý đơn hàng</h2>
            </div>
            <div class="row">
                <!-- Tổng Doanh Thu -->
                <div class="col-md-6 col-xl-3">
                  <div class="card">
                    <div class="card-body">
                      <h6 class="mb-2 text-muted">Tổng doanh thu</h6>
                      <h4 class="mb-3">{{ number_format($totalRevenue, 0, ',', '.') }} VND</h4>
                      <p class="text-muted text-sm mb-0">Tổng doanh thu từ các đơn hàng</p>
                    </div>
                  </div>
                </div>

                <!-- Tổng Đơn Hàng -->
                <div class="col-md-6 col-xl-3">
                  <div class="card">
                    <div class="card-body">
                      <h6 class="mb-2 text-muted">Tổng đơn hàng</h6>
                      <h4 class="mb-3">{{ $totalOrders }}</h4>
                      <p class="text-muted text-sm mb-0">Tổng số đơn hàng hiện có</p>
                    </div>
                  </div>
                </div>



                <!-- Đơn Hàng Đang Chờ -->
                <div class="col-md-6 col-xl-3">
                  <div class="card">
                    <div class="card-body">
                      <h6 class="mb-2 text-muted">Đơn hàng đang chờ</h6>
                      <h4 class="mb-3">{{ $pendingOrders }}</h4>
                      <p class="text-muted text-sm mb-0">Số lượng đơn hàng đang chờ xử lý</p>
                    </div>
                  </div>
                </div>

                <!-- Đơn Hàng Đã Hoàn Thành -->
                <div class="col-md-6 col-xl-3">
                    <div class="card">
                    <div class="card-body">
                        <h6 class="mb-2 text-muted">Đơn hàng đã hoàn thành</h6>
                        <h4 class="mb-3">{{ $completedOrders }}</h4>
                        <p class="text-muted text-sm mb-0">Số lượng đơn hàng đã hoàn thành</p>
                    </div>
                    </div>
                </div>

              </div>

            @if (session('success'))
            <div class="alert alert-success alert-dismissible fade show mt-3" role="alert">
              {{ session('success') }}
              <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
            @endif

              <!-- Lọc người dùng theo vai trò -->
              <form action="/admin/order" method="GET" id="filter-form">
                <div class="row mb-3">
                    {{-- Trạng thái --}}
                    <div class="col-md-3">
                        <select name="status" class="form-control" onchange="this.form.submit()">
                            <option value="">Tất cả trạng thái</option>
                            <option value="pending" {{ $orderstatus == 'pending' ? 'selected' : '' }}>Đang xử lý</option>
                            <option value="shipped" {{ $orderstatus == 'shipped' ? 'selected' : '' }}>Đang giao</option>
                            <option value="completed" {{ $orderstatus == 'completed' ? 'selected' : '' }}>Hoàn tất</option>
                            <option value="cancelled" {{ $orderstatus == 'cancelled' ? 'selected' : '' }}>Đã hủy</option>
                        </select>
                    </div>

                    {{-- Sắp xếp --}}
                    <div class="col-md-3">
                        <select name="sort" class="form-control" onchange="this.form.submit()">
                            <option value="">Sắp xếp theo tên</option>
                            <option value="az" {{ request('sort') == 'az' ? 'selected' : '' }}>A-Z</option>
                            <option value="za" {{ request('sort') == 'za' ? 'selected' : '' }}>Z-A</option>
                        </select>
                    </div>

                    {{-- Tìm kiếm --}}
                    <div class="col-md-4">
                        <input type="text" name="keyword" class="form-control" placeholder="Tìm theo tên người dùng..." value="{{ request('keyword') }}">
                    </div>

                    <div class="col-md-2">
                        <button type="submit" class="btn btn-primary btn-block">Lọc</button>
                    </div>
                </div>
            </form>



            <div class="card mt-4">
              <div class="card-body">
                <table id="orders-table" class="display table table-striped dt-responsive nowrap" style="width:100%">
                  <thead>
                    <tr>
                      <th>ID</th>
                      <th>id người dùng</th>
                      <th>Tổng tiền</th>
                      <th>Trạng thái</th>
                      <th>Hành động</th>
                    </tr>
                  </thead>
                  <tbody>
                    @foreach ($orders as $order)
                    <tr>
                      <td>{{ $order->id }}</td>
                      <td>{{ $order->user->name }}</td>
                      <td>{{ number_format($order->total_price, 0, ',', '.') }} VND</td>
                      <td>
                        <form action="/admin/order/{{ $order->id }}" method="POST" id="update-form">
                            @csrf
                            @method('PUT')
                            <div style="display: flex; gap: 5px;">
                                <select name="status" class="form-select form-select-sm {{ $order->status == 'shipped' ? 'status-shipped bg-cyan-100' : '' }}
                                        {{ $order->status == 'pending' ? 'status-pending bg-yellow-100' : '' }}
                                        {{ $order->status == 'completed' ? 'status-completed bg-green-100' : '' }}
                                        {{ $order->status == 'cancelled' ? 'status-cancelled bg-red-100' : '' }}"
                                        onchange="this.form.submit()">
                                    <option value="shipped" {{ $order->status == 'shipped' ? 'selected' : '' }} class="status-shipped">Đang giao</option>
                                    <option value="pending" {{ $order->status == 'pending' ? 'selected' : '' }} class="status-pending">Đang xử lý</option>
                                    <option value="completed" {{ $order->status == 'completed' ? 'selected' : '' }} class="status-completed">Hoàn thành</option>
                                    <option value="cancelled" {{ $order->status == 'cancelled' ? 'selected' : '' }} class="status-cancelled">Hủy</option>
                                </select>
                            </div>
                        </form>

                      </td>

                      <td>
                        <button class="btn btn-info btn-sm" data-bs-toggle="modal" data-bs-target="#orderModal{{ $order->id }}">Chi tiết</button>
                      </td>
                    </tr>
                    @endforeach
                  </tbody>
                </table>

                {{-- MODAL CHI TIẾT --}}
                @foreach ($orders as $order)
                <div class="modal fade" id="orderModal{{ $order->id }}" tabindex="-1" aria-labelledby="orderModalLabel{{ $order->id }}" aria-hidden="true">
                  <div class="modal-dialog modal-lg">
                    <div class="modal-content">
                      <div class="modal-header">
                        <h5 class="modal-title" id="orderModalLabel{{ $order->id }}">Chi tiết đơn hàng #{{ $order->id }}</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Đóng"></button>
                      </div>
                      <div class="modal-body">
                        <table class="table table-bordered">
                          <thead>
                            <tr>
                              <th>ID</th>
                              <th>Sản phẩm</th>
                              <th>Số lượng</th>
                              <th>Giá</th>
                              <th>Thành tiền</th>
                            </tr>
                          </thead>
                          <tbody>
                            @foreach ($order->orderDetails as $detail)
                            <tr>
                              <td>{{ $detail->id }}</td>
                              <td>{{ $detail->product->name }}</td>
                              <td>{{ $detail->quantity }}</td>
                              <td>{{ number_format($detail->price, 0, ',', '.') }} VND</td>
                              <td>{{ number_format($detail->quantity * $detail->price, 0, ',', '.') }} VND</td>
                            </tr>
                            @endforeach
                          </tbody>
                        </table>
                        <div class="pagination">
                            {{ $orders->links('pagination::bootstrap-5') }}
                        </div>

                      </div>
                      <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Đóng</button>
                      </div>
                    </div>
                  </div>
                </div>
                @endforeach

              </div>
            </div>

          </div>
        </div>
      </div>
    </div>
  </div>
</section>


<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script src="{{ asset('js/plugins/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('js/plugins/dataTables.bootstrap5.min.js') }}"></script>
<script>
  $(document).ready(function () {
    $('#orders-table').DataTable({
      responsive: true,
      "columnDefs": [
        { "targets": [4], "orderable": false }
      ]
    });
  });
</script>
@endsection
