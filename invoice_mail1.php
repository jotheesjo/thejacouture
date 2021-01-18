<?php
 
//function addFunction($shipping_address,$billing_address,$payment_type,$sub_total,$grant_total,$coupon_percent,$ord_detail,$ship_cost,$myorder_id,$conn) {
           //return $shipping_address;

$shipping_address2=json_decode($shipping_address,TRUE);
$billing2=json_decode($billing_address,TRUE);
$gst=0.05*$grant_total;

//$shipping_address=json_decode($resOrder['shipping_address'],true);
//$billing=json_decode($resOrder['billing_address'],true);
//$orderdata=json_decode($resOrder['order_detail'],TRUE);

$orderdata2=json_decode($ord_detail,TRUE);

//$gst=0.05*$grant_total;
//$ship_cost=$resOrder['ship_cost'];

// $gst=0.05*$resOrder['grant_total'];
// $grant_total=$resOrder['grant_total'];
// $grant_total=$resOrder['grant_total'];
// $coupon_percent=$resOrder['coupon_percent'];
// $myorder_id=$resOrder['order_id'];
// $sub_total=$resOrder['total_price'];
// $payment_type=$resOrder['payment_type'];
$message1='';

	$message1.='<html>
<body>
    <table style="height:100%!important;width:100%!important;border-spacing:0;border-collapse:collapse">
        <tbody>
            <tr>
                <td style="font-family:-apple-system,BlinkMacSystemFont,&quot;Segoe UI&quot;,&quot;Roboto&quot;,&quot;Oxygen&quot;,&quot;Ubuntu&quot;,&quot;Cantarell&quot;,&quot;Fira Sans&quot;,&quot;Droid Sans&quot;,&quot;Helvetica Neue&quot;,sans-serif">
                    <table style="width:100%;border-spacing:0;border-collapse:collapse;margin:40px 0 20px">
                        <tbody>
                            <tr>
                                <td style="font-family:-apple-system,BlinkMacSystemFont,&quot;Segoe UI&quot;,&quot;Roboto&quot;,&quot;Oxygen&quot;,&quot;Ubuntu&quot;,&quot;Cantarell&quot;,&quot;Fira Sans&quot;,&quot;Droid Sans&quot;,&quot;Helvetica Neue&quot;,sans-serif">
                                    <center>

                                        <table style="width:560px;text-align:left;border-spacing:0;border-collapse:collapse;margin:0 auto">
                                            <tbody>
                                                <tr>
                                                    <td style="font-family:-apple-system,BlinkMacSystemFont,&quot;Segoe UI&quot;,&quot;Roboto&quot;,&quot;Oxygen&quot;,&quot;Ubuntu&quot;,&quot;Cantarell&quot;,&quot;Fira Sans&quot;,&quot;Droid Sans&quot;,&quot;Helvetica Neue&quot;,sans-serif">

                                                        <table style="width:100%;border-spacing:0;border-collapse:collapse">
                                                            <tbody>
                                                                <tr>
                                                                    <td style="font-family:-apple-system,BlinkMacSystemFont,&quot;Segoe UI&quot;,&quot;Roboto&quot;,&quot;Oxygen&quot;,&quot;Ubuntu&quot;,&quot;Cantarell&quot;,&quot;Fira Sans&quot;,&quot;Droid Sans&quot;,&quot;Helvetica Neue&quot;,sans-serif">
                                                                        <img src="https://www.thejacouture.in/images/logo.png" alt="" width="120" class="CToWUd">
                                                                    </td>

                                                                    <td style="font-family:-apple-system,BlinkMacSystemFont,&quot;Segoe UI&quot;,&quot;Roboto&quot;,&quot;Oxygen&quot;,&quot;Ubuntu&quot;,&quot;Cantarell&quot;,&quot;Fira Sans&quot;,&quot;Droid Sans&quot;,&quot;Helvetica Neue&quot;,sans-serif;text-transform:uppercase;font-size:14px;color:#999" align="right">
                                                                        <span style="font-size:16px">
                                                                            Order #'.$myorder_id.'
                                                                        </span>
                                                                    </td>
                                                                </tr>
                                                            </tbody>
                                                        </table>

                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>

                                    </center>
                                </td>
                            </tr>
                        </tbody>
                    </table>

                    <table style="width:100%;border-spacing:0;border-collapse:collapse">
                        <tbody>
                            <tr>
                                <td style="font-family:-apple-system,BlinkMacSystemFont,&quot;Segoe UI&quot;,&quot;Roboto&quot;,&quot;Oxygen&quot;,&quot;Ubuntu&quot;,&quot;Cantarell&quot;,&quot;Fira Sans&quot;,&quot;Droid Sans&quot;,&quot;Helvetica Neue&quot;,sans-serif;padding-bottom:40px">
                                    <center>
                                        <table style="width:560px;text-align:left;border-spacing:0;border-collapse:collapse;margin:0 auto">
                                            <tbody>
                                                <tr>
                                                    <td style="font-family:-apple-system,BlinkMacSystemFont,&quot;Segoe UI&quot;,&quot;Roboto&quot;,&quot;Oxygen&quot;,&quot;Ubuntu&quot;,&quot;Cantarell&quot;,&quot;Fira Sans&quot;,&quot;Droid Sans&quot;,&quot;Helvetica Neue&quot;,sans-serif">

                                                        <h2 style="font-weight:normal;font-size:24px;margin:0 0 10px">Thank you for your purchase</h2>
                                                        <h2 style="font-weight:normal;font-size:24px;margin:0 0 10px">Your Order - Progress. </h2>
                                                        <p style="color:#777;line-height:150%;font-size:16px;margin:0">

                                                            Dear '.$billing2['billname'].',
                                                            <br><br>
                                                            Thank you for your purchase. Our team will now prepare your order for delivery.Once your package ships, we will send an Email with a link to track your order.

                                                        </p>

                                                        <table style="width:100%;border-spacing:0;border-collapse:collapse;margin-top:20px">
                                                            <tbody>
                                                                <tr>
                                                                    <td style="font-family:-apple-system,BlinkMacSystemFont,&quot;Segoe UI&quot;,&quot;Roboto&quot;,&quot;Oxygen&quot;,&quot;Ubuntu&quot;,&quot;Cantarell&quot;,&quot;Fira Sans&quot;,&quot;Droid Sans&quot;,&quot;Helvetica Neue&quot;,sans-serif;line-height:0.5em">&nbsp;</td>
                                                                </tr>
                                                                <tr>
                                                                    <td style="font-family:-apple-system,BlinkMacSystemFont,&quot;Segoe UI&quot;,&quot;Roboto&quot;,&quot;Oxygen&quot;,&quot;Ubuntu&quot;,&quot;Cantarell&quot;,&quot;Fira Sans&quot;,&quot;Droid Sans&quot;,&quot;Helvetica Neue&quot;,sans-serif">
                                                                        <table style="border-spacing:0;border-collapse:collapse;float:left;margin-right:15px">
                                                                            <tbody>
                                                                                <tr>
                                                                                    <td style="font-family:-apple-system,BlinkMacSystemFont,&quot;Segoe UI&quot;,&quot;Roboto&quot;,&quot;Oxygen&quot;,&quot;Ubuntu&quot;,&quot;Cantarell&quot;,&quot;Fira Sans&quot;,&quot;Droid Sans&quot;,&quot;Helvetica Neue&quot;,sans-serif;border-radius:4px" bgcolor="#000" align="center"><a href="https://www.thejacouture.in/order-history.php?order_id='.$myorder_id.'" style="font-size:16px;text-decoration:none;display:block;color:#fff;padding:20px 25px" target="_blank">VIEW YOUR ORDER</a></td>
                                                                                </tr>
                                                                            </tbody>
                                                                        </table>

                                                                        <table style="border-spacing:0;border-collapse:collapse;margin-top:19px">
                                                                            <tbody>
                                                                                <tr>
                                                                                    <td style="font-family:-apple-system,BlinkMacSystemFont,&quot;Segoe UI&quot;,&quot;Roboto&quot;,&quot;Oxygen&quot;,&quot;Ubuntu&quot;,&quot;Cantarell&quot;,&quot;Fira Sans&quot;,&quot;Droid Sans&quot;,&quot;Helvetica Neue&quot;,sans-serif">or <a href="https://www.thejacouture.in" style="font-size:16px;text-decoration:none;color:#000" target="_blank">Visit our store</a>
                                                                                    </td>
                                                                                </tr>
                                                                            </tbody>
                                                                        </table>


                                                                    </td>
                                                                </tr>
                                                            </tbody>
                                                        </table>



                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </center>
                                </td>
                            </tr>
                        </tbody>
                    </table>

