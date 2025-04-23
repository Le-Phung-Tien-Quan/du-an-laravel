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
            <div class="page-header-title" style="display: flex; justify-content: space-between;">
              <h2 class="mb-0">Quản lí danh mục</h2>
              <a href="{{ route('category.create') }}" class="btn btn-primary mb-3">
                <i class="ti ti-plus"></i> Thêm danh mục
              </a>
            </div>

            <!-- Form tìm kiếm và lọc -->


            <div class="row">
              <div class="col-md-6 col-xl-3">
                <div class="card">
                  <div class="card-body">
                    <h6 class="mb-2 text-muted">Tổng danh mục</h6>
                    <h4 class="mb-3">{{ $totalCategories }}</h4>
                    <p class="text-muted text-sm mb-0">Số lượng danh mục hiện có</p>
                  </div>
                </div>
              </div>

              <div class="col-md-6 col-xl-3">
                <div class="card">
                  <div class="card-body">
                    <h6 class="mb-2 text-muted">Danh mục đang có sản phẩm</h6>
                    <h4 class="mb-3">{{ $activeCategories }}</h4>
                    <p class="text-muted text-sm mb-0">Danh mục đang chứa sản phẩm</p>
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
            <form action="{{ route('category.index') }}" method="GET" class="d-flex mb-3">
                <input type="text" name="search" class="form-control me-2" placeholder="Tìm kiếm theo tên danh mục" value="{{ request()->search }}">
                <select name="sort" class="form-select me-2">
                  <option value="asc" {{ request()->sort == 'asc' ? 'selected' : '' }}>A-Z</option>
                  <option value="desc" {{ request()->sort == 'desc' ? 'selected' : '' }}>Z-A</option>
                </select>
                <button type="submit" class="btn btn-outline-primary">Lọc</button>
              </form>
            <div class="card mt-4">
              <div class="card-body">

                <table id="res-config" class="display table table-striped dt-responsive nowrap" style="width:100%">
                  <thead>
                    <tr>
                      <th>ID</th>
                      <th>Ảnh</th>
                      <th>Tên danh mục</th>
                      <th>Mô tả</th>
                      <th>Hành động</th>
                    </tr>
                  </thead>
                  <tbody>
                    @foreach ($categoryList as $item)
                      <tr>
                        <td>{{ $item->id }}</td>
                        <td><img src="{{ asset('img/'.$item->image) }}" alt="" width="50px"></td>
                        <td>{{ $item->name }}</td>
                        <td>{{ $item->description }}</td>
                        <td>
                          <ul class="list-inline">
                            <li class="list-inline-item align-bottom" data-bs-toggle="tooltip" title="View">
                              <a href="/category/{{ $item->id }}" class="avtar avtar-xs btn-link-secondary">
                                <i class="ti ti-eye f-18"></i>
                              </a>
                            </li>
                            <li class="list-inline-item align-bottom" data-bs-toggle="tooltip" title="Edit">
                              <a href="/admin/category/{{ $item->id }}" class="avtar avtar-xs btn-link-primary" >
                                <i class="ti ti-edit-circle f-18"></i>
                              </a>
                            </li>
                            <li class="list-inline-item align-bottom" data-bs-toggle="tooltip" title="Delete">
                              <button onclick="deleteCategory({{ $item->id }})" class="avtar avtar-xs btn-link-danger">
                                <i class="ti ti-trash f-18"></i>
                              </button>
                            </li>
                          </ul>
                        </td>
                      </tr>
                    @endforeach
                  </tbody>
                </table>

                <!-- Phân trang -->
                <div class="pagination">
                    {{ $categoryList->appends(request()->input())->links('pagination::bootstrap-5') }}

                  </div>

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
  $('#res-config').DataTable({
    responsive: true
  });
</script>
@endsection
