<div style="font-size:100%;font-family:Roboto,sans-serif;font-weight:400;vertical-align:top;width:100%;background:#f2f2f2;margin:0;padding:0;border:0" bgcolor="#F2F2F2">
    <div style="font-size:100%;font-family:Roboto,sans-serif;font-weight:400;vertical-align:top;background:#ba0c2f;margin:0;padding:1rem 1.5rem;border:0">
        <div style="text-align:center;vertical-align:top;margin:0;padding:0;border:0" align="center">
            Gửi từ SMARTHOME
        </div>
    </div>

    <div style="font-size:100%;font-family:Roboto,sans-serif;font-weight:400;vertical-align:top;max-width:600px;margin:auto;padding:0;border:0">

        <div class="m_-1284691406516496951hero" style="text-align:center;font-size:100%;font-family:Roboto,sans-serif;font-weight:400;vertical-align:top;margin:0;padding:1rem 1.5rem 0;border:0" align="center">
            <h4 style="font-size:1.563em;font-family:Roboto,sans-serif;font-weight:500;vertical-align:top;line-height:1.414;color:#0f0f0f;margin:0;padding:0;border:0">
                Gửi <span style="color:#ba0c2f">SMART HOME COMPANY</span>
            </h4>
            <br>
            <h4 style="font-size:1.563em;font-family:Roboto,sans-serif;font-weight:500;vertical-align:top;line-height:1.414;color:#0f0f0f;margin:0;padding:0;border:0">
                Chúng tôi có một cảnh báo gửi đến <span style="color:#ba0c2f">{{$user->name}}</span>
            </h4>

            <p style="font-size:100%;font-family:Roboto,sans-serif;font-weight:400;vertical-align:top;line-height:1.414;color:#0f0f0f;margin:0;padding:0;border:0">
                <strong style="font-weight:500">Vui lòng kiểm tra lại thiết bị của bạn để đảm bảo gia đình của bạn thật an toàn.
                </strong></p>
        </div>
        <div class="m_-1284691406516496951card" style="font-size:100%;font-family:Roboto,sans-serif;font-weight:400;vertical-align:top;text-align:left;background:#fff;margin:1rem 1.5rem;padding:0;border:2px solid #ba0c2f" align="left">
            <div style="font-size:100%;font-family:Roboto,sans-serif;font-weight:400;vertical-align:top;border-bottom-color:#ba0c2f;border-bottom-style:solid;background:#25282a;margin:0;padding:.5rem 1rem;border-width:0 0 2px">
                <h5 style="font-size:1.25em;font-family:Roboto,sans-serif;font-weight:500;vertical-align:top;line-height:1.414;color:#0f0f0f;letter-spacing:.01em;margin:0;padding:0;border:0">
                    <span style="color:#fcfcfc">Thông tin cảnh báo</span></h5>
            </div>
            <div class="m_-1284691406516496951cardbody" style="font-size:100%;font-family:Roboto,sans-serif;font-weight:400;vertical-align:top;margin:0;padding:1rem;border:0">
                <table style="font-family: Arial, Helvetica, sans-serif; border-collapse: collapse; width: 100%;">
                    <tr>
                        <th style="border: 1px solid #ddd; padding-top: 12px; padding-bottom: 12px; text-align: left;">Nhiệt độ </th>
                        <th style="border: 1px solid #ddd; padding-top: 12px; padding-bottom: 12px; text-align: left;">Độ ẩm </th>
                    </tr>
                        <tr>
                            <td style="padding-top: 12px; padding-bottom: 12px; text-align: left; border: 1px solid #ddd; color:#ba0c2f" >
                                {{$dht22s->temperature}} 
                                
                            </td>
                            <td style="padding-top: 12px; padding-bottom: 12px; text-align: left; border: 1px solid #ddd;">
                                {{$dht22s->humidity}}
                            </td>
                        </tr>

                </table>
            </div>
        </div>
    </div>
</div>




