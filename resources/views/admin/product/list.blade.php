@extends('layouts.admin')
@section('content')

<div id="content" class="container-fluid">
    <div class="card">
        <div class="card-header font-weight-bold d-flex justify-content-between align-items-center">
            <h5 class="m-0 ">Danh sách sản phẩm</h5>
            <div class="form-search form-inline">
                <form action="#">
                    <input type="text" class="form-control form-search" name="keyword" value="{{request()->input('keyword')}}" placeholder="Tìm kiếm">
                    <input type="submit" name="btn-search" value="Tìm kiếm" class="btn btn-primary">
                </form>
            </div>
        </div>
        <div class="card-body">
            <!-- Các phần khác của view -->

            <table class="table table-striped table-checkall">
                <thead>
                    <tr>
                        <th scope="col">Số thứ tự</th>
                        <th scope="col">Ảnh</th>
                        <th scope="col">Tên sản phẩm</th>
                        <th scope="col">Giá</th>
                        <th scope="col">Danh mục</th>
                        <th scope="col">Ngày tạo</th>
                        <th scope="col">Trạng thái</th>
                        <th scope="col">Tác vụ</th>
                    </tr>
                </thead>
                <tbody>
                    @if ($products->total()>0)
                    @php
                    $t=0;
                    @endphp
                    @foreach ($products as $product)
                    @php
                        $t++;
                    @endphp
                    <tr>
                        <td>{{$t}}</td>
                        <td><img src="{{ asset('/images/' . $product->image) }}" alt="" width="100" height="100"></td>
                        <td><a href="#">{{ $product->name }}</a></td>
                        <td>{{ $product->price }}</td>
                        <td>{{ $product->category }}</td>
                        <td>{{ $product->created_at }}</td>
                        <td><span class="badge badge-{{ $product->status == 'Còn hàng' ? 'success' : 'dark' }}">{{ $product->status }}</span></td>
                        <td>
                            <a href="{{route('product.edit',$product->id)}}" class="btn btn-success btn-sm rounded-0 text-white" type="button" data-toggle="tooltip" data-placement="top" title="Edit"><i class="fa fa-edit"></i></a>
                            <a href="{{route('delete_product',$product->id)}}" onclick="return confirm('Bạn có chắc chắn muốn xóa sản phẩm này ra khỏi hệ thống ?')" class="btn btn-danger btn-sm rounded-0 text-white" type="button" data-toggle="tooltip" data-placement="top" title="Delete"><i class="fa fa-trash"></i></a>
                        </td>
                    </tr>
                    @endforeach 
                    @else
                            <tr class="">
                                <td colspan="7" class="bg-white" >
                                    Không tìm thấy sản phẩm
                                </td>
                            </tr>

                    @endif
                    
                </tbody>
            </table>
            {{ $products->links() }}
        </div>
    </div>
</div>
@endsection