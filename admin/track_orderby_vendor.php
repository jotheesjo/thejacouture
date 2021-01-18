<?php include("header.php") ?>
<?php include("nav_bar.php") ?>
<?php include("nav_left.php") ?>

 
<?php if(isset($_POST['sent_items'])){
	$vendor_order_id=$_POST['vendor_order_id'];
	$spare_id=$_POST['spare_id'];
	$ventor_id=$_POST['ventor_id'];
	$cust_ord_id=$_POST['cust_ord_id'];
	$spare_name=$_POST['spare_name'];
	$ins=$db->query("UPDATE proposed_items SET send_qty = $_POST[send_qty] WHERE spare_id='$spare_id' AND vendor_order_id='$vendor_order_id'");
	$ins2=$db->query("INSERT INTO proposed_items_qty(vendor_order_id,spare_id,spare_name,ventor_id,customer_ord_id,ven_send_qty,ven_send_time) VALUES ('$vendor_order_id','$spare_id','$spare_name','$ventor_id','$cust_ord_id','$_POST[send_qty]',NOW())");
	if ($ins) {
    
          echo ("<SCRIPT LANGUAGE='JavaScript'>
    window.alert('Succesfully  Assigned  .. ')
    window.location.href='track_orderby_vendor.php?getid=$vendor_order_id';
    </SCRIPT>");
    }
    else {
   echo ("<SCRIPT LANGUAGE='JavaScript'>
    window.alert('Error While Adding .. ')
    window.location.href='track_orderby_vendor.php?getid=$vendor_order_id';
    </SCRIPT>");
    }   
	
}
?>
<style type="text/css">
    
    tr:nth-child(even) {background-color: #f2f2f2;}

</style>
<script type="text/javascript">
    
    $(document).ready(function() {
    $('#example').DataTable();
} );

</script>

 <div class="card m-b-20">
     
<section class="panel">
                                    <header class="panel-heading panel-border">
                                        Order List
                                        <span class="tools pull-right">
                                            <a class="refresh-box fa fa-repeat" href="javascript:;"></a>
                                            <a class="collapse-box fa fa-chevron-down" href="javascript:;"></a>
                                            <a class="close-box fa fa-times" href="javascript:;"></a>
                                        </span>
                                    </header>
                                    <div class="panel-body">

			  	 
                                <div class="col-12 panel-body">
                                    <div class="card m-b-20">
                                        <div class="card-block">

                                            <h4 class="mt-0 header-title">Order List</h4>
                                           

                                            <div id="datatable_wrapper" class="dataTables_wrapper container-fluid dt-bootstrap4 no-footer">
                                            <div class="row"><div class="col-sm-12">
											<div class="table-responsive">
                                            <table id="datatable" class="table responsive-data-table  dataTable" role="grid" aria-describedby="datatable_info">
                                                <thead>
                                                <tr role="row">
                                                <th class="sorting_asc" >Sno.</th>
                                                <th class="sorting_asc" >Image </th>
                                                <th class="sorting_asc" >Part ID </th>
												<th class="sorting_asc" >Order ID </th>
                                                <th class="sorting_asc" >MRP </th>
                                                <th class="sorting_asc" >Discount Price </th>
                                                <th class="sorting_asc" >Available Qty </th>
                                                <th class="sorting_asc" >Requested Quantity</th>
												<th class="sorting_asc" >Status</th>
												<!--<th class="sorting_asc" >Send to SF</th>
												<th class="sorting_asc" >Received by SF</th>
												<th class="sorting_asc" >Remarks</th>-->
												<th class="sorting_asc" >action</th> 
												<th class="sorting_asc" >History</th>
												</tr>
                                                </thead>

                                                <tbody>
												
			<?php 
			$proposed_items=$db->query("select * from proposed_items where ventor_id='$_SESSION[id]' AND vendor_order_id='$_GET[getid]' AND status='active'");
			$i=0;
			while($row1=mysqli_fetch_array($proposed_items)){
				$i++;
				
				$product=$db->queryUniqueObject("select * from products where id='$row1[spare_id]'");
				$vendorproduct=$db->queryUniqueObject("select * from vendor_parts where pro_id='$row1[spare_id]' AND tr_id=$_SESSION[id]");
			?>
			<tr>
			<td><?= $i;?></td>
			<td><img src="<?php echo $product->image; ?>" style="width: 50px;height: 50px;"></td>
			<td><?php echo $row1['spare_name']; ?></td>
			<td><?php echo $row1['vendor_order_id']; ?></td>
			<td><?php echo $vendorproduct->amt; ?></td>
			<td><?php echo $vendorproduct->amt-(($vendorproduct->amt*$vendorproduct->discount)/100); ?></td>
			<td><?php echo $vendorproduct->qty; ?></td>
			<td><?php echo $row1['assign_qty']; ?></td>
			<td><?php echo $row1['status']; ?></td>			
			<!--<td><?php echo $row1['send_qty']; ?></td>
			<td><?php echo $row1['received_qty']; ?></td>
			<td><?php echo $row1['remarks']; ?></td>-->
			<td>
			<form method="post" action="">
			<?php $ven_send_qty = mysqli_fetch_array($db->query("select sum(ven_send_qty) as count_qty from proposed_items_qty where vendor_order_id='$row1[vendor_order_id]' AND spare_id='$row1[spare_id]'"));
			$cntqty= $row1['assign_qty']-$ven_send_qty['count_qty'];?>
			<input type="number" name="send_qty" max="<?php echo $cntqty ?>" placeholder="no.of item send">
			<input type="hidden" name="vendor_order_id" value="<?php echo $row1['vendor_order_id']; ?>">
			<input type="hidden" name="spare_id" value="<?php echo $row1['spare_id']; ?>">
			<input type="hidden" name="spare_name" value="<?php echo $row1['spare_name']; ?>">
			<input type="hidden" name="ventor_id" value="<?php echo $_SESSION['id']; ?>">
			<input type="hidden" name="cust_ord_id" value="<?php echo $row1['ord_id']; ?>">
			<input type="submit" name="sent_items" value="Send Items" class="btn btn-primary">
			</form>
			</td>
			<td><a href="vendor_track_history.php?getid=<?=$row1['vendor_order_id'];?>" target="_blank" class="btn btn-default">History</a></td>
			</tr>
			
		<?php 	}
			?>
                                                

                                                </tbody>
                                            </table></div></div></div>
                                            

                                        </div>
                                    </div>
                                </div> <!-- end col -->
                            </div>
                            
                            


													</fieldset>





													  </div> 
</section>													  </div> 
													
								<?php include("footer.php") ?>