@extends('layouts.admin')

@section('body1')
<div class="pc-container">
  <div class="pc-content">
    <div class="page-header">
      <div class="page-block">
        <div class="row align-items-center">
          <div class="col-md-12">
            <div class="page-header-title" style="display: flex; justify-content: space-between;">
              <h2 class="mb-0">Cập nhật Danh Mục</h2>
              <a href="/admin/category" class="btn btn-outline-secondary">Quay lại</a>
            </div>
          </div>
        </div>
      </div>
    </div>

    @if(session('success'))
    <div class="alert alert-success alert-dismissible fade show mt-3" role="alert">
      {{ session('success') }}
      <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
    @endif

    <form action="/admin/category/{{ $category->id }}" method="POST" enctype="multipart/form-data">
      @csrf
      @method('PATCH')
      <div class="card mt-4">
        <div class="card-body row">
          <div class="col-md-6">
            <div class="form-group mb-3">
              <label class="form-label">Tên Danh Mục</label>
              <input type="text" name="name" class="form-control" value="{{ old('name', $category->name) }}">
              @error('name')
              <div class="text-danger">{{ $message }}</div>
              @enderror
            </div>

            <!-- Mô Tả -->
            <div class="form-group mb-3">
              <label class="form-label">Mô Tả</label>
              <textarea name="description" class="form-control">{{ old('description', $category->description) }}</textarea>
              @error('description')
              <div class="text-danger">{{ $message }}</div>
              @enderror
            </div>

            <div class="form-group mb-3">
              <label class="form-label">Hình Ảnh</label>
              <div class="bg-light p-2 text-center mb-2">
                <img src="{{ asset('img/' . $category->image) }}" width="200">
              </div>
              <label class="btn btn-outline-secondary" for="uploadImage"><i class="ti ti-upload me-2"></i> Nhấp để Tải lên</label>
              <input type="file" class="d-none" id="uploadImage" name="image" accept="image/*">
              @error('image')
              <div class="text-danger mt-1">{{ $message }}</div>
              @enderror
            </div>

            <div class="text-end mt-4">
              <button type="submit" class="btn btn-primary">Cập nhật Danh Mục</button>
            </div>
          </div>
        </div>
      </div>
    </form>

  </div>
</div>
@endsection
