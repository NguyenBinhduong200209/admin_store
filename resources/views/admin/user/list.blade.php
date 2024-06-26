@extends('layouts.admin')
@section('content')

<div id="content" class="container-fluid">
    <div class="card">
        @if (session('status'))
            <div class="alert alert-success">
                {{session('status')}}
            </div>
   
            
        @endif
        <div class="card-header font-weight-bold d-flex justify-content-between align-items-center">
            <h5 class="m-0 ">Danh sách thành viên</h5>
            <div class="form-search form-inline">
                <form action="#">
                    <input type="text" class="form-control form-search" name="keyword" value="{{request()->input('keyword')}}" placeholder="Tìm kiếm">
                    <input type="submit" name="btn-search" value="Tìm kiếm" class="btn btn-primary">
                </form>
            </div>
        </div>
        <div class="card-body">
            <div class="analytic">
                <a href="" class="text-primary">Trạng thái 1<span class="text-muted">(10)</span></a>
                <a href="" class="text-primary">Trạng thái 2<span class="text-muted">(5)</span></a>
                <a href="" class="text-primary">Trạng thái 3<span class="text-muted">(20)</span></a>
            </div>
            <div class="form-action form-inline py-3">
                <select class="form-control mr-1" id="">
                    <option>Chọn</option>
                    <option>Sửa</option>
                    <option>Xóa</option>
                </select>
                <input type="submit" name="btn-search" value="Áp dụng" class="btn btn-primary">
            </div>
            <table class="table table-striped table-checkall">
                <thead>
                    <tr>
                        <th>
                            <input type="checkbox" name="checkall">
                        </th>
                        <th scope="col">#</th>
                        <th scope="col">Họ tên</th>             
                        <th scope="col">Email</th>
                        <th scope="col">Quyền</th>
                        <th scope="col">Ngày tạo</th>
                        <th scope="col">Tác vụ</th>
                    </tr>
                </thead>
                <tbody>
                    @if ($users->total()>0)
                                @php
                                $t=0;
                            @endphp
                            @foreach ($users as $user)
                            @php
                                $t++;
                            @endphp
                            <tr>
                                <td>
                                    <input type="checkbox">
                                </td>
                                <td scope="row">{{$t}}</td>
                                <td>{{$user->name}}</td>
                                <td>{{$user->email}}</td>                     
                                <td>Admintrator</td>
                                <td>{{$user->created_at}}</td>
                                <td>
                                    <a href="#" class="btn btn-success btn-sm rounded-0 text-white" type="button" data-toggle="tooltip" data-placement="top" title="Edit"><i class="fa fa-edit"></i></a>
                                    @if (Auth::id()!=$user->id)
                                        
                                    @endif
                                    <a href="{{route('delete_user',$user->id)}}" onclick="return confirm('Bạn có chắc chắn muốn xóa người dùng này ra khỏi hệ thống ?')" class="btn btn-danger btn-sm rounded-0 text-white" type="button" data-toggle="tooltip" data-placement="top" title="Delete"><i class="fa fa-trash"></i></a>
                                </td>
                            </tr>                                        
                            @endforeach 
                               
                            @else
                            <tr class="">
                                <td colspan="7" class="bg-white" >
                                    Không tìm thấy người dùng 
                                </td>
                            </tr>

                    @endif
                   
                    
                </tbody>
            </table>
            {{$users->links()}}
        </div>
    </div>
</div>
@endsection