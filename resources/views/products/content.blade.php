@section('head')
    <div id="fb-root"></div>
    <script async defer crossorigin="anonymous" src="https://connect.facebook.net/vi_VN/sdk.js#xfbml=1&version=v14.0&appId=1089098345353398&autoLogAppEvents=1" nonce="GtyOVD4l"></script>
@endsection
@extends('main')
@section('content')
    <div style="height: 140px">

    </div>
    <div class="container ">
        <div class="bread-crumb flex-w p-l-25 p-r-15 p-t-30 p-lr-0-lg">
            <a href="/" class="stext-109 cl8 hov-cl1 trans-04">
                Home
                <i class="fa fa-angle-right m-l-9 m-r-10" aria-hidden="true"></i>
            </a>

            <a href="/danh-muc/{{ $product->menu->id }}-{{ Str::slug($product->menu->name) }}.html"
               class="stext-109 cl8 hov-cl1 trans-04">
                {{ $product->menu->name }}
                <i class="fa fa-angle-right m-l-9 m-r-10" aria-hidden="true"></i>
            </a>

            <span class="stext-109 cl4">
				{{ $title }}
			</span>
        </div>
    </div>

    <section class="sec-product-detail bg0 p-t-65 p-b-60">
        <div class="container">
            <div class="row">
                <div class="col-md-6 col-lg-7 p-b-30">
                    <div class="p-l-25 p-r-30 p-lr-0-lg">
                        <div class="wrap-slick3 flex-sb flex-w">
                            <div class="wrap-slick3-dots">
                                <ul class="slick3-dots" style="" role="tablist">

                                    <li onclick="imgGoc(0)"  class="slick-active" role="presentation">
                                        <img id="0"  src="{{ $product->thumb }}">
                                        <div class="slick3-dot-overlay"></div>
                                    </li>

                                    @foreach($productImg as $key => $productsImg)
                                        <li onclick="imgGoc({{ $productsImg->id }})"  class="slick-active" role="presentation">
                                            <img id="{{ $productsImg->id }}"  src="{{ $productsImg->thumb1 }}">
                                            <div class="slick3-dot-overlay"></div>
                                        </li>
                                    @endforeach
                                </ul>
                            </div>

                            <div class="slick3 gallery-lb slick-initialized slick-slider slick-dotted">
                                <div class="slick-list draggable">
                                    <div class="slick-track" style="opacity: 1; width: 1539px;">
                                        <div class="item-slick3 slick-slide slick-current slick-active"
                                             data-thumb="images/product-detail-01.jpg" data-slick-index="0"
                                             aria-hidden="false"
                                             style="width: 513px; position: relative; left: 0px; top: 0px; z-index: 999; opacity: 1;"
                                             tabindex="0" role="tabpanel" id="slick-slide10"
                                             aria-describedby="slick-slide-control10">
                                            <div class="wrap-pic-w pos-relative">
                                                <img id="img-main" src="{{ $product->thumb }}" alt="IMG-PRODUCT">

                                                <a class="flex-c-m size-108 how-pos1 bor0 fs-16 cl10 bg0 hov-btn3 trans-04"
                                                   href="{{ $product->thumb }}" tabindex="-1">
                                                    <i class="fa fa-expand"></i>
                                                </a>

                                                @foreach($productImg as $key => $productsImg)
                                                    <a class="flex-c-m size-108 how-pos1 bor0 fs-16 cl10 bg0 hov-btn3 trans-04"
                                                       href="{{ $productsImg->thumb1 }}" tabindex="0">
                                                        <i class="fa fa-expand"></i>
                                                    </a>
                                                @endforeach

                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-md-6 col-lg-5 p-b-30">
                    <div class="p-r-50 p-t-5 p-lr-0-lg">

                        @include('admin.alert')

                        @if($day-$product->created_at->dayOfYear<60)
                            <div style="background-color: red;color: white; width: 100px" class="flex-c-m stext-20 size-20 bg1 bor1 hov-btn2 p-lr-15">
                                NEW
                            </div>
                        @endif
                        <h4 class="mtext-105 cl2 js-name-detail p-b-14">
                            {{ $title }}
                        </h4>

                        <span class="mtext-106 cl2">
							{!! \App\Helpers\Helper::isSale($product->price, $product->price_sale) !!}
						</span>
                        @if($product->price > 0)
                        <p class="stext-102 cl3 p-t-23">
                            Số lượng còn:
                            {{ $product->quantity }}
                        </p>
                        @endif

                        <p class="stext-102 cl3 p-t-23">
                            {{ $product->description }}
                        </p>

                        <!--  -->
                        <div class="p-t-33">
                            <div class="flex-w flex-r-m p-b-10">
                                <div class="size-204 flex-w flex-m respon6-next">
                                    <form action="/add-cart" method="post">
                                        @if ($product->price !== 0)
                                        @if($product->quantity>0)
                                            <p>Số lượng: </p>
                                                <div style="border: solid grey 1px; width: 50%" class="wrap-num-product flex-w m-r-20 m-tb-10">
                                                    <input style="width: 100%; font-size: 20px; text-align: center" name="num_product" required value="1" type="number" min="1" max="{{$product->quantity}}">
                                                </div>
                                                <button type="submit"
                                                        class="flex-c-m stext-101 cl0 size-101 bg1 bor1 hov-btn1 p-lr-15 trans-04 ">
                                                    Thêm vào giỏ hàng
                                                </button>
                                                <input type="hidden" name="product_id" value="{{ $product->id }}">
                                            @endif
                                        @endif
                                        @csrf
                                    </form>
                                    @if($product->quantity<=0)
                                        <h4 class="mtext-105 cl2 txt-center p-b-30">
                                            SẢN PHẨM TẠM HẾT HÀNG
                                        </h4>
                                        <form action="/buy-after" method="post">
                                        @if(session()->has('email'))
                                                <input required type="hidden" name="name" value="{{session()->get('name')}}">
                                                <input required type="hidden" name="email" value="{{session()->get('email')}}">
                                                <input required type="hidden" name="phone" value="{{session()->get('phone')}}">
                                        @else
                                            <div class="bor8 m-b-10 how-pos3-parent">
                                                <input required class="stext-111 cl2 plh3 size-116 p-l-62 p-r-30" type="text" name="name" placeholder="Tên của bạn">
                                            </div>
                                            <div class="bor8 m-b-10 how-pos3-parent">
                                                <input required class="stext-111 cl2 plh3 size-116 p-l-62 p-r-30" type="email" name="email" placeholder="Địa chỉ email">
                                            </div>
                                            <div class="bor8 m-b-10 how-pos3-parent">
                                                <input required class="stext-111 cl2 plh3 size-116 p-l-62 p-r-30" type="number" name="phone" placeholder="Số điện thoại">
                                            </div>
                                        @endif
                                            <button class="flex-c-m stext-101 cl0 size-121 bg3 bor1 hov-btn3 p-lr-15 trans-04 pointer">
                                                Đăng ký trước
                                            </button>
                                            <input type="hidden" name="product_id" value="{{ $product->id }}">
                                            @csrf
                                        </form>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="bor10 m-t-50 p-t-43 p-b-40">
                <!-- Tab01 -->
                <div class="tab01">
                    <!-- Nav tabs -->
                    <ul class="nav nav-tabs" role="tablist">
                        <li class="nav-item p-b-10">
                            <a class="nav-link active" data-toggle="tab" href="#description" role="tab">Đánh giá</a>
                        </li>
                                                <li class="nav-item p-b-10">
                            <a class="nav-link" data-toggle="tab" href="#information" role="tab">Thông số kĩ thuật</a>
                        </li>

                        <li class="nav-item p-b-10">
                            <a class="nav-link" data-toggle="tab" href="#reviews" role="tab">Bình luận</a>
                        </li>
                    </ul>

                    <!-- Tab panes -->
                    <div class="tab-content p-t-43">
                        <!-- - -->
                        <div class="tab-pane fade show active" id="description" role="tabpanel">
                            @if($product->content=='')
                                <div class="how-pos2 p-lr-15-md">
                                    <p>Chưa cập nhật đánh giá</p>
                                </div>
                            @else
                                <div class="how-pos2 p-lr-15-md" style="overflow:scroll; max-height:750px;">
                                    <p class="stext-104 cl3 p-t-23">
                                        {!! $product->content !!}
                                    </p>
                                </div>
                            @endif

                        </div>

                        <!-- - -->
                        <div class="tab-pane fade" id="information" role="tabpanel">
                            <div class="row">
                                @if($product->systemConfig=="")
                                    <div class="how-pos2 p-lr-15-md">
                                        <p>Chưa cập nhật thông số</p>
                                    </div>
                                @else
                                <div class="col-sm-20 col-md-12 col-lg-6 m-lr-auto">
                                    <div class="bor8 m-b-30">
                                        <textarea style="height: 300px" class="stext-111 size-120 p-lr-28 p-tb-10">{{$product->systemConfig}}</textarea>
                                    </div>
                                </div>
                                @endif
                            </div>
                        </div>

                        <!-- - -->
                        <div class="tab-pane fade" id="reviews" role="tabpanel">
                            <div class="row">
                                <div class="col-sm-10 col-md-8 col-lg-6 m-lr-auto">
                                    <div class="p-b-30 m-lr-15-sm">
                                        <div class="fb-comments" data-href="http://huyphucshop.site/san-pham/{{$product->id}}-{{\Str::slug($product->name, '-')}}.html" data-width="" data-numposts="5"></div>

                                        <!-- Review -->
{{--                                        <div class="flex-w flex-t p-b-68">--}}
{{--                                            <div class="wrap-pic-s size-109 bor0 of-hidden m-r-18 m-t-6">--}}
{{--                                                <img src="images/avatar-01.jpg" alt="AVATAR">--}}
{{--                                            </div>--}}

