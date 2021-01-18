<?php include("header.php"); ?>
<?php include("nav_bar.php"); ?>
<?php include("nav_left.php"); ?>



 <div class="panel m-b-20">
  <div class="card-block">

<div class="panel-heading">Vendor  Profile</div>

  <h4 class="mt-0 header-title"></h4>
 <form class="" action="insert.php" method="POST" enctype="multipart/form-data"   >
									
								   
			  <fieldset class="panel-body">
                                                    <div class="row">
                                                        <div class="col-md-4">
														
														<div class="form-group">
                                                    <label><strong>Vendor CODE: </strong></label>
<input type="text" name="ven_code" class="form-control" readonly="" value="<?php  $vsid = $db->maxOfAll('id','vendor');  echo  $p4 = sprintf( "%04d \n", $vsid); ?>"    >
							
                                                </div>
												
														<!-- <div class="form-group">
                                                    <label><strong>Select Category: </strong></label>
                                                   <select name="catid" class="form-control">
				<?php $userview = $db->query("select * from category where status='active'");
			while($ro = mysqli_fetch_array($userview)){
			?>
			  <option value="<?php echo $ro[0];?>"><?php echo $ro[1];?></option>
							<?php } ?> 
							</select>
							
                                                </div>
												
												
													<div class="form-group">
                                                    <label><strong>Select Sub Category: </strong></label>
                                                   <select name="catid" class="form-control">
				<?php $userview = $db->query("select * from category where status='active'");
			while($ro = mysqli_fetch_array($userview)){
			?>
			  <option value="<?php echo $ro[0];?>"><?php echo $ro[1];?></option>
							<?php } ?> 
							</select>
							
                                                </div>
												 -->
												
                                                            
					<div class="form-group">
						<label><strong>Vendor Name : </strong>&nbsp;</label> <br>
						 <input type="text" name="ven_name" class="form-control"   value="<?php echo $vsname; ?>">
					 </div>
					 
					 <div class="form-group">
						<label><strong>Date of Birth : </strong>&nbsp;</label> <br>
						 <input type="date" name="dob" class="form-control" value="<?php echo date("Y-m-d"); ?>"    >
					 </div>
					 
					 <div class="form-group">
						<label><strong>Image : </strong>&nbsp;</label> <br>
						 <input type="file" name="name" class="form-control"    >
					 </div>

	
					  <div class="form-group">
						<label><strong>Contact number : </strong>&nbsp;</label> <br>
						 <input type="number" name="cnumber" class="form-control"    >
					 </div>




					 <div class="form-group">
						<label><strong>Contact Person: </strong>&nbsp;</label> <br>
						 <input type="text" name="cperson" class="form-control" value="<?php echo $vscontact; ?>">
					 </div>



					 
					 </div>
					 
							 	 

					 
<div class="col-md-4"> 

					 
					  
					  <div class="form-group">
						<label><strong>Email: </strong>&nbsp;</label> <br>
						 <input type="email" name="email" class="form-control"    >
					 </div>

					 <div class="form-group">
						<label><strong>Password: </strong>&nbsp;</label> <br>
						 <input type="password" name="pwd" class="form-control"    >
					 </div>

					 

					 
					 <div class="form-group">
						<label><strong> Address  : </strong>&nbsp;</label> <br>
						 <textarea type="text" name="address" class="form-control"  cols="3" rowa="3"   > </textarea> 
					 </div>


					  <div class="form-group">
						<label><strong>State : </strong>&nbsp;</label> <br>
						 <input type="text" name="state" class="form-control"    >
					 </div>


					 <div class="form-group">
						<label><strong>District  : </strong>&nbsp;</label> <br>
						 <input type="text" name="district" class="form-control"    >
					 </div>


					
					   <div class="form-group">
						<label><strong>PinCode  : </strong>&nbsp;</label> <br>
						 <input type="number" name="pin" class="form-control"    >
					 </div>
				
					 
					 
					     </div>
<div class="col-md-4">                                                           
					
					
					   

				
					 					                                                             


					  <div class="form-group">
						<label><strong>GST number  : </strong>&nbsp;</label> <br>
						 <input type="text" name="gst" class="form-control"    >
					 </div>

						 <div class="form-group">
						<label><strong>Payment terms : </strong>&nbsp;</label> <br>
						 <input type="text" name="terms" class="form-control"    >
					 </div>
					 
					 
<div class="form-group">
						<label><strong>Bank Details : </strong>&nbsp;</label> <br>
						<textarea name="bank" class="form-control" ></textarea>  
					 </div>
					 

					 <div class="form-group">
						<label><strong>Remark : </strong>&nbsp;</label> <br>
						 <input type="text" name="remark" class="form-control"    >
					 </div>
					 
					 
					 
 <div class="form-group">
<div>
<button type="submit"  name="vendorsubmit" class="btn btn-primary waves-effect waves-light">
Submit </button>
                                                       
                                                    </div>
                                                </div>
                                            </form>
											
											
                                                        </div>
                                                    </div> 
													</fieldset>  </div>  </div> 


<?php include("footer.php"); ?>

