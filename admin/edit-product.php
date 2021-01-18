<?php include("header.php"); ?>
<?php include("nav_bar.php"); ?>
<?php include("nav_left.php"); ?>
<?php $type=$_GET['category']; 
$proid=$_GET['proid']; 
$product=$db->queryUniqueObject("SELECT * FROM products WHERE product_id='$proid'");
echo $product->sku;
?> 

       <div class="main">
            <!-- MAIN CONTENT -->
            <div class="main-content">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-md-12">
                            <!-- BASIC TABLE -->
                            <div class="panel">
                                <div class="panel-heading">
                                    <h3 class="panel-title"><?=$product->name; ?> (Edit)</h3>
                                </div>
                                <div class="panel-body">
                                	<form class="" action="update.php" method="post" enctype="multipart/form-data">
			  <fieldset class="panel-body" >
                     <div class="row">
					 <input type="hidden" name="proid" class="form-control" value="<?=$_GET['proid']; ?>" required>
					 <div class="col-xs-12 col-md-12">
						<div class="form-group">
                     		<div class="form-group">
                     			<label><strong>Name</strong>&nbsp;</label> <br>
                     			<input type="text" name="name" class="form-control" required value="<?=$product->name; ?>">
                     		</div>
							</div>
                     	</div>
                     	
						<div class="col-xs-12 col-md-12">
                     	<div class="form-group">
						<label><strong>Images:</strong>&nbsp;</label> <br>
						 <input type="file" name="file_img[]" multiple class="form-control">
					 </div>
					 </div>
					  <div class="col-xs-12 col-md-12">
					 	<div class="form-group">
						<label><strong>Short Description:</strong>&nbsp;</label> <br>
						 <textarea class="form-control tinymce" name="short_description"><?=$product->short_description; ?></textarea>
					 </div>
					</div>

					<div class="col-xs-12 col-md-12">
					 	<div class="form-group">
						<label><strong>Description:</strong>&nbsp;</label> <br>
						 <textarea class="form-control tinymce" name="description"><?=$product->description; ?></textarea>
					 </div>
					</div>
						<div class="col-xs-12 col-md-4">
						<div class="form-group">
                     		<label><strong>Size</strong></label> <br>
                     		<select class="form-control" name="size" id="materialtype">
                     			<option disabled selected value>Size</option>
                     			<?php $sizes=$db->query("SELECT * FROM variation_size WHERE status='1'");
                     			while($size=mysqli_fetch_assoc($sizes)){  ?>
                     				<option value="<?=$size['size_id'];?>" <?php if($size['size_id']==$product->size){ echo " selected";}?>><?=$size['size_name'];?></option>;
                     			<?php }?>
                     		</select>
                     	</div>
						</div>

						<div class="col-xs-12 col-md-4">
						<div class="form-group">
                     		<label><strong>Color</strong></label> <br>
                     		<select class="form-control" name="color" id="materialtype">
                     			<option disabled selected value>Color</option>
                     			<?php $colors=$db->query("SELECT * FROM variation_color WHERE status='1'");
                     			while($color=mysqli_fetch_assoc($colors)){  ?>
                     				<option value="<?=$color['color_id'];?>" <?php if($color['color_id']==$product->color){ echo " selected";}?>><?=$color['color_name'];?></option>;
                     			<?php }?>
                     		</select>
                     	</div>
						</div>						<div class="col-xs-12 col-md-4">						<div class="form-group">                     		<label><strong>Weight</strong></label> <br>                     		<input type="text" name="weight" class="form-control" required value="<?=$product->weight; ?>">                     	</div>						</div>

						<div class="col-xs-12 col-md-6">
						<div class="form-group">
                     		<div class="form-group">
                     			<label><strong>Qty</strong>&nbsp;</label> <br>
                     			<input type="text" name="qty" class="form-control" required value="<?=$product->qty; ?>">
                     		</div>
							</div>
                     	</div>

                     	<div class="col-xs-12 col-md-6">
						<div class="form-group">
                     		<div class="form-group">
                     			<label><strong>Price</strong>&nbsp;</label> <br>
                     			<input type="text" name="price" class="form-control" required value="<?=$product->price; ?>">
                     		</div>
							</div>
                     	</div>

                     	<div class="col-xs-12 col-md-6">
						<div class="form-group">
                     		<div class="form-group">
                     			<label><strong>Offer</strong>&nbsp;</label> <br>
                     			<input type="text" name="offer" class="form-control" required value="<?=$product->offer; ?>">
                     		</div>
							</div>
                     	</div>

					<div class="col-xs-12 col-md-6">
					 <div class="form-group">
						<label><strong>Status</strong>&nbsp;</label> <br>
						 <select name="status" class="form-control" required>
							<option value="1" <?php if($product->status=="1"){ echo "selected"; } ?>>Active</option> 
							<option value="0" <?php if($product->status=="0"){ echo "selected"; } ?>>Inactive</option>
						 </select>
					 </div>
					</div>
                   <div class="form-group">
                   	<button type="submit" name="btn_update" class="btn btn-primary waves-effect waves-light">Submit</button>
                   </div>
               </div>
           </form>
       </div>
   </div>
</div>
</div>
</div>
</div>
</div>
<?php include("footer.php"); ?>