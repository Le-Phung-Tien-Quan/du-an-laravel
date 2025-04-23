@extends('layouts.admin')
@section('body1')
<div class="pc-container">
    <div class="pc-content">
        <div class="page-header">
            <div class="page-block">
                <div class="row align-items-center">

                    <div class="col-md-12">
                        <h2 class="mb-0">Thêm Sản Phẩm</h2>
                    </div>
                </div>
            </div>
        </div>

        <form action="/admin/product" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="row">
                <div class="col-md-6">
                    <div class="card">
                        <div class="card-body">

                            <div class="mb-3">
                                <label class="form-label">Tên Sản Phẩm</label>
                                <input type="text" name="name" class="form-control" value="{{ old('name') }}">
                                @error('name')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Slug</label>
                                <input type="text" name="slug" class="form-control" value="{{ old('slug') }}">
                                @error('slug')
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
                                <label class="form-label">Số Lượng</label>
                                <input type="number" name="quantity" class="form-control" value="{{ old('quantity') }}">
                                @error('quantity')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Danh Mục</label>
                                <select name="category_id" class="form-select">
                                    @foreach ($category as $item)
                                        <option value="{{ $item->id }}" {{ old('category_id') == $item->id ? 'selected' : '' }}>
                                            {{ $item->name }}
                                        </option>
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

                            <div class="mb-3">
                                <label class="form-label">Giá Sản Phẩm</label>
                                <input type="number" name="price" class="form-control" value="{{ old('price') }}">
                                @error('price')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Giá Giảm</label>
                                <input type="number" name="sale_price" class="form-control" value="{{ old('sale_price') }}">
                                @error('sale_price')
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

                            <div class="text-end mt-3">
                                <a href="/admin/product" class="btn btn-outline-secondary">Quay lại</a>
                                <button type="submit" class="btn btn-primary">Thêm Sản Phẩm</button>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </form>


    </div>
</div>
@endsection
