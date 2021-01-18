<?php
  function addFunction($shipping_address,$billing_address,$payment_type,$sub_total,$grant_total,$coupon_percent,$ord_detail,$myorder_id) {
           //return $shipping_address;
$shipping_address=json_decode($shipping_address,true);
$billing=json_decode($billing_address,true);
$orderdata=json_decode($ord_detail,TRUE);

$gst=0.05*$grant_total;



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

                                                                        <img src="http://icloudcs.in/Queens_Jewel_Emporium/website/assets/img/logo/logo.png" alt="" width="120" class="CToWUd">

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



                                                            Dear '.$uname.',

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

                                                                                    <td style="font-family:-apple-system,BlinkMacSystemFont,&quot;Segoe UI&quot;,&quot;Roboto&quot;,&quot;Oxygen&quot;,&quot;Ubuntu&quot;,&quot;Cantarell&quot;,&quot;Fira Sans&quot;,&quot;Droid Sans&quot;,&quot;Helvetica Neue&quot;,sans-serif;border-radius:4px" bgcolor="#397e1e" align="center"><a href="http://icloudcs.in/Queens_Jewel_Emporium/website/order-history.php?order_id='.$ordid.'" style="font-size:16px;text-decoration:none;display:block;color:#fff;padding:20px 25px" target="_blank">VIEW YOUR ORDER</a></td>

                                                                                </tr>

                                                                            </tbody>

                                                                        </table>



                                                                        <table style="border-spacing:0;border-collapse:collapse;margin-top:19px">

                                                                            <tbody>

                                                                                <tr>

                                                                                    <td style="font-family:-apple-system,BlinkMacSystemFont,&quot;Segoe UI&quot;,&quot;Roboto&quot;,&quot;Oxygen&quot;,&quot;Ubuntu&quot;,&quot;Cantarell&quot;,&quot;Fira Sans&quot;,&quot;Droid Sans&quot;,&quot;Helvetica Neue&quot;,sans-serif">or <a href="http://icloudcs.in/Queens_Jewel_Emporium/website/" style="font-size:16px;text-decoration:none;color:#397e1e" target="_blank">Visit our store</a>

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

                 foreach($orderdata as $orderdata){

                                                    $pid=$orderdata['product_id'];

                                                   

                                                    if($orderdata['att']!='')

													{

                                                    $size=$orderdata['att'];

													}else{

													$size="-";

													}

                    $product=mysqli_fetch_array(mysqli_query($conn,"SELECT * FROM products WHERE product_id='$pid'"));

                    $img=json_decode($product['img_path']);

                    $price=$orderdata['price']*$orderdata['qty'];   

                    $grand_total=  $price+ $grand_total;  

                     $gst=$grand_total*3/100;  

                            

                    

            $message1.='<tr>

                <td style="font-family:-apple-system,BlinkMacSystemFont,&quot;Segoe UI&quot;,&quot;Roboto&quot;,&quot;Oxygen&quot;,&quot;Ubuntu&quot;,&quot;Cantarell&quot;,&quot;Fira Sans&quot;,&quot;Droid Sans&quot;,&quot;Helvetica Neue&quot;,sans-serif">



                    <img src=http://icloudcs.in/Queens_Jewel_Emporium/website/'.$img[0].' style="margin-right:15px;border-radius:8px;border:1px solid #e5e5e5" width="60" height="60" align="left" class="CToWUd">

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

                                                        <b style="font-size:16px;color:#555">₹ '.$grand_total.'</b>

                                                    </td>

                                                </tr>





                                                <tr>

                                                    <td style="font-family:-apple-system,BlinkMacSystemFont,&quot;Segoe UI&quot;,&quot;Roboto&quot;,&quot;Oxygen&quot;,&quot;Ubuntu&quot;,&quot;Cantarell&quot;,&quot;Fira Sans&quot;,&quot;Droid Sans&quot;,&quot;Helvetica Neue&quot;,sans-serif;padding:5px 0">

                                                        <p style="color:#777;line-height:1.2em;font-size:16px;margin:0">

                                                            <span style="font-size:16px">Shipping</span>

                                                        </p>

                                                    </td>

                                                    <td style="font-family:-apple-system,BlinkMacSystemFont,&quot;Segoe UI&quot;,&quot;Roboto&quot;,&quot;Oxygen&quot;,&quot;Ubuntu&quot;,&quot;Cantarell&quot;,&quot;Fira Sans&quot;,&quot;Droid Sans&quot;,&quot;Helvetica Neue&quot;,sans-serif;padding:5px 0" align="right">

                                                        <b style="font-size:16px;color:#555">₹ '.$feth_ord['ship_cost'].'</b>

                                                    </td>

                                                </tr>

                                                 <tr>

                                                    <td style="font-family:-apple-system,BlinkMacSystemFont,&quot;Segoe UI&quot;,&quot;Roboto&quot;,&quot;Oxygen&quot;,&quot;Ubuntu&quot;,&quot;Cantarell&quot;,&quot;Fira Sans&quot;,&quot;Droid Sans&quot;,&quot;Helvetica Neue&quot;,sans-serif;padding:5px 0">

                                                        <p style="color:#777;line-height:1.2em;font-size:16px;margin:0">

                                                            <span style="font-size:16px">IGST</span>

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

                                                        <b style="font-size:24px;color:#555">₹ '.$feth_ord['grant_total'].'</b>

                                                       

                                                       

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

                                                                        <p style="color:#777;line-height:150%;font-size:16px;margin:0">'.$shipping_address['shipname'].',<br>'.$shipping_address['shipaddr1'].',<br>'.$shipping_address['shipaddr1'].',<br>'.$shipping_address['shipcity'].',<br>'.$shipping_address['shipstate'].' - '.$shipping_address['shippincode'].'.<br>'.$shipping_address['shipmobile'].'<br></p>

                                                                    </td>





                                                                    <td style="font-family:-apple-system,BlinkMacSystemFont,&quot;Segoe UI&quot;,&quot;Roboto&quot;,&quot;Oxygen&quot;,&quot;Ubuntu&quot;,&quot;Cantarell&quot;,&quot;Fira Sans&quot;,&quot;Droid Sans&quot;,&quot;Helvetica Neue&quot;,sans-serif;padding-bottom:40px;width:50%">

                                                                        <h4 style="font-weight:500;font-size:16px;color:#555;margin:0 0 5px">Billing address</h4>

                                                                        <p style="color:#777;line-height:150%;font-size:16px;margin:0">'.$billing['billname'].',<br>'.$billing['billaddr1'].',<br>'.$billing['billaddr2'].',<br>'.$billing['billcity'].',<br>'.$billing['billstate'].' - '.$billing['billpincode'].'.<br>'.$billing['billmobile'].'<br></p>

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







                                                                        <p style="color:#777;line-height:150%;font-size:16px;margin:0"><span style="font-size:16px">'.$feth_ord['order_type'].' — <b style="font-size:16px;color:#555">₹ '.$feth_ord['grant_total'].'</b></span></p>







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

<img src="https://cdn11.bigcommerce.com/s-qdvv4q1od0/images/stencil/250x100/1559063151497_final1_converted_1563633104__37380.original.png" width="150" align="left" style="width: 150px;margin: 0 auto;padding: 0;">

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

	  <tr><td><strong>'.$billing['billname'].'</strong><br/>'

                            .$billing['billaddr1'].','.$billing['billaddr2'].','.$billing['billaddr3'].'<br>'.$billing['billcity'].'<br>'.$billing['billstate'].'<br>'.$billing['billcountry'].'<br>Pincode -'.$billing['billpincode'].'

                            <strong>'.$billing['billmobile'].','.$billing['billaltr_mobile'].'<br></strong><strong>'.' '.'</strong><br></td></tr>

	 </table>

	</td>

	<!--order info-->

	<td style="width: 33.4%;">

	 <table style="width: 100%;">

	 <tr><th style="width: 100%;padding:10px;" align="center" class="head1">Order Information</th></tr>

	 <tr><td> <strong>Order Date: </strong>'.date('d M y').'<br>

	 <strong>Payment Status: </strong>Success<br>

	 <strong>Order Type: </strong>'.$payment_type.'<br></td></tr>

	 </table>

	</td>

<!--shipping info -->

	<td style="width: 33.3%;">

	 <table style="width: 100%;">

	 <tr><th style="width: 100%;padding:10px;" align="center" class="head1">Shipping Address</th></tr>

	 <tr><td><strong>'.$shipping_address['sname'].'</strong><br/>'

                            .$shipping_address['saddr1'].','.$shipping_address['saddr2'].','.$shipping_address['saddr3'].'<br>'.$shipping_address['scity'].'<br>'.$shipping_address['sstate'].'<br>'.$shipping_address['spincode'].'

                            <strong>'.$shipping_address['smobile'].','.$shipping_address['saltr_mobile'].'<br></strong><strong>'.$shipping_address['semail'].'</strong><br></td></tr>

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





                                                  foreach($orderdata as $orderdata){

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

  <td style="width: 25%;padding: 15px;text-align: left;">GST</td>

  <td style="width: 25%;text-align: right;padding: 15px;">'.$gst.'</td>

  </tr>';



  $content.='<tr>

  <td style="width: 25%;padding-left: 25px;text-align: left;"></td>

  <td style="width: 25%;"></td>

  <td style="width: 25%;padding: 15px;text-align: left;">Grant Total</td>

  <td style="width: 25%;text-align: right;padding: 15px;"> '.$grant_total.'</td>

  <td style="width: 25%;text-align: LEFT;padding: 15px;"> <p style="color:#ff0000;">* Product inclusive of all taxes</p></td>

  </tr>

  </table>

  </tr>

 </table> 

 <p style="color:#ff0000;">* Product inclusive of all taxes</p>';



 require_once('include/html2pdf/html2pdf.class.php');





        $html2pdf = new HTML2PDF('P', 'A4', 'en');



        $html2pdf->setDefaultFont('Arial');

        $html2pdf->writeHTML($content, isset($_GET['vuehtml']));



        $html2pdf = new HTML2PDF('P', 'A4', 'en');

        $html2pdf->WriteHTML($content);





         $to = $billing['billemail'];

        // $to = "jothees@clouddreamstech.com";

        $from = 'thejalcouture@gmail.com';

        $subject = "Your order has been placed";



          $message ="<p align='justify'>Dear ".$billing['billname'].", Greetings from Thejal Couture! We thank you for purchasing our product we hope you loving it.<br/>Thank You </p>";

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

        $body .= $message . $eol;





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

 return $content;

         }

         ?>