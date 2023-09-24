
    <div class="flex-w flex-c-m m-tb-10">
        <div class="flex-c-m stext-106 cl6 size-104 bor4 pointer hov-btn3 trans-04 m-r-8 m-tb-4 js-show-filter">
            Sắp xếp
        </div>

        <div class="flex-c-m stext-106 cl6 size-105 bor4 pointer hov-btn3 trans-04 m-tb-4 js-show-search">
            Giá
        </div>
    </div>

    <!-- Search product -->
    <div class="dis-none panel-search w-full p-t-10 p-b-15">
        <div class="wrap-filter flex-w bg6 w-full p-lr-40 p-t-27 p-lr-15-sm">
            <div class="filter-col1 p-r-15 p-b-27">
                <div class="mtext-102 cl2 p-b-15">
                    Giá
                </div>

                <ul>
                    <li class="p-b-6">
                        <a href="/danh-muc/{{$menu->id}}-{{\Str::slug($menu->name, '-')}}.html" class="filter-link stext-106 trans-04">
                            Tất cả
                        </a>
                    </li>

                    <li class="p-b-6">
                        <?php
                        $price1 = 4000000;
                        ?>
                        <a href="/danh-muc/{{$menu->id}}/filter={{$price1}}" class="filter-link stext-106 trans-04">
                            0 - 4.000.000 VND
                        </a>
                    </li>

                    <li class="p-b-6">
                        <?php
                        $price2 = 8000000;
                        ?>
                        <a href="/danh-muc/{{$menu->id}}/filter={{$price2}}" class="filter-link stext-106 trans-04">
                            4.000.000 - 8.000.000 VND
                        </a>
                    </li>

                    <li class="p-b-6">
                        <?php
                        $price3 = 12000000;
                        ?>
                        <a href="/danh-muc/{{$menu->id}}/filter={{$price3}}" class="filter-link stext-106 trans-04">
                            8.000.000 - 12.000.000 VND
                        </a>
                    </li>

                    <li class="p-b-6">
                        <?php
                        $price4 = 16000000;
                        ?>
                        <a href="/danh-muc/{{$menu->id}}/filter={{$price4}}" class="filter-link stext-106 trans-04">
                            12.000.000 - 16.000.000 VND
                        </a>
                    </li>

                    <li class="p-b-6">
                        <?php
                        $price5 = 16000001;
                        ?>
                        <a href="/danh-muc/{{$menu->id}}/filter={{$price5}}" class="filter-link stext-106 trans-04">
                            > 16.000.000+ VND
                        </a>
                    </li>
                </ul>
            </div>
{{--            <button class="size-113 flex-c-m fs-16 cl2 hov-cl1 trans-04">--}}
{{--                <i class="zmdi zmdi-search"></i>--}}
{{--            </button>--}}
{{--            <input class="mtext-107 cl2 size-114 plh2 p-r-15" type="text" name="search-product" placeholder="Tên sản phẩm">--}}
        </div>
    </div>

    <!-- Filter -->
    <div class="dis-none panel-filter w-full p-t-10">
        <div class="wrap-filter flex-w bg6 w-full p-lr-40 p-t-27 p-lr-15-sm">
            <div class="filter-col1 p-r-15 p-b-27">
                <div class="mtext-102 cl2 p-b-15">
                    Sắp xếp theo
                </div>

                <ul>
                    <li class="p-b-6">
                        <a href=" {{ request()->url() }} " class="filter-link stext-106 trans-04">
                            Mặc định
                        </a>
                    </li>

                    <li class="p-b-6">
                        <a href="{{ request()->fullUrlWithQuery(['price'=>'asc']) }}" class="filter-link stext-106 trans-04">
                            Giá tăng dần
                        </a>
                    </li>

                    <li class="p-b-6">
                        <a href="{{ request()->fullUrlWithQuery(['price'=>'desc']) }}" class="filter-link stext-106 trans-04">
                            Giá giảm dần
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </div>
