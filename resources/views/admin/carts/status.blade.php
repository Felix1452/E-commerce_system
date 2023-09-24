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
            <th>Tổng tiền</th>
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
                <td>{{number_format(($customer->carts()->sum('price')), 0, '', '.')}} VND</td>
                <td>
                    <a style="margin-right: 5px" class="button btn-outline btn-sm" href="/admin/customers/check/{{$customer->id}} ">
                        <i class="fa fa-eye"></i> <i>Check</i>
                    </a>
                    <span>
                       <a style="color: red" class="button btn-outline btn-sm" href="/admin/customers/confirm/{{$customer->id}} ">
                       <h5> <i class="fa fa-check"></i> <i>Xác nhận</i></h5>
                    </a>
                    </span>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
    {!! $customers->links('my-paginate') !!}
@endsection



