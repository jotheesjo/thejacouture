<?php include("header.php") ?>
<?php include("nav_bar.php") ?>
<?php include("nav_left.php") ?>
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
                                        Vendor List
                                        <span class="tools pull-right">
                                            <a class="refresh-box fa fa-repeat" href="javascript:;"></a>
                                            <a class="collapse-box fa fa-chevron-down" href="javascript:;"></a>
                                            <a class="close-box fa fa-times" href="javascript:;"></a>
                                        </span>
                                    </header>
                                    <div class="panel-body">
                                    <!-- responsive-data-table table-striped  -->
                                     <table width="100%"  class=" table convert-data-table   table-striped dataTable " >
                                                 <thead>
                                                <tr role="row">
                                                <th class="sorting_asc" >Sno</th>
												<th class="sorting_asc" >Vendor Id</th>
                                               <th> name</th>
<th> contact</th>
<th> email</th>
<th> address</th>
<th> distric</th>
<th> state</th>
<th> pin</th>
<th> gst</th>
<th> payment</th>
<th> bankdetails</th>
<th> img</th>
<th> remark</th>
 <!-- <th class="sorting_asc" >Status</th> -->
                                                </thead>                                  <tbody>
<?php $userview = $db->query("select * from vendor  where status='active' ");
$i=1;
while($ro = mysqli_fetch_array($userview)){
    $sta = $ro['status'];
            ?> 
                                                <tr role="row" class="odd">
                                                    <td><?php echo $i++; ?></td>
<td> <?php echo $ro['vendorid'] ?></td>
                                                   <td> <?php echo $ro['name'] ?></td>
<td><?php echo $ro['contact'] ?></td>
<td><?php echo $ro['email'] ?></td>
<td><?php echo $ro['address'] ?></td>
<td><?php echo $ro['distric'] ?></td>
<td><?php echo $ro['state'] ?></td>
<td><?php echo $ro['pin'] ?></td>
<td><?php echo $ro['gst'] ?></td>
<td><?php echo $ro['payment'] ?></td>
<td><?php echo $ro['bankdetails'] ?></td>
<td><?php echo $ro['img'] ?></td>
<td><?php echo $ro['remark'] ?></td>
<!-- <td>-</td> -->
                                                </tr>                                        
                                                <?php } ?> 
                                                </tbody>
                                            </table></div></div>
                                        </div>             
                            <?php include("footer.php") ?>
                            