<table style="width:100%;border-spacing:0;border-collapse:collapse;border-top-width:1px;border-top-color:#e5e5e5;border-top-style:solid">
<tbody>
<tr>
<td style="font-family:-apple-system,BlinkMacSystemFont,&quot;Segoe UI&quot;,&quot;Roboto&quot;,&quot;Oxygen&quot;,&quot;Ubuntu&quot;,&quot;Cantarell&quot;,&quot;Fira Sans&quot;,&quot;Droid Sans&quot;,&quot;Helvetica Neue&quot;,sans-serif;padding:40px 0">
    <center>
        <table style="width:560px;text-align:left;border-spacing:0;border-collapse:collapse;margin:0 auto">
            <tbody>
                <tr>
                    <td style="font-family:-apple-system,BlinkMacSystemFont,&quot;Segoe UI&quot;,&quot;Roboto&quot;,&quot;Oxygen&quot;,&quot;Ubuntu&quot;,&quot;Cantarell&quot;,&quot;Fira Sans&quot;,&quot;Droid Sans&quot;,&quot;Helvetica Neue&quot;,sans-serif">
                        <h3 style="font-weight:normal;font-size:20px;margin:0 0 25px">Order summary</h3>
                    </td>
                </tr>
            </tbody>
        </table>
        <table style="width:560px;text-align:left;border-spacing:0;border-collapse:collapse;margin:0 auto">
            <tbody>
                <tr>
                    <td style="font-family:-apple-system,BlinkMacSystemFont,&quot;Segoe UI&quot;,&quot;Roboto&quot;,&quot;Oxygen&quot;,&quot;Ubuntu&quot;,&quot;Cantarell&quot;,&quot;Fira Sans&quot;,&quot;Droid Sans&quot;,&quot;Helvetica Neue&quot;,sans-serif">


                        <table style="width:100%;border-spacing:0;border-collapse:collapse">

                            <tbody><tr style="width:100%">
