@extends('main')

@section('content')
    <div style="height: 150px"></div>
    <div class="container">
        <div class="row">
            <div class="col-sm-6 col-lg-3 p-b-50">
                <form action="{{ route('search') }}" method="GET">
                    <div class="wrap-input1 w-full p-b-4">
                        @if(isset($search))
                        <input class="input1  stext-107+" type="text" name="search" value="{{$search}}">
                        @else
                            <input class="input1  stext-107" type="text" name="search">
                        @endif
                        <div class="focus-input1 trans-04"></div>
                    </div>
                    <div class="p-t-18">
                        <button type="submit" class="flex-c-m stext-101 cl5 size-103 bg2 bor1 hov-btn1 p-lr-15 trans-04">
                            Search
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <div class="container">
    <div id="loadProduct">
    @if(isset($result)&&$result!="")
        <div class="row isotope-grid" >
            @foreach($result as $key => $product)
                <div class="col-sm-6 col-md-4 col-lg-3 p-b-35 isotope-item women">
                    <!-- Block2 -->
                    <div class="block2-txt-child1 flex-col-l ">
                        <a href="/san-pham/{{$product->id}}-{{\Str::slug($product->name, '-')}}.html" class="stext-104 cl4 hov-cl1 trans-04 js-name-b2 p-b-6">
                            @if($dayOfYear - $product->created_at->dayOfYear < 60)
                                <div style="background-color: red;color: white; width: 60px" class="flex-c-m stext-10 size-10 bg1 bor1 hov-btn2 p-lr-5">
                                NEW
                                </div>
                             @endif
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
                        </span>
                        <p class="stext-102 cl3 p-t-23">
                                {{ $product->description }}
                        </p>
                    </div>
                </div>
            @endforeach
        </div>
    @else
        <div>
            <h2>Không có kết quả tìm kiếm</h2>
        </div>
            <div style="height: 300px"></div>
    @endif
    </div>
    </div>


@endsection
