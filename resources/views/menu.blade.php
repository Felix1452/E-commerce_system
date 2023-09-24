@extends('main')
@section('content')
    <div style="height: 140px">

    </div>
    <section class="bg0 p-t-23 p-b-140">
        <div class="container">
            <div class="p-b-10">
                <h3 class="ltext-103 cl5">
                    {{$title}}
                </h3>
            </div>

            <div class="flex-w flex-sb-m p-b-52">
                @include('filter')
                <div class="flex-w flex-sb-m">
                    <div class="flex-w flex-c-m m-tb-10">
                        @foreach($menus_child as $menu_child)
                            <a style="padding-left: 5px; padding-right: 5px" href="/danh-muc/{{$menu_child->id}}-{{\Str::slug($menu_child->name, '-')}}.html">
                                <div class="flex-c-m stext-101 cl6 size-104 bor4 pointer hov-btn3 trans-04 m-r-8 m-tb-4">{{$menu_child->name}}</div>
                            </a>
                        @endforeach
                    </div>
                </div>
            </div>

            @include('products.list')
            {!! $products->links('my-paginate') !!}


        </div>
    </section>
@endsection