<td style="font-family:-apple-system,BlinkMacSystemFont,&quot;Segoe UI&quot;,&quot;Roboto&quot;,&quot;Oxygen&quot;,&quot;Ubuntu&quot;,&quot;Cantarell&quot;,&quot;Fira Sans&quot;,&quot;Droid Sans&quot;,&quot;Helvetica Neue&quot;,sans-serif;padding-bottom:15px">
    <table style="border-spacing:0;border-collapse:collapse">
        <tbody>';
		 $j=1;
		 $grand_total=0;
                 foreach($orderdata2 as $orderdata){
                                                    $pid=$orderdata['product_id'];

                                                   
                    $product=mysqli_fetch_array(mysqli_query($conn,"SELECT * FROM products WHERE product_id='$pid'"));
                    $img=json_decode($product['img_path']);
                    $price=$orderdata['price']*$orderdata['qty'];
                    $grand_total=  $price+ $grand_total;
                    // $gst=$grand_total*3/100;


            $message1.='<tr>
                <td style="font-family:-apple-system,BlinkMacSystemFont,&quot;Segoe UI&quot;,&quot;Roboto&quot;,&quot;Oxygen&quot;,&quot;Ubuntu&quot;,&quot;Cantarell&quot;,&quot;Fira Sans&quot;,&quot;Droid Sans&quot;,&quot;Helvetica Neue&quot;,sans-serif">

                    <img src=https://www.thejacouture.in/'.$img[0].' style="margin-right:15px;border-radius:8px;border:1px solid #e5e5e5" width="60" height="60" align="left" class="CToWUd">
                </td>
                <td style="font-family:-apple-system,BlinkMacSystemFont,&quot;Segoe UI&quot;,&quot;Roboto&quot;,&quot;Oxygen&quot;,&quot;Ubuntu&quot;,&quot;Cantarell&quot;,&quot;Fira Sans&quot;,&quot;Droid Sans&quot;,&quot;Helvetica Neue&quot;,sans-serif;width:100%">
                    <span style="font-size:16px;font-weight:600;line-height:1.4;color:#555">'.$orderdata['name'].'</span><br>
                    <span style="font-size:16px;font-weight:600;line-height:1.4;color:#555">&nbsp;×&nbsp;'.$orderdata['qty'].'</span><br>
                </td>
                <td style="font-family:-apple-system,BlinkMacSystemFont,&quot;Segoe UI&quot;,&quot;Roboto&quot;,&quot;Oxygen&quot;,&quot;Ubuntu&quot;,&quot;Cantarell&quot;,&quot;Fira Sans&quot;,&quot;Droid Sans&quot;,&quot;Helvetica Neue&quot;,sans-serif;white-space:nowrap">

                    <p style="color:#555;line-height:150%;font-size:16px;font-weight:600;margin:0 0 0 15px" align="right">

                        ₹ '.$price.'

                    </p>
                </td>
            </tr>';
				  $j++;}

        $message1.='</tbody>
    </table>
