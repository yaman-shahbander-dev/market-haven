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
                        <table border="0" cellpadding="" cellspacing="0" width="100%" style="background:#ffffff;color:#000000;line-height:150%;text-align:center;font-size:25px">
                            <tbody>
                            <tr>
                                <td valign="top" width="100">
                                    <h3 style="text-align:center;text-transform:uppercase">Platform: Market Haven</h3>
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
                        <table align="center" cellspacing="0" cellpadding="6" width="95%" style="border:0; color:#000000; line-height:150%; text-align:left; font-size:50px;" border=".5px">
                            <thead>
                            <tr style="background:#efefef">
                                <th scope="col" width="30%" style="text-align:left;border:1px solid #eee">Price</th>
{{--                                <th scope="col" width="15%" style="text-align:right;border:1px solid #eee">Quantity</th>--}}
{{--                                <th scope="col" width="20%" style="text-align:right;border:1px solid #eee">Price</th>--}}
                            </tr>
                            </thead>
                            <tbody>

                            <tr width="100%">
                                <td width="30%" style="text-align:left;vertical-align:middle;border-left:1px solid #eee;border-bottom:1px solid #eee;border-right:0;border-top:0;word-wrap:break-word">
                                    ${{ $order->price }}
                                </td>
{{--                                <td width="15%" style="text-align:right;vertical-align:middle;border-left:1px solid #eee;border-bottom:1px solid #eee;border-right:0;border-top:0">--}}
{{--                                    1--}}
{{--                                </td>--}}
{{--                                <td width="20%" style="text-align:right;vertical-align:middle;border-left:1px solid #eee;border-bottom:1px solid #eee;border-right:1px solid #eee;border-top:0"><span></span></td>--}}
                            </tr>
                            </tbody>

{{--                            <tfoot>--}}
{{--                            <tr>--}}
{{--                                <th scope="row" colspan="2" style="text-align:right;vertical-align:middle;border-left:1px solid #eee;border-bottom:1px solid #eee;border-right:0;border-top:0">Cart Subtotal </th>--}}
{{--                                <th style="text-align:right;vertical-align:middle;border-left:1px solid #eee;border-bottom:1px solid #eee;border-right:1px solid #eee;border-top:0"><span>Rs.190</span></th>--}}
{{--                            </tr>--}}
{{--                            <tr>--}}
{{--                                <th scope="row" colspan="2" style="text-align:right;vertical-align:middle;border-left:1px solid #eee;border-bottom:1px solid #eee;border-right:0;border-top:0">--}}
{{--                                    Vat</th>--}}
{{--                                <td style="text-align:right;vertical-align:middle;border-left:1px solid #eee;border-bottom:1px solid #eee;border-right:1px solid #eee;border-top:0"><span>Rs.10</span></td>--}}
{{--                            </tr>--}}
{{--                            <tr>--}}
{{--                                <th scope="row" colspan="2" style="text-align:right;vertical-align:middle;border-left:1px solid #eee;border-bottom:1px solid #eee;border-right:0;border-top:0">--}}
{{--                                    Packing Charges</th>--}}
{{--                                <td style="text-align:right;vertical-align:middle;border-left:1px solid #eee;border-bottom:1px solid #eee;border-right:1px solid #eee;border-top:0"><span>Rs.10</span></td>--}}
{{--                            </tr>--}}

