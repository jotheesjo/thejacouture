<?php
  function addFunction($shipping_address,$billing_address,$payment_type,$sub_total,$grant_total,$coupon_percent,$ord_detail) {
           //return $shipping_address;
$shipping_address=json_decode($shipping_address,true);
$billing=json_decode($billing_address,true);
 $orderdata=json_decode($ord_detail,TRUE);
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
<img src="https://www.tradibha.com/images/footer_logo.png" width="150" align="left" style="width: 150px;margin: 0 auto;padding: 0;">
</td>
<td style="width: 50%;" align="right">Invoice: #TRZ50000</td>
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
	 <tr><td><strong>'.$shipping_address['shipname'].'</strong><br/>'
                            .$shipping_address['shipaddr1'].','.$shipping_address['shipaddr2'].','.$shipping_address['shipaddr3'].'<br>'.$shipping_address['shipcity'].'<br>'.$shipping_address['shipstate'].'<br>'.$shipping_address['shippincode'].'
                            <strong>'.$shipping_address['shipmobile'].','.$shipping_address['shipaltr_mobile'].'<br></strong><strong>'.$shipping_address['shipemail'].'</strong><br></td></tr>
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
                                                   $content.='<td style="width: 25%;text-align: right;padding: 15px;"><span id="prdiscount"><del> INR '.$orderdata['price'].'</del></span>&nbsp;<ins> INR <span id="prprice">'.$dicsprice.'</span></ins></td>';
                                                }else{
                                                   $content.='<td style="width: 25%;text-align: right;padding: 15px;"><ins> INR '.$orderdata['price'].'</ins></td>';
                                                }


                                                       $content.='</tr>';
                                                  }
  $content.=' <tr>
  <td style="width: 25%;padding-left: 25px;text-align: left;"></td>
  <td style="width: 25%;"></td>
  <td style="width: 25%;padding: 15px;text-align: left;">Subtotal</td>
  <td style="width: 25%;text-align: right;padding: 15px;">INR '.$sub_total.'</td>
  </tr>';
  if($coupon_percent!=''){
    $content.=' <tr>
  <td style="width: 25%;padding-left: 25px;text-align: left;"></td>
  <td style="width: 25%;"></td>
  <td style="width: 25%;padding: 15px;text-align: left;">Coupon Applied</td>
  <td style="width: 25%;text-align: right;padding: 15px;">'.$coupon_percent.'</td>
  </tr>';
  }
 
  $content.='<tr>
  <td style="width: 25%;padding-left: 25px;text-align: left;"></td>
  <td style="width: 25%;"></td>
  <td style="width: 25%;padding: 15px;text-align: left;">Grant Total</td>
  <td style="width: 25%;text-align: right;padding: 15px;">INR '.$grant_total.'</td>
  </tr>
  </table>
  </tr>
 </table> ';

 require_once('include/html2pdf/html2pdf.class.php');


        $html2pdf = new HTML2PDF('P', 'A4', 'en');

        $html2pdf->setDefaultFont('Arial');
        $html2pdf->writeHTML($content, isset($_GET['vuehtml']));

        $html2pdf = new HTML2PDF('P', 'A4', 'en');
        $html2pdf->WriteHTML($content);
      }