</td>
</tr></tbody>
                        </table>

                        <table style="width:100%;border-spacing:0;border-collapse:collapse;margin-top:15px;border-top-width:1px;border-top-color:#e5e5e5;border-top-style:solid">
                            <tbody>
                                <tr>
                                    <td style="font-family:-apple-system,BlinkMacSystemFont,&quot;Segoe UI&quot;,&quot;Roboto&quot;,&quot;Oxygen&quot;,&quot;Ubuntu&quot;,&quot;Cantarell&quot;,&quot;Fira Sans&quot;,&quot;Droid Sans&quot;,&quot;Helvetica Neue&quot;,sans-serif;width:40%"></td>
                                    <td style="font-family:-apple-system,BlinkMacSystemFont,&quot;Segoe UI&quot;,&quot;Roboto&quot;,&quot;Oxygen&quot;,&quot;Ubuntu&quot;,&quot;Cantarell&quot;,&quot;Fira Sans&quot;,&quot;Droid Sans&quot;,&quot;Helvetica Neue&quot;,sans-serif">
                                        <table style="width:100%;border-spacing:0;border-collapse:collapse;margin-top:20px">



                                            <tbody>
                                                <tr>
                                                    <td style="font-family:-apple-system,BlinkMacSystemFont,&quot;Segoe UI&quot;,&quot;Roboto&quot;,&quot;Oxygen&quot;,&quot;Ubuntu&quot;,&quot;Cantarell&quot;,&quot;Fira Sans&quot;,&quot;Droid Sans&quot;,&quot;Helvetica Neue&quot;,sans-serif;padding:5px 0">
                                                        <p style="color:#777;line-height:1.2em;font-size:16px;margin:0">
                                                            <span style="font-size:16px">Subtotal</span>
                                                        </p>
                                                    </td>
                                                    <td style="font-family:-apple-system,BlinkMacSystemFont,&quot;Segoe UI&quot;,&quot;Roboto&quot;,&quot;Oxygen&quot;,&quot;Ubuntu&quot;,&quot;Cantarell&quot;,&quot;Fira Sans&quot;,&quot;Droid Sans&quot;,&quot;Helvetica Neue&quot;,sans-serif;padding:5px 0" align="right">
                                                        <b style="font-size:16px;color:#555">₹ '.$sub_total.'</b>
                                                    </td>
                                                </tr>


                                                <tr>
                                                    <td style="font-family:-apple-system,BlinkMacSystemFont,&quot;Segoe UI&quot;,&quot;Roboto&quot;,&quot;Oxygen&quot;,&quot;Ubuntu&quot;,&quot;Cantarell&quot;,&quot;Fira Sans&quot;,&quot;Droid Sans&quot;,&quot;Helvetica Neue&quot;,sans-serif;padding:5px 0">
                                                        <p style="color:#777;line-height:1.2em;font-size:16px;margin:0">
                                                            <span style="font-size:16px">Shipping</span>
                                                        </p>
                                                    </td>
                                                    <td style="font-family:-apple-system,BlinkMacSystemFont,&quot;Segoe UI&quot;,&quot;Roboto&quot;,&quot;Oxygen&quot;,&quot;Ubuntu&quot;,&quot;Cantarell&quot;,&quot;Fira Sans&quot;,&quot;Droid Sans&quot;,&quot;Helvetica Neue&quot;,sans-serif;padding:5px 0" align="right">
                                                        <b style="font-size:16px;color:#555">₹ '.$ship_cost.'</b>
                                                    </td>
                                                </tr>
												 <tr>
                                                    <td style="font-family:-apple-system,BlinkMacSystemFont,&quot;Segoe UI&quot;,&quot;Roboto&quot;,&quot;Oxygen&quot;,&quot;Ubuntu&quot;,&quot;Cantarell&quot;,&quot;Fira Sans&quot;,&quot;Droid Sans&quot;,&quot;Helvetica Neue&quot;,sans-serif;padding:5px 0">
                                                        <p style="color:#777;line-height:1.2em;font-size:16px;margin:0">
                                                            <span style="font-size:16px">GST</span>
                                                        </p>
                                                    </td>
                                                    <td style="font-family:-apple-system,BlinkMacSystemFont,&quot;Segoe UI&quot;,&quot;Roboto&quot;,&quot;Oxygen&quot;,&quot;Ubuntu&quot;,&quot;Cantarell&quot;,&quot;Fira Sans&quot;,&quot;Droid Sans&quot;,&quot;Helvetica Neue&quot;,sans-serif;padding:5px 0" align="right">
                                                        <b style="font-size:16px;color:#555">₹ '.$gst.'</b>
                                                    </td>
                                                </tr>

                                                </tbody>
                                        </table>
                                        <table style="width:100%;border-spacing:0;border-collapse:collapse;margin-top:20px;border-top-width:2px;border-top-color:#e5e5e5;border-top-style:solid">

                                            <tbody>
                                                <tr>
                                                    <td style="font-family:-apple-system,BlinkMacSystemFont,&quot;Segoe UI&quot;,&quot;Roboto&quot;,&quot;Oxygen&quot;,&quot;Ubuntu&quot;,&quot;Cantarell&quot;,&quot;Fira Sans&quot;,&quot;Droid Sans&quot;,&quot;Helvetica Neue&quot;,sans-serif;padding:20px 0 0">
                                                        <p style="color:#777;line-height:1.2em;font-size:16px;margin:0">
                                                            <span style="font-size:16px">Total</span>
                                                        </p>
                                                    </td>
                                                    <td style="font-family:-apple-system,BlinkMacSystemFont,&quot;Segoe UI&quot;,&quot;Roboto&quot;,&quot;Oxygen&quot;,&quot;Ubuntu&quot;,&quot;Cantarell&quot;,&quot;Fira Sans&quot;,&quot;Droid Sans&quot;,&quot;Helvetica Neue&quot;,sans-serif;padding:20px 0 0" align="right">
                                                        <b style="font-size:24px;color:#555">₹ '.$grant_total.'</b>


                                                    </td>
                                                </tr>

                                            </tbody>
                                        </table>
                                    </td>
                                </tr>
                            </tbody>
                        </table>


                    </td>
                </tr>
            </tbody>
        </table>
    </center>
