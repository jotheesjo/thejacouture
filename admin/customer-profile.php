<?php include("header.php");
include("nav_bar.php");
include("nav_left.php");
$info=$db->queryUniqueObject("SELECT * FROM customer WHERE customer_id='$_GET[id]'"); ?>
   <div class="main">
            <!-- MAIN CONTENT -->
            <div class="main-content">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-md-5">
                            <div class="panel">
                                <div class="panel-heading">
                                    <h3 class="panel-title">Customer Information</h3>
                                </div>
                                <div class="panel-body">
                                 <table width="100%"  class="table convert-data-table table-striped">
                                        <thead>
                                            <tr><th>Name</th><th><?=$info->name?></th></tr>
                                            <tr><th>Email</th><th><?=$info->email;?></th></tr>
                                            <tr><th>Status</th><th><?php if($info->status=='0'){ echo 'Inactive';}else{ echo 'Active'; };?></th></tr>
                                        </thead>
                                    </table>
                                </div>
                              </div>
                            </div>

                            <div class="col-md-7">
                            <div class="panel">
                                <div class="panel-heading">
                                    <h3 class="panel-title">Order Information</h3>
                                </div>
                                <div class="panel-body">
                                <div class="col-sm-12">
                                  <div class="table-responsive">
                                            <table id="datatable" class="table responsive-data-table  dataTable" role="grid" aria-describedby="datatable_info">
                                                <thead>
                                                <tr role="row">
                                                <th  >S.No</th>
                                                 <th >Order&nbsp;Id</th>
                                                 <th>Order&nbsp;Price</th>
                                                 <th>Payment&nbsp;Type</th>
                                                 <th>Order&nbsp;Date</th>
                                                 <th>Order&nbsp;Status</th>
                                                 <th>Action</th>
                                            </tr>
                                               </thead>
                                                <tbody>
                                                  <?php $order = $db->query("select * from orders WHERE user_id='$_GET[id]'");
$i=1;  while($bv = mysqli_fetch_array($order)){
            ?> 
<tr>
<td><?php echo   $i++; ?></td>
<td><?=$bv['order_id'];?></td>
<td><?=$bv['total_price'];?></td>
<td><?=$bv['order_type'];?></td>
<td><?=$bv['date'];?></td>
<td><?=$bv['order_status'];?></td>
<td><a href="order-information.php?ordid=<?=$bv['id'];?>&userid=<?=$info->id;?>" class="btn btn-sm btn-primary"><i class="lnr lnr-eye"></i></a></td>
</tr>
<?php } ?> 
</tbody>
</table>
</div>
</div>
                                </div>
                              </div>
                            </div>


<div class="col-md-12">
  <div class="panel">
    <div class="panel-heading">
      <h3 class="panel-title">Saved Address</h3>
    </div>
    <div class="panel-body">
      <?php $infoaddress=$db->query("SELECT * FROM customer_address WHERE customer_id='$_GET[id]'"); ?>
      <table width="100%"  class="table convert-data-table table-striped">
        <thead>
          <tr>
            <th>Name</th>
            <th>E-mail</th>
            <th>Mobile</th>
            <th>Alternative Mobile</th>
            <th>Address</th>
            <th>City</th>
            <th>State</th>
            <th>Country</th>
            <th>Pincode</th>
          </tr>
          </thead>
          <tbody>
          <?php while($savaddr=mysqli_fetch_array($infoaddress)){ ?>
            <tr>
              <td><?=$savaddr['name'];?></td>
              <td><?=$savaddr['email'];?></td>
              <td><?=$savaddr['phone'];?></td>
              <td><?=$savaddr['alter_phone'];?></td>
              <td><?=$savaddr['addr1'].", ".$savaddr['addr2'].", ".$savaddr['addr3'];?></td>
              <td><?=$savaddr['city'];?></td>
              <td><?=$savaddr['state'];?></td>
              <td><?=$savaddr['country'];?></td>
              <td><?=$savaddr['zip'];?></td>
            </tr>
          <?php } ?>
        </tbody>
      </table>
    </div>
  </div>
</div>
</div>
</div>
</div>
<?php include("footer.php") ?>