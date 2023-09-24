@extends('main')

@section('content')


    <div style="height: 40px"></div>
    <div class="container bg0 p-t-130 p-b-85">
        <div class="container">
            <div class="p-b-10">
                <h3 class="ltext-103 cl5">Lịch sử đơn hàng</h3>
            </div>
        </div>
        @include('admin.alert')

            @if(session()->has('email'))
            <div class="wrap-table-shopping-cart">
            <table class="table table-light-sm">
                <thead style="font-size: 18px; font-style: italic">
                <tr>
                    <th>Đơn hàng số</th>
                    <th>Địa chỉ</th>
                    <th>Ngày đặt hàng</th>
                    <th>Tình trạng đơn hàng</th>
                    <th>Tình trạng thanh toán</th>
                    <th>&nbsp</th>
                </tr>
                </thead>
                <tbody>
                {{--        {!! \App\Helpers\Helper::menu($menus) !!}--}}
                @foreach($customers as $key => $customer)

                    <tr>
                        <td>{{$customer->id}}</td>
                        <td>{{$customer->address}}</td>
                        <td>{{$customer->created_at->format('d/m/Y')}}</td>
                        <?php
                        $stt =  $customer->status;
                        $payment = $customer->payment;
                        ?>
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

                        @if($payment == 'Paypal')
                            <td> PAYPAL </td>
                        @elseif($payment == 'home')
                            <td> Thanh toán tại nhà </td>
                        @else
                            <td>Liên hệ chúng tôi</td>
                        @endif

                        <td>
                            <a style="margin-right: 5px" class="button btn-outline btn-sm" href="history/check/{{$customer->id}} ">
                                <i class="fa fa-eye"></i> <i></i>
                            </a>
                            @if($stt == 1 && $customer->pay_stt!='paid')
                                <a style="margin-right: 5px" class="button btn-outline btn-sm" href="history/delete/{{$customer->id}} ">
                                    <i class="fa fa-trash"></i>Hủy bỏ<i></i>
                                </a>
                            @endif

                            @if($stt==2)
                                <a class="button btn-outline btn-sm" href="history/shipped/{{$customer->id}}" >
                                    <i class="fa fa-truck">Shipped</i>
                                </a>
                            @endif
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
            @else
                <p>Vui lòng đăng nhập để xem lịch sử đơn hàng</p>
                <div style="height: 200px"></div>
            @endif

        {!! $customers->links('my-paginate') !!}
    </div>

@endsection



