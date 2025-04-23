@extends('layouts.admin')
@section('body1')
 <!-- [ Main Content ] start -->
 <div class="pc-container">
    <div class="pc-content">
      <!-- [ breadcrumb ] start -->
      <div class="page-header">
        <div class="page-block">
          <div class="row align-items-center">

            <div class="col-md-12">
              <div class="page-header-title" style="display: flex; justify-content: space-between;">
                <h2 class="mb-0">Cập Nhật Sản Phẩm</h2>
                <a href="/admin/product" class="btn btn-outline-secondary">Quay lại</a>

              </div>
            </div>
          </div>
        </div>
      </div>
      <!-- [ breadcrumb ] end -->
      <!-- [ Main Content ] start -->
      <div class="row">
        <!-- [ sample-page ] start -->
        <div class="col-sm-12">
            @if (session()->get('success'))
            <div>
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    {{ session()->get('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            </div>
            @endif
            <form action="/admin/product/{{ $product->id }}" method="POST" enctype="multipart/form-data">
                @method('PATCH')
                @csrf
          <div class="card">
            <div class="card-body">
              <div class="row">
                <div class="col-md-6">
                  <div class="card">
                    <div class="card-body">
                      <div class="form-group">
                        <label class="form-label">Tên Sản Phẩm</label>
                        <input type="text" name="name" class="form-control" placeholder="Nhập tên sản phẩm" value="{{ old('name', $product->name) }}">
                        @error('name')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                      </div>
                      <div class="form-group">
                        <label class="form-label">Slug</label>
                        <input type="text" name="slug" class="form-control" placeholder="Nhập slug sản phẩm" value="{{ old('slug', $product->slug) }}">
                        @error('slug')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                      </div>
                      <div class="form-group">
                        <label class="form-label">Mô Tả Sản Phẩm</label>
                        <input type="text" name="description" class="form-control" placeholder="Nhập mô tả sản phẩm" value="{{ old('description', $product->description) }}">
                        @error('description')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                      </div>
                      <div class="form-group">
                        <label class="form-label">Số Lượng</label>
                        <input type="number" class="form-control" placeholder="Nhập số lượng sản phẩm" value="{{ old('quantity', $product->quantity) }}" name="quantity">
                        @error('quantity')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                      </div>
                      <div class="form-group">
                        <label class="form-label">Danh Mục</label>
                        <select class="form-select" name="category_id">
                            @foreach ($category as $item)
                            <option value="{{ $item->id }}" {{ $item->id == $product->category_id ? 'selected' : '' }}>{{ $item->name }}</option>
                            @endforeach
                        </select>
                        @error('category_id')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                      </div>
                    </div>
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="card">
                    <div class="card-body">
                        <div class="form-group">
                            <label class="form-label">Giá</label>
                            <input type="number" class="form-control" placeholder="Nhập giá sản phẩm" value="{{ old('price', $product->price) }}" name="price">
                            @error('price')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label class="form-label">Giá Giảm</label>
                            <input type="number" class="form-control" placeholder="Nhập giá giảm" value="{{ old('sale_price', $product->sale_price) }}" name="sale_price">
                            @error('sale_price')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <div class="bg-secondary-subtle mb-3 p-2 text-center">
                                <img src="{{ asset('img/' . $product->image) }}" alt="" class="w-50">
                             </div>
                            <label class="btn btn-outline-secondary" for="flupld"><i class="ti ti-upload me-2"></i> Nhấn để tải lên</label>
                            <input type="file" id="flupld" class="d-none" name="image" accept="image/*">
                            @error('image')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                      <div class="text-end btn-page mb-0 mt-4">
                        <button type="submit" class="btn btn-primary">Lưu Sản Phẩm</button>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </form>
        </div>
        <!-- [ sample-page ] end -->
      </div>
      <!-- [ Main Content ] end -->
    </div>
  </div>
@endsection
