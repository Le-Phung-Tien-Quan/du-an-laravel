@extends('layouts.admin')

@section('body1')
<div class="pc-container">
    <div class="pc-content">
        <div class="page-header">
            <div class="page-block">
                <div class="row align-items-center">
                    <div class="col-md-12">
                        <div class="page-header-title" style="display: flex; justify-content: space-between;">
                            <h2 class="mb-0">Cập nhật Người Dùng</h2>
                            <a href="/admin/user" class="btn btn-outline-secondary">Quay lại</a>
                        </div>
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
        <form action="/admin/user/{{ $user->id }}" method="POST" enctype="multipart/form-data">
            @method('PATCH')
            @csrf
            <div class="row">
                <div class="col-md-6">
                    <div class="card">
                        <div class="card-body">

                            <div class="mb-3">
                                <label class="form-label">Họ và Tên</label>
                                <input type="text" name="name" class="form-control" value="{{ old('name', $user->name) }}">
                                @error('name') <div class="text-danger">{{ $message }}</div> @enderror
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Email</label>
                                <input type="email" name="email" class="form-control" value="{{ old('email', $user->email) }}">
                                @error('email') <div class="text-danger">{{ $message }}</div> @enderror
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Mật khẩu (bỏ trống nếu không thay đổi)</label>
                                <input type="password" name="password" class="form-control">
                                @error('password') <div class="text-danger">{{ $message }}</div> @enderror
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Số điện thoại</label>
                                <input type="text" name="phone" class="form-control" value="{{ old('phone', $user->phone) }}">
                                @error('phone') <div class="text-danger">{{ $message }}</div> @enderror
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Địa chỉ</label>
                                <input type="text" name="address" class="form-control" value="{{ old('address', $user->address) }}">
                                @error('address') <div class="text-danger">{{ $message }}</div> @enderror
                            </div>

                            <div class="form-group">
                                <label class="form-label">Vai trò</label>
                                <select class="form-select" name="role">
                                    <option value="customer" {{ old('role', $user->role) == 'customer' ? 'selected' : '' }}>Người Dùng</option>
                                    <option value="admin" {{ old('role', $user->role) == 'admin' ? 'selected' : '' }}>Quản trị viên</option>
                                </select>
                                @error('role')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="text-end">
                                <button type="submit" class="btn btn-primary">Cập nhật Người Dùng</button>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </form>

    </div>
</div>
@endsection