{{--                            <tr>--}}
{{--                                <th scope="row" colspan="2" style="text-align:right;background:#efefef;text-align:right;border-left:1px solid #eee;border-bottom:1px solid #eee;border-right:0;border-top:0">Order Total</th>--}}
{{--                                <td style="background:#efefef;text-align:right;vertical-align:middle;border-left:1px solid #eee;border-bottom:1px solid #eee;border-right:1px solid #eee;border-top:0;color:#7db701;font-weight:bold"><span>Rs.210</span></td>--}}
{{--                            </tr>--}}
{{--                            </tfoot>--}}
                        </table>
                        <br>
                        <br>
                        <table border="0" cellpadding="20" cellspacing="0" width="100%" style="color:#000000; line-height:150%; text-align:left; font-size:50px;">
                            <tbody>
                            <tr>
                                <td valign="top">
                                    <h4 style="font-size:24px;margin:0;padding:0;margin-bottom:10px;">Customer Details</h4>
                                    <p style="margin:0;margin-bottom:10px;padding:0; font-size:24px"><strong>Name:</strong>{{ ucfirst($order->first_name) }} {{ ucfirst($order->last_name) }}</p>
                                    <p style="margin:0;margin-bottom:10px;padding:0; font-size:24px"><strong>Email:</strong>{{ $order->email }}</p>
{{--                                    <p style="margin:0;margin-bottom:10px;padding:0;"><strong>Tel:</strong> 9895062649</p>--}}
                                </td>
                            </tr>
                            </tbody>
                        </table>
{{--                        <table border="0" cellpadding="20" cellspacing="0" width="100%" style="color:#000000;line-height:150%;text-align:left;font:300 14px &#39;Helvetica Neue&#39;,Helvetica,Arial,sans-serif">--}}
{{--                            <tbody>--}}
{{--                            <tr>--}}
{{--                                <td valign="top">--}}
{{--                                    <h4 style="font-size:24px;margin:0;padding:0;margin-bottom:10px;">Delivery address</h4>--}}
{{--                                    <p>--}}
{{--                                        Remya Rajeev--}}
{{--                                        <br /> Grandeur Residency, Flat No 301,Whitefields, Kondapur--}}
{{--                                        <br />--}}
{{--                                        <br /> Bajaj Maruti Residency 2nd Left--}}
{{--                                        <br /> H-2-9310, White Field Rd--}}
{{--                                    </p>--}}
{{--                                </td>--}}
{{--                            </tr>--}}
{{--                            </tbody>--}}
{{--                        </table>--}}
{{--                        <br>--}}
{{--                        <br>--}}

{{--                        <table cellspacing="0" cellpadding="6" width="100%" style="color:#000000;line-height:150%;text-align:left;font:300 16px &#39;Helvetica Neue&#39;,Helvetica,Arial,sans-serif" border="0">--}}
{{--                            <tbody>--}}
{{--                            <tr>--}}
{{--                                <td valign="top" style="text-transform:capitalize">--}}
{{--                                    <p style="font-size:12px;line-height:130%">Please call <b> 212456</b> in case of any doubts or questions. Please reply back to email in case of any issues with prices, packing charges, taxes and other menus issues.</p>--}}
{{--                                </td>--}}
{{--                            </tr>--}}
{{--                            </tbody>--}}
{{--                        </table>--}}
{{--                        <br>--}}