</td>
</tr>
</tbody>
</table>';


                   $message1.=' <table style="width:100%;border-spacing:0;border-collapse:collapse;border-top-width:1px;border-top-color:#e5e5e5;border-top-style:solid">
                        <tbody>
                            <tr>
                                <td style="font-family:-apple-system,BlinkMacSystemFont,&quot;Segoe UI&quot;,&quot;Roboto&quot;,&quot;Oxygen&quot;,&quot;Ubuntu&quot;,&quot;Cantarell&quot;,&quot;Fira Sans&quot;,&quot;Droid Sans&quot;,&quot;Helvetica Neue&quot;,sans-serif;padding:40px 0">
                                    <center>
                                        <table style="width:560px;text-align:left;border-spacing:0;border-collapse:collapse;margin:0 auto">
                                            <tbody>
                                                <tr>
                                                    <td style="font-family:-apple-system,BlinkMacSystemFont,&quot;Segoe UI&quot;,&quot;Roboto&quot;,&quot;Oxygen&quot;,&quot;Ubuntu&quot;,&quot;Cantarell&quot;,&quot;Fira Sans&quot;,&quot;Droid Sans&quot;,&quot;Helvetica Neue&quot;,sans-serif">
                                                        <h3 style="font-weight:normal;font-size:20px;margin:0 0 25px">Customer information</h3>
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>
                                        <table style="width:560px;text-align:left;border-spacing:0;border-collapse:collapse;margin:0 auto">
                                            <tbody>
                                                <tr>
                                                    <td style="font-family:-apple-system,BlinkMacSystemFont,&quot;Segoe UI&quot;,&quot;Roboto&quot;,&quot;Oxygen&quot;,&quot;Ubuntu&quot;,&quot;Cantarell&quot;,&quot;Fira Sans&quot;,&quot;Droid Sans&quot;,&quot;Helvetica Neue&quot;,sans-serif">

                                                        <table style="width:100%;border-spacing:0;border-collapse:collapse">
                                                            <tbody>
                                                                <tr>

                                                                    <td style="font-family:-apple-system,BlinkMacSystemFont,&quot;Segoe UI&quot;,&quot;Roboto&quot;,&quot;Oxygen&quot;,&quot;Ubuntu&quot;,&quot;Cantarell&quot;,&quot;Fira Sans&quot;,&quot;Droid Sans&quot;,&quot;Helvetica Neue&quot;,sans-serif;padding-bottom:40px;width:50%">
                                                                        <h4 style="font-weight:500;font-size:16px;color:#555;margin:0 0 5px">Shipping address</h4>
																		<p style="color:#777;line-height:150%;font-size:16px;margin:0">'.$shipping_address2['sname'].',<br>'.$shipping_address2['saddr1'].',<br>'.$shipping_address2['saddr2'].',<br>'.$shipping_address2['saddr3'].',<br>'.$shipping_address2['scity'].',<br>'.$shipping_address2['sstate'].' - '.$shipping_address2['scountry'].'.<br>'.$shipping_address2['spincode'].'<br></p>

                                                                    </td>


                                                                    <td style="font-family:-apple-system,BlinkMacSystemFont,&quot;Segoe UI&quot;,&quot;Roboto&quot;,&quot;Oxygen&quot;,&quot;Ubuntu&quot;,&quot;Cantarell&quot;,&quot;Fira Sans&quot;,&quot;Droid Sans&quot;,&quot;Helvetica Neue&quot;,sans-serif;padding-bottom:40px;width:50%">
                                                                        <h4 style="font-weight:500;font-size:16px;color:#555;margin:0 0 5px">Billing address</h4>
                                                                        <p style="color:#777;line-height:150%;font-size:16px;margin:0">'.$billing2['billname'].',<br>'.$billing2['billaddr1'].',<br>'.$billing2['billaddr2'].',<br>'.$billing2['billaddr3'].'<br>'.$billing2['billcity'].',<br>'.$billing2['billstate'].' - '.$billing2['billcountry'].'.<br>'.$billing2['billpincode'].'<br></p>
                                                                    </td>

                                                                </tr>
                                                            </tbody>
                                                        </table>
                                                        <table style="width:100%;border-spacing:0;border-collapse:collapse">
                                                            <tbody>
                                                                <tr>

                                                                    <td style="font-family:-apple-system,BlinkMacSystemFont,&quot;Segoe UI&quot;,&quot;Roboto&quot;,&quot;Oxygen&quot;,&quot;Ubuntu&quot;,&quot;Cantarell&quot;,&quot;Fira Sans&quot;,&quot;Droid Sans&quot;,&quot;Helvetica Neue&quot;,sans-serif;padding-bottom:40px;width:50%">
                                                                        <h4 style="font-weight:500;font-size:16px;color:#555;margin:0 0 5px">Shipping method</h4>
                                                                        <p style="color:#777;line-height:150%;font-size:16px;margin:0">Standard Delivery</p>
                                                                    </td>



                                                                    <td style="font-family:-apple-system,BlinkMacSystemFont,&quot;Segoe UI&quot;,&quot;Roboto&quot;,&quot;Oxygen&quot;,&quot;Ubuntu&quot;,&quot;Cantarell&quot;,&quot;Fira Sans&quot;,&quot;Droid Sans&quot;,&quot;Helvetica Neue&quot;,sans-serif;padding-bottom:40px;width:50%">
                                                                        <h4 style="font-weight:500;font-size:16px;color:#555;margin:0 0 5px">Payment method</h4>



                                                                        <p style="color:#777;line-height:150%;font-size:16px;margin:0"><span style="font-size:16px">Razorpay — <b style="font-size:16px;color:#555">₹ '.$grant_total.'</b></span></p>



                                                                    </td>

                                                                </tr>
                                                            </tbody>
                                                        </table>

                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </center>
                                </td>
                            </tr>
                        </tbody>
                    </table>

                    <table style="width:100%;border-spacing:0;border-collapse:collapse;border-top-width:1px;border-top-color:#e5e5e5;border-top-style:solid">
                        <tbody>
                            <tr>
                                <td style="font-family:-apple-system,BlinkMacSystemFont,&quot;Segoe UI&quot;,&quot;Roboto&quot;,&quot;Oxygen&quot;,&quot;Ubuntu&quot;,&quot;Cantarell&quot;,&quot;Fira Sans&quot;,&quot;Droid Sans&quot;,&quot;Helvetica Neue&quot;,sans-serif;padding:35px 0">
                                    <center>
                                        <table style="width:560px;text-align:left;border-spacing:0;border-collapse:collapse;margin:0 auto">
                                            <tbody>
                                                <tr>
                                                    <td style="font-family:-apple-system,BlinkMacSystemFont,&quot;Segoe UI&quot;,&quot;Roboto&quot;,&quot;Oxygen&quot;,&quot;Ubuntu&quot;,&quot;Cantarell&quot;,&quot;Fira Sans&quot;,&quot;Droid Sans&quot;,&quot;Helvetica Neue&quot;,sans-serif">

                                                        <p style="color:#999;line-height:150%;font-size:14px;margin:0">If you have any questions, <a href="#" style="font-size:14px;text-decoration:none;color:#397d1e" target="_blank">please complete our contact form here</a> and include your order number</p>
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </center>
                                </td>
                            </tr>
                        </tbody>
                    </table>

                </td>
            </tr>
        </tbody>
    </table>

