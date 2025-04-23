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
                      <h2 class="mb-0">Quản lí sản phẩm</h2>
                      <a href="{{ route('product.create') }}" class="btn btn-primary mb-3">
                        <i class="ti ti-plus"></i> Thêm sản phẩm
                    </a>
                    </div>
                    <div class="row">
                        <div class="col-md-6 col-xl-3">
                            <div class="card">
                              <div class="card-body">
                                <h6 class="mb-2 f-w-400 text-muted">Tổng sản phẩm</h6>
                                <h4 class="mb-3">{{ $totalProducts }}</h4>
                                <p class="mb-0 text-muted text-sm">Tổng số sản phẩm đang có trong hệ thống</p>
                              </div>
                            </div>
                          </div>

                          <div class="col-md-6 col-xl-3">
                            <div class="card">
                              <div class="card-body">
                                <h6 class="mb-2 f-w-400 text-muted">Sắp hết</h6>
                                <h4 class="mb-3">{{ $inStock }}</h4>
                                <p class="mb-0 text-muted text-sm">Sản phẩm hiện sắp hết hàng</p>
                              </div>
                            </div>
                          </div>

                          <div class="col-md-6 col-xl-3">
                            <div class="card">
                              <div class="card-body">
                                <h6 class="mb-2 f-w-400 text-muted">Hết hàng</h6>
                                <h4 class="mb-3">{{ $outOfStock }}</h4>
                                <p class="mb-0 text-muted text-sm">Sản phẩm đã hết hàng</p>
                              </div>
                            </div>
                          </div>

                          <div class="col-md-6 col-xl-3">
                            <div class="card">
                              <div class="card-body">
                                <h6 class="mb-2 f-w-400 text-muted">Đang khuyến mãi</h6>
                                <h4 class="mb-3">{{ $onSale }}</h4>
                                <p class="mb-0 text-muted text-sm">Sản phẩm đang áp dụng giá khuyến mãi</p>
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
            <form method="GET" action="/admin/product">
                <div class="row mb-3">
                    <div class="col-md-4">
                        Loại sản phẩm theo danh mục:
                        <select name="category_id" class="form-select form-select-sm" onchange="this.form.submit()">
                            <option value="">Tất cả danh mục</option>
                            @foreach($categories as $category)
                                <option value="{{ $category->id }}" {{ request('category_id') == $category->id ? 'selected' : '' }}>
                                    {{ $category->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-4">
                        Lọc theo tên sản phẩm:
                        <select name="sort" class="form-select form-select-sm" onchange="this.form.submit()">
                            <option value="">Tất cả</option>
                            <option value="asc" {{ request('sort') == 'asc' ? 'selected' : '' }}>A-Z</option>
                            <option value="desc" {{ request('sort') == 'desc' ? 'selected' : '' }}>Z-A</option>
                        </select>
                    </div>
                    <div class="col-md-4">
                        Tìm kiếm sản phẩm:
                        <input type="text" name="search" class="form-control" value="{{ request('search') }}" placeholder="Tìm kiếm sản phẩm..." oninput="this.form.submit()">
                    </div>
                </div>
            </form>


        <!-- [ breadcrumb ] end -->

        <!-- [ Main Content ] start -->
        <div class="row">
          <!-- Config table start -->
          <div class="col-sm-12">
            <div class="card">

              <div class="card-body">
                <table id="res-config" class="display table table-striped table-hover dt-responsive nowrap" style="width: 100%">
                  <thead>
                    <tr>
                      <th>Ảnh</th>
                      <th>Tên sản phẩm</th>
                      <th>Giá</th>
                      <th>Danh mục</th>
                      <th>Đánh giá</th>
                      <th>Số lượng</th>
                      {{-- <th>Lượt xem</th> --}}
                      <th>Giá sau khi giảm</th>
                      <th>Hành động</th>
                    </tr>
                  </thead>
                  <tbody>
                    @foreach ($productList as $item)
                        <tr>
                        <td><img src="{{ asset('') }}img/{{ $item->image }}" alt="" width="50px"></td>
                      <td>{{ $item->name }}</td>
                        <td>{{ number_format($item->price) }} VND</td>
                        <td>{{ $item->category->name }}</td>

                        <td>
                            @php
                                $rate = ceil($item->rating ?? 0); // Làm tròn lên
                            @endphp
                            @for ($i = 1; $i <= 5; $i++)
                                @if ($i <= $rate)
                                    <i class="ti ti-star text-yellow-400"></i> {{-- sao vàng --}}
                                @else
                                    <i class="ti ti-star text-gray-400"></i> {{-- sao xám --}}
                                @endif
                            @endfor
                        </td>

                        <td>{{ $item->quantity }}</td>
                        {{-- <td>{{ $item->views }}</td> --}}
                        <td>{{ number_format($item->sale_price) }} VND</td>
                        <td>
                            <ul class="list-inline me-auto mb-0">
                                <li class="list-inline-item align-bottom" data-bs-toggle="tooltip" title="View">
                                  <a href="/detail/{{ $item->slug }}" class="avtar avtar-xs btn-link-secondary">
                                    <i class="ti ti-eye f-18"></i>
                                  </a>
                                </li>
                                <li class="list-inline-item align-bottom" data-bs-toggle="tooltip" title="Edit">
                                  <a href="/admin/product/{{ $item->id }}" class="avtar avtar-xs btn-link-primary" >
                                    <i class="ti ti-edit-circle f-18"></i>
                                  </a>
                                </li>
                                <li class="list-inline-item align-bottom" data-bs-toggle="tooltip" title="Delete">
                                  <button onclick="deleteProduct({{ $item->id }})" class="avtar avtar-xs btn-link-danger">
                                    <i class="ti ti-trash f-18"></i>
                                  </button>
                                </li>
                              </ul>


                    </tr>
                    @endforeach

                    <script>
                        function deleteProduct(id) {
                          let ok = confirm("Ban co chac chan muon xoa khong?");
                          if(ok){
                            fetch(`http://127.0.0.1:8000/api/product/${id}`, {
                                method: 'DELETE',
                                headers: {
                                  'Authorization': 'Bearer 3|fhG6BKzH1X0LMG0BY0hedgJdxp0lAVDqBg0GwJmlc9b0bf36', // Gắn token ở đây
                                  'Accept': 'application/json'
                                }
                            }).then(res => {
                                alert("Xoa thanh cong");
                                location.reload();
                            })
                          }
                        }
                    </script>


                  </tbody>
                </table>
                <div class="pagination">
                    {{ $productList->links('pagination::bootstrap-5') }}
                </div>
              </div>
            </div>
          </div>
          <!-- Config table end -->
          <!-- `New` Constructor table start -->

          <!-- Immediately Show Hidden Details table end -->
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

      // [ New Constructor ]
      var newcs = $('#new-cons').DataTable();

      new $.fn.dataTable.Responsive(newcs);

      // [ Immediately Show Hidden Details ]
      $('#show-hide-res').DataTable({
        responsive: {
          details: {
            display: $.fn.dataTable.Responsive.display.childRowImmediate,
            type: ''
          }
        }
      });
    </script>
    <!-- [Page Specific JS] end -->
  </body>
  <!-- [Body] end -->
</html>
@endsection
