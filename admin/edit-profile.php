<?php include("header.php");
include("nav_bar.php");
include("nav_left.php");
 $id=$_GET['id'];
 $info=$db->queryUniqueObject("SELECT * FROM customer WHERE customer_id='$id'");
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
                                    <h3 class="panel-title">Edit Profile</h3>
                                </div>
                                <div class="panel-body">
                                	<?php if(isset($_GET['msg'])){ ?> 
                                        <div class="alert alert-info">
                                            <strong>Info!</strong> <?=$_GET['msg'];?></div>
                                    <?php } ?>
                                	<form class="" action="update.php" method="post" enctype="multipart/form-data">
			  <fieldset class="panel-body" >
                     <div class="row">
					 <div class="form-group">
						<label><strong>Name</strong>&nbsp;</label> <br>
						 <input type="hidden" name="id" class="form-control" required value="<?=$info->id;?>">
						 <input type="text" name="f_name" class="form-control" required value="<?=$info->f_name;?>">
					 </div>
					 
					 <div class="form-group">
						<label><strong>Last Name</strong>&nbsp;</label> <br>
						 <input type="text" name="l_name" class="form-control" required value="<?=$info->l_name;?>">
					 </div>
					<div class="form-group">
						<label><strong>Phone</strong>&nbsp;</label> <br>
						 <input type="text" name="phone" class="form-control" required value="<?=$info->phone;?>">
					 </div>
					  <div class="form-group">
						<label><strong>Email</strong>&nbsp;</label> <br>
						 <input type="Email" name="email" class="form-control" required value="<?=$info->email;?>">
					 </div>
					 <div class="form-group">
						<label><strong>Password</strong>&nbsp;</label> <br>
						 <input type="text" name="con_pwd" class="form-control" required value="<?=base64_decode($info->con_pwd);?>" disabled>
					 </div>
					 <div class="form-group">
						<label><strong>Address</strong>&nbsp;</label> <br>
						 <input type="text" name="user_address" class="form-control" required value="<?=$info->user_address;?>">
					 </div>
					<div class="form-group">
						<label><strong>City</strong>&nbsp;</label> <br>
						 <input type="text" name="city" class="form-control" required value="<?=$info->city;?>">
					 </div>
					 <div class="form-group">
						<label><strong>State</strong>&nbsp;</label> <br>
						 <input type="text" name="state" class="form-control" required value="<?=$info->state;?>">
					 </div>
					 <div class="form-group">
						<label><strong>Country</strong>&nbsp;</label> <br>
						 <input type="text" name="country" class="form-control" required value="<?=$info->country;?>">
					 </div>
					  <div class="form-group">
						<label><strong>Zip</strong>&nbsp;</label> <br>
						 <input type="text" name="zip" class="form-control" required value="<?=$info->zip;?>">
					 </div>
					 <div class="form-group">
						<label><strong>Information</strong>&nbsp;</label> <br>
						 <input type="text" name="information" class="form-control" required value="<?=$info->information;?>">
					 </div>
					 <div class="form-group">
					 	<button type="submit" name="btn_update_profile" class="btn btn-primary waves-effect waves-light">Submit</button>
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
<script>

	$("#product_vari").on('change', function(){  
		var a= $(this).val();
		if(a=='no'){
			 $("#product_vari1")[0].selectedIndex = 0;
			 $("#product_value").hide();
			 $('#product_vari1').attr('required', false);
		}else{
			 $("#product_value").show();
			 $('#product_vari1').attr('required', true);
		}
});
//  function change1() {
//      var selected = document.getElementById('product_vari').value;
//      if(selected == "yes"){
//         document.getElementById('product_value').style.display = "block";
//      }
// 	 else{
// 		document.getElementById('product_value').style.display = "block";
// 		function myFunction() {
//   document.getElementById("product_value").reset();
// }
		

// 	 }
//  }
</script>
