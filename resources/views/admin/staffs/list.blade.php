@extends('admin.main')

@section('content')


    <table id="sortTable" class="table table-light-sm">
        <thead style="font-size: 18px; font-style: italic">
        <tr>
            <th>STT</th>
            <th style="width: 15%">Name</th>
            <th>Email</th>
            <th>Tuổi</th>
            <th>Giới tính</th>
            <th>Quyền hạn</th>
            <th>Địa chỉ</th>
            <th>Ngày vào làm</th>
            <th>&nbsp</th>
        </tr>
        </thead>
        <tbody>
        <p hidden="true" value="{{ $i = 0 }}"></p>
        {{--        {!! \App\Helpers\Helper::menu($menus) !!}--}}
        @foreach($staffs as $key => $staff)

            <tr>
                <td>{{ $i++ }}</td>
                <td>{{$staff->name}}</td>
                <td>{{$staff->email}}</td>
                <td>{{$staff->age}}</td>
                <td>{{$staff->sex}}</td>
                <td>
                    @if($staff->active == 1)
                        Admin
                    @elseif($staff->active == 2)
                        Quản lí
                    @elseif($staff->active == 3)
                        Nhân viên
                    @elseif($staff->active == 4)
                        Khách hàng
                    @else
                        Nhân viên thực tập
                    @endif
                </td>
                <td>{{$staff->address}}</td>
                <td>{{$staff->created_at}}</td>
                <td>
                    <a style="margin-right: 5px" class="button btn-outline-warning btn-sm" href="/admin/users/edit/{{$staff->id}} ">
                        <i class="fa fa-edit"></i> <i>Edit</i>
                    </a>
                    <a class="button btn-outline-danger btn-sm" href="#"
                       onclick="removeRow({{$staff->id}}, '/admin/users/destroy')">
                        <i class="fa fa-trash"></i> <i>Delete</i>
                    </a>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
@endsection
@section('footer')

@endsection

