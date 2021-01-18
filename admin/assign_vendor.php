<?php include("header.php") ?>

<?php include("nav_bar.php") ?>

<?php include("nav_left.php") ?>



<?php 


$productid = $_GET['proid'];

 $selcat2 = $db->query("SELECT * FROM vendor_parts LEFT JOIN vendor ON vendor_parts.tr_id = vendor.id where vendor.status='active' AND vendor_parts.status='active' AND vendor_parts.pro_id='$productid' GROUP BY vendor_parts.tr_id");
  $vendor=array();
   while($row2 = mysqli_fetch_array($selcat2)){ 

  $vendor[]=$row2['id'];
  }
$selcat = $db->query("SELECT * FROM vendor");
$proid=$_POST['proid'];
if(isset($_POST['updatevendors'])){
foreach($_POST['updatevendor'] as $update){
	$a=$db->query("SELECT count(*) as counters FROM vendor_parts where tr_id='$update' AND pro_id='$proid'");

$c1=mysqli_fetch_array($a);
if($c1[0]>0){
	$ins=$db->query("update vendor_parts SET status='active' where tr_id='$update' AND pro_id='$proid'");
}else{
	$ins=$db->query("insert into vendor_parts(tr_id,pro_id,status) values('$update','$proid','active')");
}
} ?>
	<script>window.location.href='view_product.php';</script>
<?php 	}
	?> 
	
<div class="col-lg-12 panel">
     <div class="card m-b-20">
         <div class="card-block">
             <h4 class="mt-0 header-title">Assign Vendor</h4>
			 <form name="vendor" method="post" action="">
			 
			 
			 <table width="100%"  class="table convert-data-table table-striped">
                                            <thead> <tr>
                                           <th>Action</th>
										    <th>Vendor Name</th>
										   </tr>
										   </thead>
										   <tbody>
										   
										   
			<?php while($row1 = mysqli_fetch_array($selcat)){ ?>
			 <tr>
			 <td>
			 <input type="hidden" name="proid" value="<?=$productid ?>">
                        <input id="checkbox7" name="updatevendor[]" type="checkbox" value="<?=$row1['id']; ?>" <?php if(in_array($row1['id'],$vendor)){ ?> CHECKED <?php } ?> ></td>
                        <td><label for="checkbox7">
                            <?=$row1['name']; ?>
                        </label>
                    </td> </tr>
 <?php } ?>
										   
										   
										  
										   </tbody>
			</table>



 <input type="submit" name="updatevendors" class="btn btn-primary" value="Assign Vendors">
                    

                                        </div>
                                    </div>
                                </div>
									
									
									
									
<?php include("footer.php") ?>