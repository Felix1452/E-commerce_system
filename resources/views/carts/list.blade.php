@section('head')
    <script src="https://www.paypal.com/sdk/js?client-id={{ env('PAYPAL_SANDBOX_CLIENT_ID') }}"></script>
@endsection

@extends('main')

@section('content')

    <form class="bg0 p-t-130 p-b-85" method="post">
        @include('admin.alert')

        @if (count($products) != 0)
            <div class="container">
                <div class="row">
                    <div class="col-lg-10 col-xl-7 m-lr-auto m-b-50">
                        <div class="m-l-25 m-r--38 m-lr-0-xl">
                            <div class="wrap-table-shopping-cart">
                                @php $total = 0; @endphp
                                <table class="table-shopping-cart">
                                    <tbody>
                                    <tr class="table_head">
                                        <th class="column-1">Sản phẩm</th>
                                        <th class="column-2"></th>
                                        <th class="column-3">Giá</th>
                                        <th class="column-4">Số lượng</th>
                                        <th class="column-5">Tổng</th>
                                        <th class="column-6">&nbsp;</th>
                                    </tr>
                                    @foreach($products as $key => $product)
                                        @php
                                            $price = $product->price_sale != 0 ? $product->price_sale : $product->price;
                                            $priceEnd = $price * $carts[$product->id];
                                            $total += $priceEnd;
                                        @endphp
                                        <tr class="table_row">
                                            <td class="column-1">
                                                <div class="how-itemcart1">
                                                    <img src="{{ $product->thumb }}" alt="IMG">
                                                </div>
                                            </td>
                                            <td class="column-2">{{ $product->name }}
                                                <p>còn lại: {{$product->quantity}}</p>
                                            </td>
                                            <td class="column-3">{{ number_format($price, 0, '', '.') }} </td>
                                            <td class="column-4 ">
                                                <input style="margin-left: 50px" class="size-10 bor5 cl2 plh4" name="num_product[{{ $product->id }}]" value="{{ $carts[$product->id] }}" type="number" min="1" max="{{$product->quantity}}">
                                            </td>
                                            <td class="column-5">{{ number_format($priceEnd, 0, '', '.') }} </td>
                                            <td class="p-r-15">
                                                <a href="/carts/delete/{{ $product->id }}">Xóa</a>
                                            </td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                            </div>

                            <div class="flex-w flex-sb-m bor15 p-t-18 p-b-15 p-lr-40 p-lr-15-sm">
{{--                                <div class="flex-w flex-m m-r-20 m-tb-5">--}}
{{--                                    <input class="stext-104 cl2 plh4 size-117 bor13 p-lr-20 m-r-10 m-tb-5" type="text"--}}
{{--                                           name="coupon" placeholder="Coupon Code">--}}

