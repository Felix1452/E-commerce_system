<div class="wrap-header-cart js-panel-cart">
    <div class="s-full js-hide-cart"></div>

    <div class="header-cart flex-col-l p-l-65 p-r-25">
        <div class="header-cart-title flex-w flex-sb-m p-b-8">
            <span class="mtext-103 cl2">
                ĐƠN HÀNG CỦA BẠN
            </span>
            <div class="fs-35 lh-10 cl2 p-lr-5 pointer hov-cl1 trans-04 js-hide-cart">
                <i class="zmdi zmdi-close"></i>
            </div>
        </div>

        <div class="header-cart-content flex-w js-pscroll">
            @php $sumPriceCart = 0; @endphp
            <ul class="header-cart-wrapitem w-full">
                @if(isset($product_cart))
                @if (count($product_cart) > 0)
                    @foreach($product_cart as $key => $product_c)
                        @php
                            $price = \App\Helpers\Helper::price($product_c->price, $product_c->price_sale);
                            $PriceCart = $product_c->price_sale != 0 ? $product_c->price_sale : $product_c->price;
                            $priceEnd = $PriceCart * $carts[$product_c->id];
                            $sumPriceCart += $priceEnd;
                        @endphp
                        <li class="header-cart-item flex-w flex-t m-b-12">
                            <div class="header-cart-item-img">
                                <img src="{{ $product_c->thumb }}" alt="IMG">
                            </div>

                            <div class="header-cart-item-txt p-t-8">
                                <a href="#" class="header-cart-item-name m-b-18 hov-cl1 trans-04">
                                    {{ $product_c->name }}
                                </a>
                                <span class="header-cart-item-info">
                                       {!! $price !!} VND
                                    <p> X {{ $carts[$product_c->id] }}</p>
                                </span>

                            </div>
                        </li>
                    @endforeach
                @endif
                @endif

            </ul>

            <div class="w-full">
                <div class="header-cart-total w-full p-tb-40">
                    Thành tiền: {{ number_format($sumPriceCart, '0', '', '.') }} VND
                </div>

                <div class="header-cart-buttons flex-w w-full">
                    <a href="/carts" class="flex-c-m stext-101 cl0 size-107 bg3 bor2 hov-btn3 p-lr-15 trans-04 m-r-8 m-b-10">
                        Xem giỏ hàng
                    </a>

                    <a href="<?php echo route('history') ?>" class="flex-c-m stext-101 cl0 size-107 bg3 bor2 hov-btn3 p-lr-15 trans-04 m-b-10">
                        Kiểm tra lịch sử
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
