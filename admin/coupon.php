<?php include("header.php") ?>
<?php include("nav_bar.php") ?>
<?php include("nav_left.php") ?>

  <div class="main">
            <!-- MAIN CONTENT -->
            <div class="main-content">
                <div class="container-fluid">
                    <?php if(isset($_GET['msg'])){ ?> 
                                        <div class="alert alert-info">
                                            <strong>Info!</strong> <?=$_GET['msg'];?></div>
                                    <?php } ?>
                    <div class="row">
                        <div class="col-md-5">

                            <!-- BASIC TABLE -->
                            <div class="panel">
                                <div class="panel-heading">
                                    <h3 class="panel-title">Coupon</h3>
                                </div>
                                <div class="panel-body">
                                	<?php if(isset($_GET['editid'])) {
                                		$editid = $_GET['editid'];
                                		$ed = $db->queryUniqueObject("SELECT * from coupons where id='$editid'"); ?>
                                		<form class="" action="update.php" method="POST">
                                			<input type="hidden" class="form-control" value="<?=$ed->id;?>" name="id" required>
                                			 <div class="form-group">
                                                    <label>Coupon Code</label>
                                                    <input type="text" class="form-control" value="<?=$ed->coupon;?>" name="coupon" required> 
                                                </div>
                                                <div class="form-group">
                                                    <label>Discount(%)</label>
                                                    <input type="number" class="form-control" value="<?=$ed->coupon_pecent;?>" name="coupon_pecent" required> 
                                                </div>
                                                <div class="form-group">
                                                    <label>Minimum Price</label>
                                                    <input type="number" class="form-control" value="<?=$ed->coupon_min_price;?>" name="coupon_min_price" required> 
                                                </div>
                                                <div class="form-group">
                                                    <label>Expairy Date</label>
                                                    <input type="date" value="<?=$ed->exp_date;?>" class="form-control" name="expdate"   required>  
                                                </div>
                                                <div class="form-group">
                                                    <div>
                                                        <button type="submit" name="couponupdate" class="btn btn-primary waves-effect waves-light">
                                                            Submit
                                                        </button>
                                                    </div>
                                                </div>
                                            </form>
                                            <?php } else if(!isset($GET['editid'])){ ?>
                                            <form class="" action="insert.php" method="POST"> 
                                                <div class="form-group">
                                                    <label>Coupon Code</label>
                                                    <input type="text" class="form-control" name="coupon" required> 
                                                </div>
                                                <div class="form-group">
                                                    <label>Discount(%)</label>
                                                    <input type="number" class="form-control" name="coupon_pecent" required> 
                                                </div>
                                                <div class="form-group">
                                                    <label>Minimum Price</label>
                                                    <input type="number" class="form-control" name="coupon_min_price" required> 
                                                </div>
                                                <div class="form-group">
                                                    <label>Expiry Date</label>
                                                    <input type="date" class="form-control" name="expdate"   required>  
                                                </div>
                                                <div class="form-group">
                                                    <div>
                                                        <button type="submit" name="couponsubmit" class="btn btn-primary waves-effect waves-light">
                                                            Submit
                                                        </button>
                                                    </div>
                                                </div>
                                            </form>
                                            <?php } ?>
                                </div>
                            </div>
                        </div>




<!-- coupon List -->
<div class="col-md-7">
                            <!-- BASIC TABLE -->
                            <div class="panel">
                                <div class="panel-heading">
                                    <h3 class="panel-title">Coupon List</h3>
                                </div>
                                <div class="panel-body">
                                    <table id="datatable" class="table responsive-data-table  dataTable" width="100%" cellspacing="0">
                                                <thead>
                                                <tr role="row">
                                                    <th>S.no</th>
                                                <th>Coupon</th>
                                                <th>Discount(%)</th>
                                                <th>Exp.Date</th>
                                                <th>Min.price</th>
                                                <th>Action</th>
                                               </thead>
                                                <tbody>
                                                    <?php $userview = $db->query("select * from coupons order by id");
                                                      $i=1;
            while($ro = mysqli_fetch_array($userview)){
            ?> 
          <tr role="row" class="odd">
                                                    <td><?php echo $i++; ?></td>
                                                    <td><?php echo $ro['coupon']; ?></td>
                                                    <td><?php echo $ro['coupon_pecent'].'%'; ?></td>
                                                    <td><?php echo $ro['exp_date']; ?></td>
                                                    <td><?php echo 'INR'. $ro['coupon_min_price']; ?></td>
                                                    <td>
<a href="coupon.php?editid=<?php echo $ro[0]; ?>" class="btn btn-primary btn-sm " > <i class="fa fa-pencil"></i> </a>
<button class="btn btn-danger btn-sm " data-toggle="modal" data-target=".edit<?php echo $ro[0]; ?>"> <i class="fa fa-trash"></i></button>
 <div class="modal fade edit<?php echo $ro[0]; ?>" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
                                                        <div class="modal-dialog modal-md">
                                                           <div class="modal-content">
                                                                <div class="modal-header">
                                                                    <h5 class="modal-title mt-0" id="mySmallModalLabel">Delete <?php echo $ro[1]; ?> </h5>
                                                                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                                                                </div>
                                                             <div class="modal-body">
                                                            <p>Are You sure you want to delete this Coupon</p>
                                                        </div>
                                                        <div class="modal-footer">
                                                        <form action="delete.php" method="POST">
                                                        <input type="hidden" name="delid" value="<?php echo $ro[0]; ?>"> 
                                                            <button type="submit"  name="deletecoupon" class="btn btn-primary">Yes</button>
                                                            <button  class="btn btn-secondary" data-dismiss="modal">No</button>
                                                            </form>
                                                        </div>
                                                     
                                                            </div><!-- /.modal-content -->
                                                        </div><!-- /.modal-dialog -->
                                                    </div><!-- /.modal -->    

                                                    </td>
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