{{--                        <br>--}}
{{--                        <table width="100%" cellpadding="0" cellspacing="0" border="0" align="center" style="border-top:1px solid #e9e9e9;border-bottom:1px solid #e9e9e9;font-family:Arial,Helvetica,sans-serif;font-size:12px;padding:0px">--}}
{{--                            <tbody>--}}
{{--                            <tr>--}}
{{--                                <td align="left" width="33%">--}}
{{--                                    <table border="0" cellspacing="0" cellpadding="0" style="font-family:Arial,Helvetica,sans-serif;font-size:12px">--}}
{{--                                        <tbody>--}}
{{--                                        <tr>--}}
{{--                                            <td width="60%">Download the App: </td>--}}
{{--                                            <td width="5%"> </td>--}}
{{--                                            <td width="15%">--}}
{{--                                                <a href="http://swiggy.com/app?utm_source=swiggy&amp;utm_medium=partner-mails" target="_blank">--}}
{{--                                                    <img style="max-height:20px;width:auto" src="https://res.cloudinary.com/swiggy/image/upload/v1447855172/Android_qt1acy.png"></a>--}}
{{--                                            </td>--}}
{{--                                            <td width="5%"> </td>--}}
{{--                                            <td width="15%">--}}
{{--                                                <a href="http://swiggy.com/app?utm_source=swiggy&amp;utm_medium=partner-mails" target="_blank">--}}
{{--                                                    <img style="max-height:20px;width:auto" src="https://res.cloudinary.com/swiggy/image/upload/v1447855170/Apple_e7lnfc.png"></a>--}}
{{--                                            </td>--}}
{{--                                        </tr>--}}
{{--                                        </tbody>--}}
{{--                                    </table>--}}
{{--                                </td>--}}
{{--                                <td align="center" width="47%">--}}
{{--                                    <table border="0" cellspacing="0" cellpadding="0" height="50" style="font-family:Arial,Helvetica,sans-serif;font-size:12px;color:#9b9b9b">--}}
{{--                                        <tbody>--}}
{{--                                        <tr>--}}
{{--                                            <td align="center">--}}
{{--                                                © 2015-Swiggy. All rights reserved.--}}
{{--                                            </td>--}}
{{--                                        </tr>--}}
{{--                                        </tbody>--}}
{{--                                    </table>--}}
{{--                                </td>--}}
{{--                                <td align="right" width="20%">--}}
{{--                                    <table border="0" cellspacing="0" cellpadding="0" height="50" style="font-family:Arial,Helvetica,sans-serif;font-size:12px">--}}
{{--                                        <tbody>--}}
{{--                                        <tr>--}}
{{--                                            <td width="5%"> </td>--}}
{{--                                            <td width="20%">--}}
{{--                                                <a href="https://www.facebook.com/swiggy.in" target="_blank">--}}
{{--                                                    <img style="max-height:20px;width:auto" src="https://res.cloudinary.com/swiggy/image/upload/v1447855170/Facebook_ezoqwy.png" alt="Swiggy Facebook" style="display:block" border="0"></a>--}}
{{--                                            </td>--}}
{{--                                            <td width="5%"> </td>--}}
{{--                                            <td width="20%">--}}
{{--                                                <a href="https://twitter.com/swiggy_in" target="_blank">--}}
{{--                                                    <img style="max-height:20px;width:auto" src="https://res.cloudinary.com/swiggy/image/upload/v1447855171/Twitter_stmvbr.png" alt="Swiggy Twitter" style="display:block" border="0"></a>--}}
{{--                                            </td>--}}
{{--                                            <td width="5%"> </td>--}}
{{--                                            <td width="20%">--}}
{{--                                                <a href="https://www.pinterest.com/swiggyindia/" target="_blank">--}}
{{--                                                    <img style="max-height:20px;width:auto" src="https://res.cloudinary.com/swiggy/image/upload/v1447855171/Pinterest_dd2nv9.png" alt="Swiggy pinterest" style="display:block" border="0"></a>--}}
{{--                                            </td>--}}
{{--                                            <td width="5%"> </td>--}}
{{--                                            <td width="20%">--}}
{{--                                                <a href="https://instagram.com/swiggyindia/" target="_blank">--}}
{{--                                                    <img style="max-height:20px;width:auto" src="https://res.cloudinary.com/swiggy/image/upload/v1447855170/Instagram_okx3pg.png" alt="Swiggy instagram" style="display:block" border="0"></a>--}}
{{--                                            </td>--}}
{{--                                        </tr>--}}
{{--                                        </tbody>--}}
{{--                                    </table>--}}
{{--                                </td>--}}
{{--                            </tr>--}}
{{--                            </tbody>--}}
{{--                        </table>--}}
{{--                        <br>--}}
{{--                        <table width="100%" cellpadding="0" cellspacing="0" border="0" align="center" style="font-family:Arial,Helvetica,sans-serif;font-size:12px;padding:0px;font-size:12px;color:#9b9b9b;">--}}
{{--                            <tbody>--}}
{{--                            <tr>--}}
{{--                                <td align="center" width="33.3333%">--}}
{{--                                    Swiggy,Tower D, 9th Floor, IBC Knowledge Park, Bannerghatta Road, Bangalore - 560029--}}
{{--                                </td>--}}
{{--                            </tr>--}}
{{--                            </tbody>--}}
{{--                        </table>--}}
{{--                        <br>--}}
                    </td>
                </tr>
                </tbody>
            </table>
        </td>
    </tr>
</table>
</body>
</html>
