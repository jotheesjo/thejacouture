<?php include("header.php") ?>
<?php include("nav_bar.php") ?>
<?php include("nav_left.php") ?>


<div class="row panel">
<div class="col-sm-6">
                                    <div class="card m-b-20">
                                        <div class="card-block">

                                            <h4 class="mt-0 header-title">Company Settings </h4>
                                           

                                            <form class="" action="update.php" method="POST" enctype="multipart/form-data" >
                                                

                                                <div class="form-group">
                                                    <label>Company Name</label>
                                                    <input type="hidden" value="<?php  $admind->id; ?>" name="upid">
                                                    <input type="text"  name="t1"  value="<?php echo $admind->name; ?>" class="form-control" >
                                                </div>

                                                <div class="form-group">
                                                    <label>Company logo</label>
                                                    <img src="<?php echo $admind->logo; ?>" style="width:100px;height:100px;">
                                                    <input type="file"  name="file"  class="form-control"   >
                                                </div>


                                                <div class="form-group">
                                                    <label>Company Contact No</label>
                                                    <input type="text"  name="t2"  value="<?php echo $admind->mobile; ?>" class="form-control" >
                                                </div>

                                                <div class="form-group">
                                                    <label>Company Email</label>
                                                    <input type="email"  name="t3" value="<?php echo $admind->email; ?>" class="form-control" >
                                                </div>

                                                 <div class="form-group">
                                                    <label>Company Address Line 1</label>
                                                    <input type="text"  name="t4" value="<?php echo $admind->add1; ?>"  class="form-control" >
                                                </div>

                                                <div class="form-group">
                                                    <label>Company Address Line 2</label>
                                                    <input type="text"  name="t5"  value="<?php echo $admind->add2; ?>"  class="form-control" >
                                                </div> 
 
                                        </div>
                                    </div>
                                </div>

                                
<div class="col-sm-6">

  <div class="card m-b-20">
                                        <div class="card-block">


                                                 <div class="form-group">
                                                    <label>Company GST NO</label>
                                                    <input type="text"  name="t6" value="<?php echo $admind->gst; ?>" class="form-control" >
                                                </div>

<div class="form-group">
                                                    <label>State</label>
                                       <select name="t7" class="form-control"  >
                                       <option value="">select State</option>
                                  <?php $state = $db->query("select * from state where status='active' ");
                             while($st = mysqli_fetch_array($state)){
                                ?> 
                                  <option value="<?php echo $st[0];?>"><?php echo $st[1];?></option>
                            <?php } ?>  
                        </select>
                                                </div>

                                                <div class="form-group">
                                                    <label>City</label>
                                                    <input type="text" value="<?php echo $admind->city; ?>"  name="t8"  class="form-control" >
                                                </div>
 
                                                 <div class="form-group">
                                                    <label>PIN</label>
                                                    <input type="text"  name="t9" value="<?php echo $admind->pin; ?>" class="form-control" >
                                                </div>


                                                 <div class="form-group">
                                                    <label>Company Website</label>
                                                    <input type="text"  name="t10" value="<?php echo $admind->web; ?>" class="form-control" >
                                                </div>


                                                  <div class="form-group">
                                                    <label>About Company</label>
                                                    <textarea name="about" class="form-control"><?php echo $admind->about; ?></textarea>
                                                </div>

 


     <div class="form-group">
                                                    <div>
                                                        <button type="submit"   name="companysubmit" class="btn btn-pink waves-effect waves-light">
                                                            Submit
                                                        </button>
                                                       
                                                    </div>
                                                </div>



     

</div>
</div> 
  </form>

</div></div> 
<?php include("footer.php") ?>

