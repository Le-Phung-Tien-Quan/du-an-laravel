@extends('layouts.admin')
@section('body1')
<div class="pc-container">
    <div class="pc-content">
        <div class="page-header">
            <div class="page-block">
                <div class="row align-items-center">

                    <div class="col-md-12">
                        <h2 class="mb-0">Thêm Danh Mục</h2>
                    </div>
                </div>
            </div>
        </div>

        <form action="/admin/category" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="row">
                <div class="col-md-6">
                    <div class="card">
                        <div class="card-body">

                            <div class="mb-3">
                                <label class="form-label">Tên Danh Mục</label>
                                <input type="text" name="name" class="form-control" value="{{ old('name') }}">
                                @error('name')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Mô Tả</label>
                                <textarea name="description" rows="4" class="form-control">{{ old('description') }}</textarea>
                                @error('description')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Hình Ảnh</label>
                                <input type="file" name="image" class="form-control" accept="image/*">
                                @error('image')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>

                        </div>
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="card">
                        <div class="card-body">

                            <div class="text-end mt-3">
                                <a href="/admin/category" class="btn btn-outline-secondary">Quay lại</a>
                                <button type="submit" class="btn btn-primary">Thêm Danh Mục</button>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>
@endsection
