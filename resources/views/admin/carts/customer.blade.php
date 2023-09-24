@extends('admin.main')

@section('content')

    <table class="table table-light-sm">
        <thead style="font-size: 18px; font-style: italic">
        <tr>
            <th>ID</th>
            <th style="width: 20%">Tên khách hàng </th>
            <th>Số điện thoại </th>
            <th>Email </th>
            <th>Địa chỉ </th>
            <th>Ngày đặt hàng</th>
            <th>Tình trạng đơn hàng</th>
            <th>&nbsp</th>
        </tr>
        </thead>
        <tbody>
        {{--        {!! \App\Helpers\Helper::menu($menus) !!}--}}
        @foreach($customers as $key => $customer)

            <tr>
                <td>{{$customer->id}}</td>
                <td>{{$customer->name}}</td>
                <td>{{$customer->phone}}</td>
                <td>{{$customer->email}}</td>
                <td>{{$customer->address}}</td>
                <td>{{$customer->created_at}}</td>
                <?php $stt =  $customer->status  ?>
                @if($stt == 1)
                    <td> Chờ xác nhận </td>
                @elseif($stt == 2)
                    <td> Đang được giao </td>
                @elseif($stt == 3)
                    <td> Đã giao xong </td>
                @elseif($stt == 4)
                    <td> Đã bị hủy </td>
                @else
                    <td> Không nhận </td>
                @endif
                <td>
                    <a style="margin-right: 5px" class="button btn-outline btn-sm" href="/admin/customers/check/{{$customer->id}} ">
                        <i class="fa fa-eye"></i> <i>Check</i>
                    </a>
                    <a class="button btn-outline btn-sm" href="/admin/customers/edit/{{$customer->id}} ">
                        <i class="fa fa-gift"></i> <i>Edit</i>
                    </a>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
    {!! $customers->links('my-paginate') !!}
@endsection