</body>

</html>';


$shipping_address1=json_decode($shipping_address,true);
$billing1=json_decode($billing_address,true);
$orderdata1=json_decode($ord_detail,TRUE);

$content ='';
$content.='
<style>
table{
	background:#f1e8d7;
}
td{
    border-top: 1px solid #ddd;
	    line-height: 1.42857143;
    vertical-align: top;
	padding-top:10px;
	}
th.head1{
    padding-top: 10px;
    padding-bottom: 10px;
    position: relative;
    background: #52394a;
    color: #fff;
    font-weight: bolder;
    padding-left: 10px;
}
table.box{
	padding-top: 10px;
    padding-bottom: 15px;
    background: #d3b88433;
}
</style>
<table style="width: 100%; border: none; background:#fff;">
<tr>
<td style="width: 50%;">
<img src="https://www.thejacouture.in/images/logo.png" width="150" align="left" style="width: 150px;margin: 0 auto;padding: 0;">
</td>
<td style="width: 50%;" align="right">Invoice: #'.$myorder_id.'</td>
</tr>
</table>



 <table class="fl1" style="width: 100%; border: solid 1px black;">

	<tr>
	<!--Billing Details-->
	<td style="width: 33.4%;">
	 <table style="width: 100%;" >
	 <tr><th style="width: 100%;padding:10px;" align="center" class="head1">Billing Details</th></tr>
	  <tr><td><strong>'.$billing1['billname'].'</strong><br/>'
                            .$billing1['billaddr1'].','.$billing1['billaddr2'].','.$billing1['billaddr3'].'<br>'.$billing1['billcity'].'<br>'.$billing1['billstate'].'<br>'.$billing1['billcountry'].'<br>Pincode -'.$billing1['billpincode'].'<br>
                            <strong>'.$billing1['billmobile'].',<br>'.$billing1['billaltr_mobile'].'<br></strong><strong>'.' '.'</strong><br></td></tr>
	 </table>
	</td>
	<!--order info-->
	<td style="width: 33.4%;">
	 <table style="width: 100%;">
	 <tr><th style="width: 100%;padding:10px;" align="center" class="head1">Order Information</th></tr>
	 <tr><td> <strong>Order Date: </strong>'.date('d M y').'<br>
	 <strong>Payment Status: </strong>Success<br>
	 <strong>Order Type: </strong>Razorpay<br></td></tr>
	 </table>
	</td>
