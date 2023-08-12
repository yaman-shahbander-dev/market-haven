<html !DOCTYPE>
<head><META http-equiv="Content-Type" content="text/html; charset=utf-8"></head>
<body>
<table border="0" align="center" cellpadding="0" cellspacing="0" width="100%" style="max-width:100%;background:#e9e9e9;padding:50px 0px">
    <tr>
        <td>
            <table border="0" align="center" cellpadding="0" cellspacing="0" width="100%" style="max-width:600px;background:#ffffff;padding:0px 25px">
                <tbody>
                <tr>
                    <td style="margin:0;padding:0">
                        <table border="0" cellpadding="" cellspacing="0" width="100%" style="background:#ffffff;color:#000000;line-height:100%;text-align:center;font-size:25px">
                            <tbody>
                            <tr>
                                <td valign="top" width="100">
                                    <h3 style="text-align:center;text-transform:uppercase">Platform: Market Haven</h3>
                                    <h4 style="text-align:center;text-transform:uppercase">Order Confirmed Successfully!</h4>
                                    <p>Payment method: <span style="font-size:25px;font-weight:bold">{{ ucfirst($order->payment_gateway) }} </span></p>
                                </td>
                            </tr>
                            </tbody>
                        </table>
                        <br>
                        <table border="0" cellpadding="20" cellspacing="0" width="100%" style="color:#000000;line-height:150%;text-align:left;font-size:50px">
                            <tbody>
                            <tr>
                                <td valign="top" style="font-size:24px;">
                                    <span style="text-decoration:underline;">Order No: #{{ $order->no }}</span>
                                    <h2 style="display:inline-block;font-family:Arial;font-size:24px;font-weight:bold;margin-top:5px;margin-right:0;margin-bottom:5px;margin-left:0;text-align:left;line-height:100%">{{ $order->created_at }}</h2>
                                </td>
                            </tr>
                            </tbody>
                        </table>
            </table>
        </td>
    </tr>
</table>
</body>
</html>
