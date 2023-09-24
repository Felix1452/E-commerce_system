@extends('main')

@section('content')
    <div class="container bg0 p-t-130 p-b-85">
        <h3><b>Thông tin đơn hàng</b></h3>
            <div class="customer mt-3" style="border: grey solid 1px; width: 30%; float: left">
                <div class="container">
                    <ul >
                        <li>Tên khách hàng : </li>
                        <strong style="margin-left: 20px">{{$customer->name}}</strong>
                    </ul>
                    <ul>
                        <li>Số điện thoại  : </li>
                        <strong style="margin-left: 20px">{{$customer->phone}}</strong>
                    </ul>
                    <ul>
                        <li>Email : </li>
                        <strong style="margin-left: 20px">{{$customer->email}}</strong>
                    </ul>
                    <ul>
                        <li>Địa chỉ : </li>
                        <strong style="margin-left: 20px">{{$customer->address}}</strong>
                    </ul>
                    <ul>
                        <li>Ngày đặt hàng : </li>
                        <strong style="margin-left: 20px">{{$customer->created_at->format('d/m/Y')}}</strong>
                    </ul>
                    <ul>
                        <li>Ghi chú : </li>
                        @if($customer->content!="")
                            <strong style="margin-left: 20px">{{$customer->content}}</strong>
                        @else
                            <small style="margin-left: 20px">Không có ghi chú</small>
                        @endif
                    </ul>
                </div>
            </div>
            <div class="carts" style="margin-top: 14px">
                @php
                    $total = 0;
                @endphp
                <div class="wrap-table-shopping-cart">
                <table class="table">
                    <thead style="font-size: 18px; font-style: italic">
                    <tr>
                        <th>Ảnh</th>
                        <th>Tên sản phẩm </th>
                        <th>Đơn giá </th>
                        <th>Số lượng </th>
                        <th>Thành tiền</th>
                        <th>&nbsp</th>
                    </tr>

                    @foreach($carts as $key => $cart)
                        <?php
                        $price = $cart->price * $cart->pty;
                        $total += $price
                        ?>
                        <tr>
                            <td class="column-1">
                                <img width="50px" src="{{$cart->product->thumb}}">
                            </td>
                            <td class="column-2">
                                {{$cart->product->name}}
                            </td>
                            <td class="column-3">
                                {{number_format($cart->price, 0, '', '.')}}
                            </td>
                            <td class="column-4">
                                {{$cart->pty}}
                            </td>
                            <td class="column-5">
                                {{number_format($price, 0, '', '.')}}

                            </td>
                        </tr>
                    @endforeach
                    <tr>
                        <td colspan="5" class="text-right">
                            <span>Tổng giá trị : </span>
                            {{number_format($total, 0, '', '.')}} VND
                            @if($customer->pay_stt=='paid')
                                <strong style="margin-left: 20px">
                                    Đã thanh toán
                                </strong>
                            @else
                                <strong style="margin-left: 20px">
                                    Vui lòng thanh toán
                                </strong>
                            @endif

                        </td>

                    </tr>

                </table>
                </div>
            </div>
    </div>
    <div style="height: 100px"></div>
@endsection