{{--                                            <div class="size-207">--}}
{{--                                                <div class="flex-w flex-sb-m p-b-17">--}}
{{--													<span class="mtext-107 cl2 p-r-20">--}}
{{--														Ariana Grande--}}
{{--													</span>--}}

{{--                                                    <span class="fs-18 cl11">--}}
{{--														<i class="zmdi zmdi-star"></i>--}}
{{--														<i class="zmdi zmdi-star"></i>--}}
{{--														<i class="zmdi zmdi-star"></i>--}}
{{--														<i class="zmdi zmdi-star"></i>--}}
{{--														<i class="zmdi zmdi-star-half"></i>--}}
{{--													</span>--}}
{{--                                                </div>--}}

{{--                                                <p class="stext-102 cl6">--}}
{{--                                                    Quod autem in homine praestantissimum atque optimum est, id--}}
{{--                                                    deseruit. Apud ceteros autem philosophos--}}
{{--                                                </p>--}}
{{--                                            </div>--}}
{{--                                        </div>--}}

{{--                                        <!-- Add review -->--}}
{{--                                        <form action="/review/{{ $product->id }}" class="w-full" method="post">--}}
{{--                                            <h5 class="mtext-108 cl2 p-b-7">--}}
{{--                                                Add a review--}}
{{--                                            </h5>--}}

