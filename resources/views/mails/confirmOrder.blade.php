<!-- <!DOCTYPE html>
<html>
<head>
    <title>AlleyBakerry - xác nhận đơn hàng</title>
</head>
<body>
    <h2>Thư xác nhận đơn hàng</h2>
    <p>Kính chào quý khách 
        <b>
            @if($userInfo->full_name)
                {{ $userInfo->full_name }}
            @elseif($userInfo->name)
                {{ $userInfo->name }}
            @endif
        </b><br/> 
       Xin cám ơn bạn đã mua hàng online tại cửa hàng <a href="http://localhost:8000/">AlleyBakerry</a> của chúng tôi. Dưới đây là thông tin thanh toán của bạn: <br/>
       <b>Họ tên khách hàng: </b> 
            <i>
                @if($userInfo->full_name)
                    {{ $userInfo->full_name }}
                @elseif($userInfo->name)
                    {{ $userInfo->name }}
                @endif
            </i><br/>
       <b>Số điện thoại: </b>
            <i>
                 @if($userInfo->phone)
                    {{ $userInfo->phone }}
                @elseif($userInfo->phone_number)
                    {{ $userInfo->phone_number }}
                @endif
            </i><br/>
       <b>Địa chỉ nhận hàng: </b><i>{{ $userInfo->address }}</i><br/>
       <b>Tổng thanh toán :</b>{{ $userBillInfor->total }} vnđ <br/>
       <b>Hình thức thanh toán: </b> {{  $userBillInfor->payment }}<br/>
       <h5>Chi tiết đơn hàng: </h5><br/>
       @foreach($userBillInfor->bill_detail as $detail)
            <p>
                <b>Tên sản phẩm: </b> <u>{{ $detail->products->name }} </u>
                <b>Đơn giá: </b><u>{{ $detail->unit_price }} vnđ </u> 
                <b>Số lượng: </b><u>{{ $detail->quantity }} </u>
            </p>
       @endforeach
       <b>Nếu bạn không thực hiện giao dịch trên vui lòng bấm vào 
        <a href="{{ route('userCancelOrder', [$userBillInfor->id]) }}">ĐÂY</a> để hủy bỏ đơn hàng...
      </b>
    </p>
</body>
</html> -->

<div id=":33q" class="ii gt "><div id=":4ku" class="a3s aXjCH m15e310579e8ece9d"><div style="width:598px;padding:20px 20px"><div class="adM">
    </div><h1>
        <a style="display:block;width:30%" href="http://bstore.azurewebsites.com/" target="_blank" data-saferedirecturl="https://www.google.com/url?hl=vi&amp;q=http://bstore.azurewebsites.com/&amp;source=gmail&amp;ust=1517298275281000&amp;usg=AFQjCNFKF3H9k5_CgglHcZYaS2SxcwIGdA">
            <img style="width:100%;height:auto" src="https://ci5.googleusercontent.com/proxy/e2ey4pIYTd1ye5NWYJJT-AeEgTHCxoJeNLZDiRK9HzsXVIHG3yFd5GYjcKWAMfUNoc6gM61EVYliKl8=s0-d-e1-ft#http://bulma.io/images/bulma-logo.png" class="CToWUd">
        </a>
    </h1>
    <h3 style="text-align:center;font-size:30px;font-family:sans-serif;color:#0277b8">Thông báo đặt hàng</h3>
    <hr>
    <div style="font-family:sans-serif;color:#616161;font-weight:500;padding-left:5px">
        <p><strong>Cám ơn quý khách NAME đã đặt hàng tại AlleyBakerry,</strong></p>
        <p style="line-height:150%">
            BStore xin thông báo đơn hàng của quý khách đã được tiếp nhận và đang trong quá trình xử lý.
            BStore sẽ thông báo đến quý khách ngay khi hàng chuẩn bị được giao.
        </p>
        <hr>
        <h3 style="font-size:25px;font-family:sans-serif;color:#00bfa5;border-bottom:2px solid #00bfa5;padding-bottom:5px;display:inline-block">
            Chi tiết đơn hàng
        </h3>
        <table style="empty-cells:show;border:1px solid #cbcbcb;border-collapse:collapse;border-spacing:0;display:table;margin-bottom:35px">
            <thead style="background-color:#e0e0e0;color:#000;text-align:left;vertical-align:bottom;border-color:inherit;display:table-header-group">
                <tr>
                    <td style="padding:0.5em 1em;border:1px solid #cbcbcb;width:200px;text-align:center">Tên sản phẩm</td>
                    <td style="padding:0.5em 1em;border:1px solid #cbcbcb">Số lượng</td>
                    <td style="padding:0.5em 1em;border:1px solid #cbcbcb">Thành tiền</td>
                </tr>
            </thead>
            <tbody style="text-align:center">

                        @foreach($userBillInfor->bill_detail as $detail)
                            <tr style="line-height:30px">
                                <td style="border:1px solid #cbcbcb">
                                    <p style="display:block;letter-spacing:.1px;width:200px;font-size:15px;font-weight:300;font-style:normal;font-stretch:normal;line-height:25px;height:25px;white-space:nowrap;overflow:hidden;text-overflow:ellipsis">
                                    {{ $detail->products->name }}
                                    </p>
                                </td>
                                <td style="border:1px solid #cbcbcb">{{ $detail->quantity }}</td>
                                <td style="border:1px solid #cbcbcb">
                                {{ $detail->unit_price }} vnđ
                                </td>
                            </tr>
                        @endforeach

            </tbody>
        </table>
        <hr>
        <h3 style="font-size:25px;font-family:sans-serif;color:#00bfa5;border-bottom:2px solid #00bfa5;padding-bottom:5px;display:inline-block">
            Thông tin thanh toán
        </h3>
        <p style="margin:0;line-height:170%">Tên khách hàng: <strong>{{ $userInfo->full_name }}</strong></p>
        <p style="margin:0;line-height:170%">Địa chỉ: <strong>{{ $userInfo->address }}</strong></p>
        <p style="margin:0;line-height:170%">Số điện thoại: <strong>01676962947</strong></p>
        <p style="margin:0;line-height:170%">
            Tổng số tiền: 
            <span style="font-weight:700;color:#c62828;font-size:20px">
            {{ $userBillInfor->total }}
            </span> 
            (miễn phí tiền vận chuyển)
        </p>
        <p style="margin:0;line-height:170%">
            Hình thức thanh toán: </b> {{  $userBillInfor->payment }}
        </p>
        <p style="margin:0;line-height:170%">Nếu bạn không thực hiện giao dịch trên vui lòng bấm vào 
            <a href="{{ route('userCancelOrder', [$userBillInfor->id]) }}">ĐÂY</a> để hủy bỏ đơn hàng...
        </p>
        <hr>
        <p><strong>Một lần nữa AlleyBakerry xin cảm ơn quý khách.</strong></p><div class="yj6qo"></div><div class="adL">
    </div></div><div class="adL">
</div></div><div class="adL">
</div></div></div>