<!--shipping info -->
	<td style="width: 33.3%;">
	 <table style="width: 100%;">
	 <tr><th style="width: 100%;padding:10px;" align="center" class="head1">Shipping Address</th></tr>
	 <tr><td><strong>'.$shipping_address1['sname'].'</strong><br/>'
                            .$shipping_address1['saddr1'].','.$shipping_address1['saddr2'].','.$shipping_address1['saddr3'].'<br>'.$shipping_address1['scity'].'<br>'.$shipping_address1['sstate'].'<br>'.$shipping_address1['scountry'].'<br>'.$shipping_address1['spincode'].'
                            <strong><br>'.$shipping_address1['smobile'].',<br>'.$shipping_address1['saltr_mobile'].'<br></strong><strong>'.$shipping_address1['semail'].'</strong><br></td></tr>
	 </table>
	</td>

	</tr>
 <tr><td><br/></td></tr>
  <tr>
   <table style="width: 100%; border: solid 1px black;">
  <tr><th style="width: 100%;padding:10px;" align="center" colspan="4" class="head1">Order summary</th></tr>
 <tr><td><br/></td></tr>

   <tr>
  <th style="width: 25%;padding-left: 25px;text-align: left;">Product Name</th>
  <th style="width: 25%;">Unit</th>
  <th style="width: 25%;padding: 15px;text-align: left;">Quantity</th>
  <th style="width: 25%;text-align: right;padding: 15px;">Total</th>
  </tr>';


                                                  foreach($orderdata1 as $orderdata){
                                                    $content.='<tr><td style="width: 25%;padding-left: 25px;text-align: left;">'.$orderdata['name'].'</td>
                                                    <td>'.$orderdata['qty'].'</td>
                                                     <td style="width: 25%;padding: 15px;text-align: left;">'.$orderdata['qty'].'</td>';

                                                if(($orderdata['offer']!='') && ($orderdata['offer']!='0')){
                                                  $dicsprice=($orderdata['price'])-(($orderdata['offer']/100)*$orderdata['price']);
                                                   $content.='<td style="width: 25%;text-align: right;padding: 15px;"><span id="prdiscount"><del>  '.$orderdata['price'].'</del></span>&nbsp;<ins>  <span id="prprice">'.$dicsprice.'</span></ins></td>';
                                                }else{
                                                   $content.='<td style="width: 25%;text-align: right;padding: 15px;"><ins>  '.$orderdata['price'].'</ins></td>';
                                                }


                                                       $content.='</tr>';
                                                  }
  $content.=' <tr>
  <td style="width: 25%;padding-left: 25px;text-align: left;"></td>
  <td style="width: 25%;"></td>
  <td style="width: 25%;padding: 15px;text-align: left;">Subtotal</td>
  <td style="width: 25%;text-align: right;padding: 15px;"> '.$sub_total.'</td>
  </tr>';
  if($coupon_percent!=''){
    $content.=' <tr>
  <td style="width: 25%;padding-left: 25px;text-align: left;"></td>
  <td style="width: 25%;"></td>
  <td style="width: 25%;padding: 15px;text-align: left;">Coupon Applied</td>
  <td style="width: 25%;text-align: right;padding: 15px;">'.$coupon_percent.'</td>
  </tr>';
  }
 $content.=' <tr>
  <td style="width: 25%;padding-left: 25px;text-align: left;"></td>
  <td style="width: 25%;"></td>
  <td style="width: 25%;padding: 15px;text-align: left;">Shipping Cost</td>
  <td style="width: 25%;text-align: right;padding: 15px;">'.$ship_cost.'</td>
  </tr>';

 $content.=' <tr>
  <td style="width: 25%;padding-left: 25px;text-align: left;"></td>
  <td style="width: 25%;"></td>
  <td style="width: 25%;padding: 15px;text-align: left;">GST</td>
  <td style="width: 25%;text-align: right;padding: 15px;">'.$gst.'</td>
  </tr>';
  
 
  $content.='<tr>
  <td style="width: 25%;padding-left: 25px;text-align: left;"></td>
  <td style="width: 25%;"></td>
  <td style="width: 25%;padding: 15px;text-align: left;">Grant Total</td>
  <td style="width: 25%;text-align: right;padding: 15px;"> '.$grant_total.'</td>
  <td style="width: 25%;text-align: left;padding: 15px;"> </td>
  </tr>
  </table>
  </tr>
 </table>';