{{--                                            <p class="stext-102 cl6">--}}
{{--                                                Your email address will not be published. Required fields are marked *--}}
{{--                                            </p>--}}

{{--                                            <div class="flex-w flex-m p-t-50 p-b-23">--}}
{{--												<span class="stext-102 cl3 m-r-16">--}}
{{--													Your Rating--}}
{{--												</span>--}}

{{--                                                <span class="wrap-rating fs-18 cl11 pointer">--}}
{{--													<i class="item-rating pointer zmdi zmdi-star-outline"></i>--}}
{{--													<i class="item-rating pointer zmdi zmdi-star-outline"></i>--}}
{{--													<i class="item-rating pointer zmdi zmdi-star-outline"></i>--}}
{{--													<i class="item-rating pointer zmdi zmdi-star-outline"></i>--}}
{{--													<i class="item-rating pointer zmdi zmdi-star-outline"></i>--}}
{{--													<input class="dis-none" type="number" name="rating">--}}
{{--												</span>--}}
{{--                                            </div>--}}

{{--                                            <div class="row p-b-25">--}}
{{--                                                <div class="col-12 p-b-5">--}}
{{--                                                    <label class="stext-102 cl3" for="review">Your review</label>--}}
{{--                                                    <textarea class="size-110 bor8 stext-102 cl2 p-lr-20 p-tb-10"--}}
{{--                                                              id="review" name="review"></textarea>--}}
{{--                                                </div>--}}
{{--                                                @if(session()->has('email') == null)--}}
{{--                                                    <div class="col-sm-6 p-b-5">--}}
{{--                                                        <label class="stext-102 cl3" for="name">Name</label>--}}
{{--                                                        <input class="size-111 bor8 stext-102 cl2 p-lr-20" id="name"--}}
{{--                                                               type="text" name="name">--}}
{{--                                                    </div>--}}


