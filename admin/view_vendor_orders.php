<?php include("header.php") ?>
<?php include("nav_bar.php") ?>
<?php include("nav_left.php") ?>

 
<?php if(isset($_POST['sent_items'])){
	$vendor_order_id=$_POST['vendor_order_id'];
	$spare_id=$_POST['spare_id'];
	$ins=$db->query("UPDATE proposed_items SET send_qty = $_POST[send_qty] WHERE spare_id='$spare_id' AND vendor_order_id='$vendor_order_id'");
	if ($ins) {
    
          echo ("<SCRIPT LANGUAGE='JavaScript'>
    window.alert('Succesfully  Assigned  .. ')
    window.location.href='vendor_orders.php';
    </SCRIPT>");
    }
    else {
   echo ("<SCRIPT LANGUAGE='JavaScript'>
    window.alert('Error While Adding .. ')
    window.location.href='vendor_orders.php';
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
												 <th>S.no</th>											
                                                <th>Order No:</th>
                                                <th >Order By</th>
												<th >Order Date</th>
                                                <th>Status</th>
                                                <th>Action</th>
                                                </thead>

                                                <tbody>
												
			<?php 
			//$proposed_items=$db->query("select * from proposed_items where ventor_id='$_SESSION[id]' AND status='active'");
			$proposed_items=$db->query("select distinct vendor_order_id,status,order_date from proposed_items where ventor_id='$_SESSION[id]' AND status='active' group by vendor_order_id ORDER BY `proposed_items`.`order_date` DESC");

			$i=0;
			while($row1=mysqli_fetch_array($proposed_items)){
				$i++;
			?>
			<tr>
			<td><?= $i;?></td>
			<td><?= $row1['vendor_order_id'];?></td>
			<td>Spare Factory</td>
			<td><?= $row1['order_date'];?></td>
			<td><?= $row1['status'];?></td>
			<td><a href="track_orderby_vendor.php?getid=<?php echo $row1['vendor_order_id']; ?>"> <button class="btn btn-default btn-sm">Track Vendor</button></a></td>
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





													  </div>  </div> 
													
								<?php include("footer.php") ?>