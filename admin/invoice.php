<?php include("header.php"); ?>
<?php include("nav_bar.php"); ?>
<?php include("nav_left.php");?>
<?php if(empty($_SESSION['urights'])){
  header('location:index.php');
}
$orderinfo=$db->queryUniqueObject("SELECT * FROM orders WHERE id='$_GET[id]'");
?>
       <div class="main">
            <!-- MAIN CONTENT -->
            <div class="main-content">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-md-12">
                            <!-- BASIC TABLE -->
                            <div class="panel" id="content">
                             
        <div class="col-xs-12">
            <div class="row">
            <div class="col-xs-4">
                <img src="uploads/companylogo/logo.png" class="img-responsive" style="width: 200px; padding-top: 15px;">
            </div>
             <div class="col-xs-8">
                <div class="text-right">
                <h3>Invoice: #<?=$orderinfo->order_id;?></h3>
            </div>
            </div>
            </div>
            <hr>
             </div>
            <div class="col-xs-12">
            
            <div class="row">
                <div class="col-xs-12 col-md-4 col-lg-4">
                    <div class="panel panel-default height">
                        <div class="panel-heading">Billing Details</div>
                        <div class="panel-body">
                             <?php $billing=json_decode($orderinfo->billing_address,true);?>
                            <strong><?=$billing['billname'];?></strong><br>
                            <?=$billing['billaddr1'];?><br>
                            <?=$billing['billcity'];?><br>
                            <?=$billing['billstate'];?><br>
                            <strong><?=$billing['billmobile'];?></strong><br>
                            <strong><?=$billing['billemail'];?></strong><br>
                        </div>
                    </div>
                </div>
                <div class="col-xs-12 col-md-4 col-lg-4">
                    <div class="panel panel-default height">
                        <div class="panel-heading">Order Information</div>
                        <div class="panel-body">
                            <strong>Order Date</strong> <?=$orderinfo->date;?><br>
                            <strong>Payment Status:</strong> <?=$orderinfo->payment_status;?><br>
                            <strong>Order Type:</strong> <?php if($orderinfo->order_type=="2"){
                             echo "Online Payment";   
                            }?><br>
                            <?php if($orderinfo->coupon_status=='1'){
                                echo "<strong>Coupon Status:</strong>Applied<br>";
                            }?>
                            

                        </div>
                    </div>
                </div>
                <div class="col-xs-12 col-md-4 col-lg-4 pull-right">
                    <div class="panel panel-default height">
                        <div class="panel-heading">Shipping Address</div>

                        <div class="panel-body">
                            <?php $shipping=json_decode($orderinfo->shipping_address,true);?>
                            <strong><?=$shipping['sname'];?></strong><br>
                            <?=$shipping['saddr1'];?><br>
                            <?=$shipping['scity'];?><br>
                            <?=$shipping['sstate'];?><br>
                            <strong><?=$shipping['smobile'];?></strong><br>
                            <strong><?=$shipping['semail'];?></strong><br>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    <div class="row">
        <div class="col-md-12">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h4 class="text-center"><strong>Order summary</strong></h4>
                </div>
                <div class="panel-body">
                    <div class="table-responsive">
                        <table class="table table-condensed">
                            <thead>
                                <tr>
                                    <td><strong>Product Name</strong></td>
                                   
                                    <td ><strong>Quantity</strong></td>
                                    <td class="text-right"><strong>Total</strong></td>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $orderdata=json_decode($orderinfo->order_detail,TRUE);
                                                  foreach($orderdata as $orderdata){
                                                    //print_r($orderdata['product_id']);
                                            $sandc=$db->queryUniqueObject("SELECT size,color FROM products WHERE product_id='$orderdata[product_id]'");
                                            $sizeand=$db->queryUniqueObject("SELECT size_name FROM variation_size WHERE size_id='$sandc->size'");
                                            $colorand=$db->queryUniqueObject("SELECT color_name FROM variation_color WHERE color_id='$sandc->color'");
                                                    echo '<tr>
                                                    <td><h5>'.$orderdata['name'].'<br/>Size:'. $sizeand->size_name.' Color:'. $colorand->color_name.'</td>
                                                    <td><h5>'.$orderdata['qty'].'</td>
                                                     ';

                                                if(($orderdata['offer']!='') && ($orderdata['offer']!='0')){
                                                  $dicsprice=($orderdata['price'])-(($orderdata['offer']/100)*$orderdata['price']);
                                                   echo '<td class="text-right"><span id="prdiscount"><del> ₹ '.$orderdata['price'].'</del></span>&nbsp;<ins> ₹ <span id="prprice">'.$dicsprice.'</span></ins></td>';
                                                }else{
                                                   echo '<td class="text-right"><ins> ₹ '.$orderdata['price'].'</ins></td>';
                                                }


                                                       echo '</tr>';
                                                  }
                                                   ?>
                                <tr>
                                    <td class="highrow"></td>
                                    <td class="highrow text-center"><strong>Subtotal</strong></td>
                                    <td class="highrow text-right">₹ <?=$orderinfo->total_price;?></td>
                                </tr>
                                <?php if($orderinfo->coupon_status=='1'){ ?>
                                    <tr>
                                    <td class="emptyrow"></td>
                                    <td class="highrow"></td>
                                    <td class="emptyrow text-center"><strong>Coupon Applied</strong></td>
                                    <td class="emptyrow text-right"><?=$orderinfo->coupon_percent;?> %</td>
                                </tr>
                                <?php } ?>
                                <tr>
                                    <td class="emptyrow"></td>
                                    <td class="emptyrow text-center"><strong>GST (5%)</strong></td>
                                    <td class="emptyrow text-right">
                                         <?php if($orderinfo->coupon_status=='1'){
                                        echo " ₹ ".(0.05)*$orderinfo->grant_total;
                                     }else{
                                        echo " ₹ ".(0.05)*$orderinfo->total_price;
                                     }?></td>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="emptyrow"></td>
                                    <td class="emptyrow text-center"><strong>Grant Total</strong></td>
                                    <td class="emptyrow text-right">
                                     <?php if($orderinfo->coupon_status=='1'){
                                        echo " ₹ ".$orderinfo->grant_total;
                                     }else{
                                        echo " ₹ ".$orderinfo->total_price;
                                     }?></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    <p style="color:#ff0000;">* Product inclusive of all taxes</p>
                </div>
            </div>
        </div>
    </div>
     </div>
</div>
<div id="editor"></div>
  <!-- <form action="invoice_mail.php">
            <input type="text" name="txt" />
            <input type="submit" name="insert" value="addFunction" onclick="addFunction()" />
        </form> -->
<button id="cmd">Generate PDF</button>

                        </div>
                    </div>
                </div>
            </div>
        </div>
        <?php include('footer.php'); ?>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/html2canvas/0.4.1/html2canvas.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/1.5.3/jspdf.min.js"></script>
        <script>
            var doc = new jsPDF();
var specialElementHandlers = {
    '#editor': function (element, renderer) {
        return true;
    }
};

$('#cmd').click(function () {   
    // doc.fromHTML($('#content').html(), 15, 15, {
    //     'width': 170,
    //         'elementHandlers': specialElementHandlers
    // });
    // doc.save('sample-file.pdf');
    var pdf = new jsPDF('p', 'pt', 'letter');
 pdf.addHTML($('#content')[0], function () {
     pdf.save('invoice.pdf');
 });
});
        </script>

    </body>
    </html>