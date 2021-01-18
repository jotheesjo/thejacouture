<?php include("header.php") ?>
<?php include("nav_bar.php") ?>
<?php include("nav_left.php") ?>
  <div class="row">
                            <div class="col-sm-12">
                                <section class="panel">
                                    <header class="panel-heading panel-border">
                                        Inactive Vendor List
                                        <span class="tools pull-right">
                                            <a class="refresh-box fa fa-repeat" href="javascript:;"></a>
                                            <a class="collapse-box fa fa-chevron-down" href="javascript:;"></a>
                                            <a class="close-box fa fa-times" href="javascript:;"></a>
                                        </span>
                                    </header>
                                    <div class="panel-body">
                                    <!-- responsive-data-table table-striped  -->
                                     <table width="100%"  class="table responsive-data-table table-striped dataTable " >


                                                <thead>
                                                <tr role="row">

                                                <th class="sorting_asc" >Sno.</th>                                                <th class="sorting_asc" >Vendor Id</th>
                                                <th class="sorting_asc" >Name</th>
                                                <th class="sorting_asc" >Email</th>
                                                <th class="sorting_asc" >Contact</th>
                                                <th class="sorting_asc" >Status</th>
                                                </thead>

                                                <tbody>
<?php $userview = $db->query("select * from vendor where status='inactive' ");
$i=1;
while($ro = mysqli_fetch_array($userview)){
    $sta = $ro['status'];            ?> 
                                                <tr role="row" class="odd">
                                                    <td><?php echo $i++; ?></td>                                                     <td class="sorting_1"> <?php echo $ro['vendorid']; ?></td>
                                                    <td class="sorting_1"> <?php echo $ro['name']; ?></td>
                                                    <td><?php echo $ro['username']; ?></td>
                                                    <td> <?php echo $ro['contact']; ?></td>

                                                  <td> 
                                                        <a class="btn btn-primary btn-sm" data-toggle="modal" data-target=".edit<?php echo $ro[0]; ?>"> Update <i class="fa fa-pencil"></i></a>
 <div class="modal fade edit<?php echo $ro[0]; ?>" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
                                                        <div class="modal-dialog modal-md">
                                                            <div class="modal-content">
                                                                <div class="modal-header">
                                                                    <h5 class="modal-title mt-0" id="mySmallModalLabel"> Update  </h5>
                                                                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                                                                </div>
 <div class="modal-body">
<form action="update.php" method="POST" enctype="multipart/form-data" >
<?php  //print_r($ro); ?>
<table id="classTable" class="table table-bordered">
          <tbody>
		  <tr>
		  <th>Vendor Id</th>
		  <td><?php echo $ro['vendorid']; ?></td>
		  </tr>
		  <tr>
		  <th>Name</th>
		  <td><?php echo $ro['name']; ?></td>
		  </tr>
		  <tr>   
		  <th>Email</th>
		  <td><?php echo $ro['username']; ?></td>
		  </tr>
		  <tr>
		  <th>Contact Number</th>
		  <td><?php echo $ro['contact']; ?></td>
		  </tr>
		  <tr>  
		  <th>Bank Name</th>
		  <td><?php echo $ro['bank_name']; ?></td>
		  </tr>	
		  <tr>  
		  <th>Account Number</th> 
		  <td><?php echo $ro['bank_account_number']; ?></td>
		  </tr>
		  <tr>    
          <th>IFSC Code</th>
		  <td><?php echo $ro['ifsc_code']; ?></td>	
		  </tr>	
		  <tr>    
          <th>Branch</th>          
		  <td><?php echo $ro['branch']; ?></td>	
		  </tr>			
		  <tr>     
		  <th>Status</th> 
		  <td>		
		  <select name="vstatus" class="form-control"><option value="active"  <?php if($sta=='active') { echo 'selected'; } ?> > active</option><option value="inactive" <?php if($sta=='inactive') { echo 'selected'; } ?> >inactive</option>     </select>  
		  </td>		
		  </tr>  
		  </tbody> 
		  </table>
		  </div>
		  <div class="modal-footer">
		  <input type="hidden" value="<?php echo $ro[0]; ?>"  name="venid">
		  <button type="submit"  name="inactvendor" class="btn btn-primary">Save</button>
		  <button  class="btn btn-secondary" data-dismiss="modal">No</button>
          </form>
                                                        </div>
                                                        
                                                            </div><!-- /.modal-content -->
                                                        </div><!-- /.modal-dialog -->
                                                    </div><!-- /.modal -->


                                                    <button class="btn btn-danger btn-sm" data-toggle="modal" data-target=".delete<?php echo $ro[0]; ?>" > Delete <i class="fa fa-trash"></i></button> </td>
                                                    


 <div class="modal fade delete<?php echo $ro[0]; ?>" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
                                                        <div class="modal-dialog modal-md">
                                                            <div class="modal-content">
                                                                <div class="modal-header">
                                                                    <h5 class="modal-title mt-0" id="mySmallModalLabel"> Update  </h5>
                                                                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                                                                </div>

                                                              <div class="modal-body">


  <form action="delete.php" method="POST" enctype="multipart/form-data" >
 Are you sure you want to delete this entry...
                                                         <div class="modal-footer">
                                <input type="hidden" value="<?php echo $ro[0]; ?>"  name="delid">
                                                            <button type="submit"  name="inactvendor" class="btn btn-primary">Save</button>
                                                            <button  class="btn btn-secondary" data-dismiss="modal">No</button>
                                                            </form>
                                                        </div>
                                                                                                                        </div><!-- /.modal-content -->
                                                        </div><!-- /.modal-dialog -->
                                                    </div><!-- /.modal -->

 
                                                </tr>
                                                
                                                <?php } ?> 

                                                </tbody>
                                            </table></div></div>
                                            

                                        </div>
                                    </div>
                                </div> <!-- end col -->
                            </div>
                            
                            
                            <?php include("footer.php") ?>
                            
                            