@extends('layouts.admin')
@section('content')
<div id="content" class="container-fluid">
    <div class="card">
        <div class="card-header font-weight-bold">
            Sửa sản phẩm
        </div>
        <div class="card-body">
            <form action="{{ route('product.update', $product->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="form-group">
                    <label for="name">Tên sản phẩm</label>
                    <input class="form-control" type="text" name="name" id="name" value="{{ $product->name }}" required>
                    @error('name')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="price">Giá</label>
                    <input class="form-control" type="text" name="price" id="price" value="{{ $product->price }}" required>
                    @error('price')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="image">Ảnh sản phẩm</label>
                    <input class="form-control-file" type="file" name="image" id="image">
                    @error('image')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                    <img src="{{ asset('images/' . $product->image) }}" alt="Product Image" style="max-width: 100px;">
                </div>
                <div class="form-group">
                    <label for="description">Mô tả sản phẩm</label>
                    <textarea name="description" class="form-control" id="description" cols="30" rows="5" required>{{ $product->description }}</textarea>
                    @error('description')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="details">Chi tiết sản phẩm</label>
                    <textarea name="details" class="form-control" id="details" cols="30" rows="5" required>{{ $product->details }}</textarea>
                    @error('details')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="category">Danh mục</label>
                    <select class="form-control" name="category" id="category" required>
                        <option value="">Chọn danh mục</option>
                        <option value="SamSung" {{ $product->category == 'SamSung' ? 'selected' : '' }}>SamSung</option>
                        <option value="Iphone" {{ $product->category == 'Iphone' ? 'selected' : '' }}>Iphone</option>
                        <option value="Macbook" {{ $product->category == 'Macbook' ? 'selected' : '' }}>Macbook</option>
                        <option value="Laptop" {{ $product->category == 'Laptop' ? 'selected' : '' }}>Laptop</option>
                    </select>
                    @error('category')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>
                <div class="form-group">
                    <label>Trạng thái</label>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="status" id="status1" value="Còn hàng" {{ $product->status == 'Còn hàng' ? 'checked' : '' }} required>
                        <label class="form-check-label" for="status1">Còn hàng</label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="status" id="status2" value="Hàng chưa về" {{ $product->status == 'Hàng chưa về' ? 'checked' : '' }} required>
                        <label class="form-check-label" for="status2">Hàng chưa về</label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="status" id="status3" value="Đã hết" {{ $product->status == 'Đã hết' ? 'checked' : '' }} required>
                        <label class="form-check-label" for="status3">Đã hết</label>
                    </div>
                    @error('status')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>
                <button type="submit" class="btn btn-primary">Cập nhật</button>
            </form>
        </div>
    </div>
</div>
@endsection