{{--                                                    <div class="col-sm-6 p-b-5">--}}
{{--                                                        <label class="stext-102 cl3" for="email">Email</label>--}}
{{--                                                        <input class="size-111 bor8 stext-102 cl2 p-lr-20" id="email"--}}
{{--                                                               type="text" name="email">--}}
{{--                                                    </div>--}}
{{--                                                @endif--}}
{{--                                            </div>--}}
{{--                                            @csrf--}}
{{--                                            <button type="submit" name="submit"--}}
{{--                                                class="flex-c-m stext-101 cl0 size-112 bg7 bor11 hov-btn3 p-lr-15 trans-04 m-b-10">--}}
{{--                                                Submit--}}
{{--                                            </button>--}}
{{--                                        </form>--}}
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="bg6 flex-c-m flex-w size-302 m-t-73 p-tb-15">
            <span class="stext-107 cl6 p-lr-25">
				Categories: {{ $product->menu->name }}
			</span>
        </div>
    </section>

    <section class="sec-relate-product bg0 p-t-45 p-b-105">
        <div class="container">
            <div class="p-b-45">
                <h3 class="ltext-106 cl5 txt-center">
                    CÓ THỂ BẠN QUAN TÂM
                </h3>
            </div>

            <div class="row isotope-grid" >
                @foreach($products as $key => $product)

                    <div class="col-sm-6 col-md-4 col-lg-3 p-b-35 isotope-item women">
                        <!-- Block2 -->
                        <div class="block2-txt-child1 flex-col-l ">
                            <a href="/san-pham/{{$product->id}}-{{\Str::slug($product->name, '-')}}.html" class="stext-104 cl4 hov-cl1 trans-04 js-name-b2 p-b-6">
                                <div class="block2-pic hov-img0">
                                    <img class="show-img-product rounded mx-auto d-block" src="{{$product->thumb}}" alt="IMG-PRODUCT">
                                </div>
                                <div class="txt_product_name">
                                    {{$product->name}}
                                </div>
                            </a>

                            <span class="stext-105 cl3">
                            @if($product->quantity > 0)
                                    {!! \App\Helpers\Helper::isSale($product->price,$product->price_sale) !!}
                                @else
                                    <a class="text-danger" href="/san-pham/{{$product->id}}-{{\Str::slug($product->name, '-')}}.html">Hết hàng</a>
                                @endif
                                @if(($day)-($product->created_at->dayOfYear)<60)
                                    <div style="background-color: red;color: white; width: 60px" class="flex-c-m stext-10 size-10 bg1 bor1 hov-btn2 p-lr-5">
                                        NEW
                                    </div>
                                @else

                                @endif
                        </span>
                        </div>
                    </div>
                @endforeach
            </div>

        </div>
    </section>

@endsection