require_once('html2pdf/html2pdf.class.php');
$html2pdf = new HTML2PDF('P', 'A4', 'en');

        $html2pdf->setDefaultFont('Arial');
        $html2pdf->writeHTML($content, isset($_GET['vuehtml']));

        $html2pdf = new HTML2PDF('P', 'A4', 'en');
        $html2pdf->WriteHTML($content);


         $to = $billing1['billemail'];
        // $to = "suganya.clouddreams@gmail.com";
       // $from = 'thejalcouture@gmail.com';
        $from = 'noreply@thejacouture.in';
        $subject = "Your order has been placed";

        
        $separator = md5(time());
        $eol = PHP_EOL;
        $filename = "invoice.pdf";
        $pdfdoc = $html2pdf->Output('', 'S');
        $attachment = chunk_split(base64_encode($pdfdoc));

        $headers = "From: " . $from . $eol;
        $headers .= "MIME-Version: 1.0" . $eol;
        $headers .= "Content-Type: multipart/mixed; boundary=\"" . $separator . "\"" . $eol . $eol;

        $body = '';

        $body .= "Content-Transfer-Encoding: 7bit" . $eol;
        $body .= "This is a MIME encoded message." . $eol; //had one more .$eol


        $body .= "--" . $separator . $eol;
        $body .= "Content-Type: text/html; charset=\"iso-8859-1\"" . $eol;
        $body .= "Content-Transfer-Encoding: 8bit" . $eol . $eol;
        $body .= $message1 . $eol;


        $body .= "--" . $separator . $eol;
        $body .= "Content-Type: application/octet-stream; name=\"" . $filename . "\"" . $eol;
        $body .= "Content-Transfer-Encoding: base64" . $eol;
        $body .= "Content-Disposition: attachment" . $eol . $eol;
        $body .= $attachment . $eol;
        $body .= "--" . $separator . "--";

// Sending email
  if (mail($to, $subject, $body, $headers)) {
          //  echo "Thank You for your contribution";
          } else {
               echo "Error occured plaese try again";
          }
?>