@extends('layouts.admin')
@section('body1')
    <link rel="stylesheet" href="{{  asset('') }}css/plugins/dataTables.bootstrap5.min.css">
    <link rel="stylesheet" href="{{  asset('') }}css/plugins/responsive.bootstrap5.min.css">
    <section class="pc-container">
        <div class="pc-content">
            <!-- [ breadcrumb ] start -->
            <div class="page-header">
              <div class="page-block">
                <div class="row align-items-center">
                  <div class="col-md-12">
                    <div class="page-header-title" style="display: flex; justify-content: space-between;">
                      <h2 class="mb-0">Quản lí người dùng</h2>
                      <a href="{{ route('user.create') }}" class="btn btn-primary mb-3">
                        <i class="ti ti-plus"></i> Thêm người dùng
                    </a>
                    </div>
                    <div class="row">
                        <div class="col-md-6 col-xl-3">
                            <div class="card">
                              <div class="card-body">
                                <h6 class="mb-2 f-w-400 text-muted">Tổng người dùng</h6>
                                <h4 class="mb-3">{{ $totalUsers }}</h4>
                                <p class="mb-0 text-muted text-sm">Tổng số người dùng đang có trong hệ thống</p>
                              </div>
                            </div>
                          </div>

                          <div class="col-md-6 col-xl-3">
                            <div class="card">
                              <div class="card-body">
                                <h6 class="mb-2 f-w-400 text-muted">Người dùng mới</h6>
                                <h4 class="mb-3">{{ $newUsers }}</h4>
                                <p class="mb-0 text-muted text-sm">Người dùng vừa đăng ký gần đây</p>
                              </div>
                            </div>
                          </div>

                    </div>
                    @if (session()->get('success'))
                    <div>
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            {{ session()->get('success') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    </div>
                    @endif
                  </div>
                </div>
              </div>
            </div>
        <!-- [ breadcrumb ] end -->
  <!-- Lọc người dùng theo vai trò -->
  <form action="/admin/user" method="GET" id="filter-form">
    <div class="row mb-3">
        <div class="col-md-3">
            <input type="text" name="keyword" class="form-control" placeholder="Tìm theo tên" value="{{ request('keyword') }}" oninput="this.form.submit()">
        </div>

        <div class="col-md-3">
            <select name="role" class="form-control" onchange="this.form.submit()">
                <option value="">Tất cả vai trò</option>
                <option value="customer" {{ $selectedRole == 'customer' ? 'selected' : '' }}>Khách hàng</option>
                <option value="admin" {{ $selectedRole == 'admin' ? 'selected' : '' }}>Quản trị viên</option>
            </select>
        </div>

        <div class="col-md-3">
            <select name="sort" class="form-control" onchange="this.form.submit()">
                <option value="">Sắp xếp theo tên</option>
                <option value="asc" {{ request('sort') == 'asc' ? 'selected' : '' }}>Từ A-Z</option>
                <option value="desc" {{ request('sort') == 'desc' ? 'selected' : '' }}>Từ Z-A</option>
            </select>
        </div>
    </div>
</form>


        <!-- [ Main Content ] start -->
        <div class="row">
          <!-- Config table start -->
          <div class="col-sm-12">
            <div class="card">

              <div class="card-body">
                <table id="res-config" class="display table table-striped table-hover dt-responsive nowrap" style="width: 100%">
                  <thead>
                    <tr>
                      <th>Họ tên</th>
                      <th>Email</th>
                      <th>Số điện thoại</th>
                      <th>Địa chỉ</th>
                      <th>Vai trò</th>
                      <th>Ngày tham gia</th>
                      <th>Hành động</th>
                    </tr>
                  </thead>
                  <tbody>
                    @foreach ($userList as $user)
                        <tr>
                          <td>{{ $user->name }}</td>
                          <td>{{ $user->email }}</td>
                          <td>{{ $user->phone }}</td>
                          <td>{{ $user->address }}</td>
                          <td>{{ $user->role }}</td>
                          <td>{{ $user->created_at->format('d/m/Y') }}</td>
                          <td>
                              <ul class="list-inline me-auto mb-0">
                                  <li class="list-inline-item align-bottom" data-bs-toggle="tooltip" title="Edit">
                                    <a href="/admin/user/{{ $user->id }}" class="avtar avtar-xs btn-link-primary" >
                                      <i class="ti ti-edit-circle f-18"></i>
                                    </a>
                                  </li>
                                  <li class="list-inline-item align-bottom" data-bs-toggle="tooltip" title="Delete">
                                    <button onclick="deleteUser({{ $user->id }})" class="avtar avtar-xs btn-link-danger">
                                      <i class="ti ti-trash f-18"></i>
                                    </button>
                                  </li>
                                </ul>
                          </td>
                        </tr>
                    @endforeach
                    <script>
                        function deleteUser(id) {
                            let ok = confirm("Bạn có chắc chắn muốn xóa người dùng này không?");
                            if (ok) {
                                fetch(`http://127.0.0.1:8000/api/user/${id}`, {
                                    method: 'DELETE',
                                    headers: {
                                        'Authorization': 'Bearer 3|fhG6BKzH1X0LMG0BY0hedgJdxp0lAVDqBg0GwJmlc9b0bf36', // <- THÊM Ở ĐÂY
                                        'Accept': 'application/json'
                                    }
                                }).then(res => {
                                    alert("Xóa người dùng thành công");
                                    location.reload();
                                });
                            }
                        }
                    </script>


                  </tbody>
                </table>
                {{ $userList->links('pagination::bootstrap-5') }}

              </div>
            </div>
          </div>
          <!-- Config table end -->
        </div>
        <!-- [ Main Content ] end -->
      </div>
    </section>

<script src="{{  asset('') }}js/plugins/popper.min.js"></script>
<script src="{{  asset('') }}js/plugins/simplebar.min.js"></script>
<script src="{{  asset('') }}js/plugins/bootstrap.min.js"></script>
<script src="{{  asset('') }}js/fonts/custom-font.js"></script>
<script src="{{  asset('') }}js/pcoded.js"></script>
<script src="{{  asset('') }}js/plugins/feather.min.js"></script>
<script>layout_change('light');</script>
<script>change_box_container('false');</script>
<script>layout_rtl_change('false');</script>
<script>preset_change("preset-1");</script>
<script>font_change("Public-Sans");</script>

    <!-- [Page Specific JS] start -->
    <!-- datatable Js -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="{{  asset('') }}js/plugins/jquery.dataTables.min.js"></script>
    <script src="{{  asset('') }}js/plugins/dataTables.bootstrap5.min.js"></script>
    <script src="{{  asset('') }}js/plugins/dataTables.responsive.min.js"></script>
    <script src="{{  asset('') }}js/plugins/responsive.bootstrap5.min.js"></script>
    <script>
      // [ Configuration Option ]
      $('#res-config').DataTable({
        responsive: true
      });
    </script>
    <!-- [Page Specific JS] end -->
  </body>
  <!-- [Body] end -->
</html>
@endsection
