

<div style="font-size:100%;font-family:Roboto,sans-serif;font-weight:400;vertical-align:top;width:100%;background:#f2f2f2;margin:0;padding:0;border:0" bgcolor="#F2F2F2">
    <div style="font-size:100%;font-family:Roboto,sans-serif;font-weight:400;vertical-align:top;background:#ba0c2f;margin:0;padding:1rem 1.5rem;border:0">
        <div style="text-align:center;vertical-align:top;margin:0;padding:0;border:0" align="center">
            Gửi từ HPSTORE
        </div>
    </div>

    <div style="font-size:100%;font-family:Roboto,sans-serif;font-weight:400;vertical-align:top;max-width:600px;margin:auto;padding:0;border:0">

        <div class="m_-1284691406516496951hero" style="text-align:center;font-size:100%;font-family:Roboto,sans-serif;font-weight:400;vertical-align:top;margin:0;padding:1rem 1.5rem 0;border:0" align="center">
            <h4 style="font-size:1.563em;font-family:Roboto,sans-serif;font-weight:500;vertical-align:top;line-height:1.414;color:#0f0f0f;margin:0;padding:0;border:0">
                Gửi <span style="color:#ba0c2f">{{$customer->name}}</span>
            </h4>
            <br>
            <h4 style="font-size:1.563em;font-family:Roboto,sans-serif;font-weight:500;vertical-align:top;line-height:1.414;color:#0f0f0f;margin:0;padding:0;border:0">
                Chúng tôi sẽ xác nhận đơn hàng số #<span style="color:#ba0c2f">{{$customer->id}}</span>
            </h4>

            <p style="font-size:100%;font-family:Roboto,sans-serif;font-weight:400;vertical-align:top;line-height:1.414;color:#0f0f0f;margin:0;padding:0;border:0">
                <strong style="font-weight:500">Vui lòng giữ liên lạc với số điện thoại của bạn để chúng tôi có thể liên hệ bạn trong thời gian sớm nhất.
                </strong></p>
        </div>
        <div class="m_-1284691406516496951card" style="font-size:100%;font-family:Roboto,sans-serif;font-weight:400;vertical-align:top;text-align:left;background:#fff;margin:1rem 1.5rem;padding:0;border:2px solid #ba0c2f" align="left">
            <div style="font-size:100%;font-family:Roboto,sans-serif;font-weight:400;vertical-align:top;border-bottom-color:#ba0c2f;border-bottom-style:solid;background:#25282a;margin:0;padding:.5rem 1rem;border-width:0 0 2px">
                <h5 style="font-size:1.25em;font-family:Roboto,sans-serif;font-weight:500;vertical-align:top;line-height:1.414;color:#0f0f0f;letter-spacing:.01em;margin:0;padding:0;border:0">
                    <span style="color:#fcfcfc">Thông tin người nhận</span></h5>
            </div>
            <div class="m_-1284691406516496951cardbody" style="font-size:100%;font-family:Roboto,sans-serif;font-weight:400;vertical-align:top;margin:0;padding:1rem;border:0">
                <p style="font-size:100%;font-family:Roboto,sans-serif;font-weight:500;vertical-align:top;line-height:1.414;color:#ba0c2f;margin:0;padding:0;border:0">
                    {{$customer->name}}</p>
                <p style="font-size:100%;font-family:Roboto,sans-serif;font-weight:400;vertical-align:top;line-height:1.414;color:#0f0f0f;margin:0;padding:0;border:0">
                   {{$customer->address}}<br> </p>
                <br>
                <p style="font-size:100%;font-family:Roboto,sans-serif;font-weight:400;vertical-align:top;line-height:1.414;color:#0f0f0f;margin:0;padding:0;border:0">
                    {{$customer->phone}}</p>
            </div>
        </div>
        <div class="m_-1284691406516496951card" style="font-size:100%;font-family:Roboto,sans-serif;font-weight:400;vertical-align:top;text-align:left;background:#fff;margin:1rem 1.5rem;padding:0;border:2px solid #ba0c2f" align="left">
            <div style="font-size:100%;font-family:Roboto,sans-serif;font-weight:400;vertical-align:top;border-bottom-color:#ba0c2f;border-bottom-style:solid;background:#25282a;margin:0;padding:.5rem 1rem;border-width:0 0 2px">
                <h5 style="font-size:1.25em;font-family:Roboto,sans-serif;font-weight:500;vertical-align:top;line-height:1.414;color:#0f0f0f;letter-spacing:.01em;margin:0;padding:0;border:0">
                    <span style="color:#fcfcfc">Thông tin đơn hàng</span></h5>
            </div>
            @php
                $total = 0;
            @endphp
            <div class="m_-1284691406516496951cardbody" style="font-size:100%;font-family:Roboto,sans-serif;font-weight:400;vertical-align:top;margin:0;padding:1rem;border:0">
                <table style="font-family: Arial, Helvetica, sans-serif; border-collapse: collapse; width: 100%;">
                    <tr>
                        <th style="border: 1px solid #ddd; padding-top: 12px; padding-bottom: 12px; text-align: left;">Tên sản phẩm </th>
                        <th style="border: 1px solid #ddd; padding-top: 12px; padding-bottom: 12px; text-align: left;">Đơn giá </th>
                        <th style="border: 1px solid #ddd; padding-top: 12px; padding-bottom: 12px; text-align: left;">Số lượng </th>
                        <th style="border: 1px solid #ddd; padding-top: 12px; padding-bottom: 12px; text-align: left;">Thành tiền</th>
                    </tr>
                @foreach($carts as $key => $cart)
                <?php
                $price = $cart->price * $cart->pty;
                $total += $price;
                ?>
                <tr>
                    <td style="padding-top: 12px; padding-bottom: 12px; text-align: left; border: 1px solid #ddd;">
                        {{$cart->product->name}}
                    </td>
                    <td style="padding-top: 12px; padding-bottom: 12px; text-align: left; border: 1px solid #ddd;">
                        {{number_format($cart->price, 0, '', '.')}}
                    </td>
                    <td style="padding-top: 12px; padding-bottom: 12px; text-align: left; border: 1px solid #ddd;">
                        {{$cart->pty}}
                    </td>
                    <td style="padding-top: 12px; padding-bottom: 12px; text-align: left; border: 1px solid #ddd;">
                        {{number_format($price, 0, '', '.')}}
                    </td>
                </tr>
            @endforeach

                </table>
            </div>
            <div style="font-size:100%;font-family:Roboto,sans-serif;font-weight:400;vertical-align:top;margin:0;padding:.5rem 1rem;border-width:0 0 2px">
                <h5 style="font-size:1.25em;font-family:Roboto,sans-serif;font-weight:500;vertical-align:top;line-height:1.414;color:#0f0f0f;letter-spacing:.01em;margin:0;padding:0;border:0">
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
                </h5>
            </div>
        </div>
    </div>
</div>



