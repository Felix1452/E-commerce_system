@section('head')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/1.5.3/jspdf.debug.js"
            integrity="sha512-cLuyDTDg9CSseBSFWNd4wkEaZ0TBEpclX0zD3D6HjI19pO39M58AgJ1SjHp6c7ZOp0/OCRcC2BCvvySU9KJaGw=="
            crossorigin="anonymous"></script>
    <script src="http://html2canvas.hertzen.com/dist/html2canvas.js"></script>
@endsection

@extends('admin.main')

@section('content')

    <?php
    if($customer->pay_stt=='none'){
        $paystt = "Thanh toán khi nhận hàng";
    }
    else if ($customer->pay_stt=='paid'){
        $paystt = "Đã thanh toán online";
    }
    else
        $paystt = "Liên hệ chúng tôi";
    ?>
    <div class="container" id="printContent">
    <div class="customer mt-3">
        <ul>
            <li>Tên khách hàng : <strong>{{$customer->name}}</strong></li>
            <li>Số điện thoại  : <strong>{{$customer->phone}}</strong></li>
            <li>Email : <strong>{{$customer->email}}</strong></li>
            <li>Địa chỉ : <strong>{{$customer->address}}</strong></li>
            <li>Ngày đặt hàng : <strong>{{$customer->created_at->format('d/m/Y')}}</strong></li>
            <li>Ghi chú : <strong>{{$customer->content}}</strong></li>
            <li>Hình thức thanh toán : <strong>{!! $paystt !!}</strong>
        </ul>
    </div>

    <div class="carts">
        @php
            $total = 0;
        @endphp
        <table class="table">
            <thead style="font-size: 18px; font-style: italic">
            <tr>
                <th>IMG</th>
                <th>Product </th>
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
               </td>
            </tr>
        </table>
    </div>
    </div>
    <button class="btn btn-primary" id="printPDF" onclick="printPDF()">Xuất PDF</button>
@endsection

@section('footer')
    <script>
        function printPDF() {
            html2canvas(document.getElementById('printContent'), {height: 2500, width: 1150}).then(function (canvas) {
                var wid;
                var hgt;
                var img = canvas.toDataURL("image/png", wid = canvas.width, hgt = canvas.height);
                var hratio = hgt / wid
                var doc = new jsPDF('p', 'pt', 'a4');
                var width = doc.internal.pageSize.width;
                var height = width * hratio
                doc.addImage(img, 'JPEG', 20, 80, width, height);
                doc.save('donhang-{{$customer->id}}.pdf');
            });
        }
    </script>

@endsection
