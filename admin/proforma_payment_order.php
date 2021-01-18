<?php include("header.php"); ?>
<?php include("nav_bar.php"); ?>
<?php include("nav_left.php"); ?>


<style type="text/css">
    table {
    width: 100%;
    display:block;
     overflow: auto;
}
</style>
 

  <div class="row">
                            <div class="col-sm-12">
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
                                    <!-- responsive-data-table table-striped  -->
                                     <table width="100%"  class="table convert-data-table table-striped " >


<thead>
                                                <tr role="row">
												 <th>S.no</th>
												<th>Order Id</th>
                                                <th>Spare Id</th>
                                                <th >Request By</th>
                                                <th>Request Time</th>
                                                <th>Total Price</th>
                                                <th>Update</th>
                                                </thead>
                                                <tbody> 
        
<?php $order=$db->query("SELECT * FROM vendor_proforma_payment_approve Order By approve_req_time DESC");
$sno=0;
while($orders=mysqli_fetch_array($order)){ 
$sno++; ?>
	
                                                <tr role="row" class="odd">
                                                    <td class="invert-closeb"> <?=$sno; ?> </td>
													 <td class="invert-closeb"> <?=$orders['v_order_id']; ?> </td>
													  <td class="invert-closeb"> <?=$orders['spare_id']; ?> </td>
													  <td class="invert-closeb"> <?=$orders['update_by']; ?> </td>
													  <td class="invert-closeb"> <?=$orders['approve_req_time']; ?> </td>
													  <td class="invert-closeb"> <?=$orders['total_price']; ?> </td>
 <td><a href="track_proforma.php?getid=<?=$orders['v_order_id']; ?>&vid=<?=$orders['v_id']; ?>" class="btn btn-primary">Edit</a></td>									 

                                                </tr>
<?php }	?>
		 						</tbody>
                                            </table>


                                    


                                    </div>
                                </section>
                            </div>

                             </div>


<?php include("footer.php"); ?>