{{--                                    <div--}}
{{--                                        class="flex-c-m stext-101 cl2 size-118 bg8 bor13 hov-btn3 p-lr-15 trans-04 pointer m-tb-5">--}}
{{--                                        Apply coupon--}}
{{--                                    </div>--}}
{{--                                </div>--}}

                                <input type="submit" value="Cập Nhật" formaction="/update-cart"
                                       class="flex-c-m stext-101 cl2 size-119 bg8 bor13 hov-btn3 p-lr-15 trans-04 pointer m-tb-10">
                            </div>
                        </div>
                    </div>

                    <div class="col-sm-10 col-lg-7 col-xl-5 m-lr-auto m-b-50">
                        <div class="bor10 p-lr-40 p-t-30 p-b-40 m-l-63 m-r-40 m-lr-0-xl p-lr-15-sm">
                            <h4 class="mtext-109 cl2 p-b-30">
                                Tổng đơn hàng
                            </h4>

                            <div class="flex-w flex-t p-t-27 p-b-33">
                                <div class="size-208">
                                    <span class="mtext-101 cl2">
                                        Thành tiền:
                                    </span>
                                </div>

                                <div class="size-209 p-t-1">
                                    <span class="mtext-110 cl2">
                                        {{ number_format($total, 0, '', '.') }} VND
                                    </span>
                                </div>
                            </div>

                            <div class="flex-w flex-t p-t-15 p-b-30">

                                <div class="size-100 p-r-18 p-r-0-sm w-full-ssm">

                                    <div class="p-t-15">
                                        <span class="stext-112 cl8">
                                            Thông Tin Khách Hàng
                                        </span>
                                        @if(session()->has('email'))
                                            <div class="bor8 bg0 m-b-12">
                                                <input class="stext-111 cl8 plh3 size-111 p-lr-15" type="text" name="name" placeholder="Tên khách Hàng" value="{{session()->get('name')}}" required>
                                            </div>

                                            <div class="bor8 bg0 m-b-12">
                                                <input class="stext-111 cl8 plh3 size-111 p-lr-15" type="text" name="phone" placeholder="Số Điện Thoại" value="{{session()->get('phone')}}" required>
                                            </div>

                                            <div class="bor8 bg0 m-b-12">
                                                <input class="stext-111 cl8 plh3 size-111 p-lr-15" type="text" name="address" placeholder="Địa Chỉ Giao Hàng" value="{{session()->get('address')}}">
                                            </div>

                                            <div class="bor8 bg0 m-b-12">
                                                <input style="background-color: grey; color: black" readonly class="stext-111 cl8 plh3 size-111 p-lr-15" type="text" name="email" placeholder="Email Liên Hệ" value="{{session()->get('email')}}">
                                            </div>

                                            <div class="bor8 bg0 m-b-12">
                                                <textarea class="cl8 plh3 size-111 p-lr-15" name="content">  </textarea>
                                            </div>
                                        @else
                                            <div class="bor8 bg0 m-b-12">
                                                <input class="stext-111 cl8 plh3 size-111 p-lr-15" type="text" name="name" placeholder="Tên khách Hàng" required>
                                            </div>

                                            <div class="bor8 bg0 m-b-12">
                                                <input class="stext-111 cl8 plh3 size-111 p-lr-15" type="text" name="phone" placeholder="Số Điện Thoại" required>
                                            </div>

                                            <div class="bor8 bg0 m-b-12">
                                                <input class="stext-111 cl8 plh3 size-111 p-lr-15" type="text" name="address" placeholder="Địa Chỉ Giao Hàng">
                                            </div>

                                            <div class="bor8 bg0 m-b-12">
                                                <input class="stext-111 cl8 plh3 size-111 p-lr-15" type="text" name="email" placeholder="Email Liên Hệ">
                                            </div>

                                            <div class="bor8 bg0 m-b-12">
                                                <textarea class="cl8 plh3 size-111 p-lr-15" name="content">  </textarea>
                                            </div>
                                        @endif

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <?php
                    $payCart = round($total/23235,2);
                    \Session::put('payCart', $payCart);
                    \Session::forget('nameP');
                    \Session::forget('phoneP');
                    \Session::forget('emailP');
                    \Session::forget('addressP');
                    \Session::forget('contentP');
                    ?>
                    @if(\Session::has('error'))
                        {{ \Session::forget('error') }}
                    @endif
                    @if(\Session::has('success'))
                        {{ \Session::forget('success') }}
                    @endif
                    <div class="col-sm-10 col-lg-7 m-lr-auto m-b-50" id="button-buy">
                        <div class="p-lr-40 p-b-80 m-l-63 m-r-40 m-lr-0-xl p-lr-15-sm">
                            @if(session()->get('perr') == 1)
                            <input type="submit" name="action" value="Thanh Toán Bằng Paypal" class="flex-c-m stext-101 cl0 size-116 bg3 hov-btn3 p-lr-15 trans-04 pointer">
                            @endif
                            <input type="submit" name="action" value="Thanh Toán Khi Nhận Hàng" class="flex-c-m stext-101 cl0 size-116 bg3 hov-btn3 p-lr-15 trans-04 pointer">
                        </div>
                    </div>
                </div>
            </div>
            @csrf
    </form>
    @else
        <div id="nofiCart" class="text-center">
            <h2 style="margin-top: 30px">Giỏ hàng trống</h2>
            <img width="30%" src="https://i.pinimg.com/originals/35/25/9b/35259bf348976ed9d90b3c35937f41c6.gif">
            <div>
                <a class="btn-light" href="/">Về trang Chủ</a>
            </div>
        </div>

        <div style="height: 50px">
        </div>
    @endif
@endsection

@section('foot')

{{--    <script>--}}
{{--        var payValue = document.getElementById("payCart").value;--}}

{{--        paypal.Buttons({--}}
{{--            type: {--}}
{{--                radio: 'true'--}}
{{--            },--}}
{{--            style:{--}}
{{--                color: 'blue'--}}
{{--            },--}}
{{--            createOrder: (data, actions) => {--}}
{{--                return actions.order.create({--}}
{{--                    purchase_units: [{--}}
{{--                        amount: {--}}
{{--                            value: `${payValue}` // Can also reference a variable or function--}}
{{--                        }--}}
{{--                    }]--}}

{{--                });--}}
{{--            },--}}
{{--            // Finalize the transaction after payer approval--}}
{{--            onApprove: (data, actions) => {--}}
{{--                return actions.order.capture().then(function(orderData) {--}}
{{--                    // Successful capture! For dev/demo purposes:--}}
{{--                    console.log('Capture result', orderData, JSON.stringify(orderData, null, 2));--}}
{{--                    const transaction = orderData.purchase_units[0].payments.captures[0];--}}
{{--                    alert(`Transaction ${transaction.status}: ${transaction.id}\n\nSee console for all available details`);--}}
{{--                    // When ready to go live, remove the alert and show a success message within this page. For example:--}}
{{--                    const element = document.getElementById('nofiCart');--}}
{{--                    element.innerHTML = '<h3>Cảm ơn bạn đã mua hàng!</h3>';--}}
{{--                    // Or go to another URL:  actions.redirect('thank_you.html');--}}
{{--                });--}}
{{--            }--}}
{{--        }).render('#paypal-button-container');--}}
{{--    </script>--}}
@endsection
