<?php include("header.php"); ?>
<?php include("nav_bar.php"); ?>
<?php include("nav_left.php"); ?>

<div class="main">
    <!-- MAIN CONTENT -->
    <div class="main-content">
        <div class="container-fluid">
            <div class="row">
             
 <div class="col-md-12">
    <!-- BASIC TABLE -->
    <div class="panel">
        <div class="panel-heading">
            <h3 class="panel-title">Order List</h3>
        </div>
        <div class="panel-body">

            <div class="col-md-12">
                <div class="row">
              
                <form method="post">
                    <div class="col-md-4">
                        From :  <input type="date" name="from" class="form-control"> 
                    </div>
                 <div class="col-md-4">
                 To :  <input type="date" name="to"  class="form-control">
                    </div>
                 <div class="col-md-2"><br/>
                    <input type="submit" class="btn btn-primary" name="search">
                 </div>
                 
             </form>

         <div class="col-md-2"><br/>
              <form method="post">
                 
                 <input type="submit" name="resetsearch" class="btn btn-danger" value="RESET SEARCH">
             </form><br/>
         </div>
         </div>
          </div>


            <table width="100%"  class="table convert-data-table table-striped" id="datatable">
                <thead>
                    <tr>
                        <th>Sno.</th>
                        <th>Order No</th>
                        <th>Purchased On</th>
                        <th>Bill to Name </th>
                        <th>Ship to Name</th>
                        <th>Price</th>
                        <th>Trans ID</th>
                        <th>Payment Status</th>
                        <th>Order Status</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php 
                    if(isset($_POST['search'])){
                        $from=date('Y-m-d',strtotime($_POST['from']));
                        $to=date('Y-m-d',strtotime($_POST['to']));

                        $order = $db->query("select * from orders WHERE payment_status!='success' AND order_status!='success' AND date>='$from' AND date<='$to' ");

                    }else{
                        $order = $db->query("select * from orders WHERE payment_status!='success' AND order_status!='success' ORDER By date DESC ");
                    }
                    $sno = 0;
                    while($row1 = mysqli_fetch_array($order)){ $sno++;
                       $ship=json_decode($row1['shipping_address']);
                       $bill=json_decode($row1['billing_address']);
                       ?>
                       <tr role="row" class="odd <?php if($row1['notification']=='1'){ echo 'fresh'; } ?>">
                         <td><?=$sno;?></td>
                         <td><?=$row1['order_id'];?></td>
                         <td><?=date('M d Y h:i:s a',strtotime($row1['date']));?></td>
                         <td><?php echo $ship->shipname;?></td>
                         <td>
                            <?php echo $bill->billname; ?>
                        </td>
                        <td><?=$row1['total_price'];?></td>
                           <td><?=$row1['txn_id'];?></td>
                        <td><?=$row1['payment_status'];?></td>
                        <td><?=$row1['order_status'];?></td>
                        <td><a href="order-information.php?ordid=<?=$row1['id'];?>&userid=<?=$row1['user_id'];?>" class="btn btn-sm btn-primary"><i class="lnr lnr-eye"></i></a></td>
                    </tr>

                    <?php  
                } ?>
            </tbody>
        </table>
    </div>
</div>
</div>
</div>
</div>
</div>
</div>

<?php include("footer.php"); ?>        