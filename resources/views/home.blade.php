@extends('main')

@section('content')
<!-- Slider -->
<section class="section-slide">
    <div class="wrap-slick1">
        <div class="slick1">

            @foreach($sliders as $slider)
                <div class="item-slick1" style="background-image: url({{$slider->thumb}});">
                    <div class="container h-full">
                        <div class="flex-col-l-m h-full p-t-100 p-b-30 respon5">

                            <div class="layer-slick1 animated visible-false" data-appear="fadeInLeft" data-delay="500">
                                <h2 style="-webkit-text-stroke-width: 1px; -webkit-text-stroke-color: white;" class="ltext-201 cl2 p-t-19 p-b-43 respon1">
                                    {{$slider->name}}
                                </h2>
                            </div>

                            <div class="layer-slick1 animated visible-false" data-appear="zoomIn" data-delay="800">
                                <a style="background-color: #0a0e14;" href="{{$slider->url}}" class="flex-c-m stext-101 cl0 size-101 bg1 bor1 p-lr-15 trans-04">
                                    MUA NGAY
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach

        </div>
    </div>
</section>


<!-- Banner -->
<div class="sec-banner bg0 p-t-80 p-b-50">
    <div class="container">
        <div class="row">

            @foreach($menus as $menu)
                <div class="col-md-6 col-xl-4 p-b-30 m-lr-auto">
                    <!-- Block1 -->
                    <div class="block1 wrap-pic-w">
                        <div style="text-align: right">
                            <img style="height: 150px; object-fit: contain; width: 40%;" src="{{$menu->thumb}}" alt="IMG-BANNER">
                        </div>

                        <a style="text-align: center; justify-content: center; padding-top: 10px; padding-left: 10px; padding-bottom: 10px" href="/danh-muc/{{$menu->id}}-{{\Str::slug($menu->name, '-')}}.html" class="block1-txt ab-t-l s-full flex-col-l-sb p-lr-38 p-tb-34 trans-03 respon3">
                            <div style="width: 60%;" class="block1-txt-child1">
								<span style="font-size: 22px" class="block1-name ltext-102 trans-04">
									{{$menu->name}}
								</span>

                                <span style="font-size: 13px" class="block1-info stext-102 trans-04">
									<p>{{$menu->description}}</p>
								</span>
                            </div>

                        </a>
                    </div>
                </div>
            @endforeach

        </div>
    </div>
</div>


<!-- Product -->
<section class="bg0 p-t-23 p-b-140">
    <div class="container">
        <div class="p-b-10">
            <h3 class="ltext-103 cl5">
                Sản phẩm mới nhất
            </h3>
        </div>
        <div class="flex-w flex-sb-m p-b-52">
        </div>

        <div id="loadProduct">
            @include('products.list')
        </div>

        <meta name="csrf-token" content="{{ csrf_token() }}">
        <!-- Load more -->
        <div class="flex-c-m flex-w w-full p-t-45">
            <input type="hidden" value="1" id="page">
            <a id="button-loadMore" href="#page" onclick="loadmore()" class="flex-c-m stext-101 cl5 size-103 bg2 bor1 hov-btn1 p-lr-15 trans-04">
                Xem Thêm
            </a>
        </div>
    </div>
</section>
@endsection

