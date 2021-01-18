<?php session_start();
include('db.php');
if((isset($_SESSION['user_id'])) && ($_SESSION['user_type']=='guest')){   header("Location: login.php"); exit; }?>
<!doctype html>
<html class="no-js" lang="en">
<head>
	<meta charset="utf-8">
	<meta http-equiv="x-ua-compatible" content="ie=edge">
	<title>Address Book</title>
	<meta name="description" content="">
	<meta name="viewport" content="width=device-width, initial-scale=1">
<?php include('head.php');?>
</head>
<body>
	<!-- Main wrapper -->
	<div class="wrapper" id="wrapper">
	<?php include('header.php');?>

        <!-- Start Contact Area -->
        <section class="wn_contact_area pt--80 pb--30">
        	<div class="container">
            
        		<div class="row">
        			<div class="col-lg-8 col-12">
                 <?php if(isset($_GET['msg'])){
                  echo '<h4>'.$_GET['msg'].'</h4>';
                } ?>
<?php $addr_query=mysqli_query($conn, "SELECT * FROM customer_address WHERE customer_id='$_SESSION[user_id]'");
$addr_count=mysqli_num_rows($addr_query); if($addr_count>0){ ?>
<div class="contact-form-wrap">
<h3>Addresses </h3><br/>
<div class="row">
<?php while($addr_row=mysqli_fetch_array($addr_query)){ ?>
 <div class="col-md-6 col-lg-4 col-sm-12 addrs">
  <div class="post__itam orderic">
    <div class="content">
      <p><strong><?=$addr_row['name'];?><br/></strong><?=$addr_row['addr1'];?><br/><?=$addr_row['addr2'];?><br/><?=$addr_row['addr3'];?><br/><?=$addr_row['city'];?><br/><?=$addr_row['state'];?><br/><?=$addr_row['country']." - ".$addr_row['zip'];?></p>
      <button class="btn btn-primary"><a href="edit-address.php?address=<?=$addr_row['address_id'];?>">Edit</a></button> 
        <button class="btn btn-danger delete" id='del_<?=$addr_row['address_id'];?>' data-id='<?=$addr_row['address_id'];?>'>Remove</button>
    </div>
  </div>
</div>
<?php } ?>
</div>
</div>
<?php }?>
                
        				<div class="contact-form-wrap">
        				<h3>Add Address </h3><br/>
                            <form action="insert.php" method="post">
                                <div class="single-contact-form space-between">
                                    <input type="text" name="name" placeholder="Full Name*" required>
                                    <input type="email" name="email" placeholder="Email*" required>
                                   
                                </div>
                                 <div class="single-contact-form space-between">
                                     <input type="text" name="mobile" placeholder="Mobile Number*" required>
                                      <input type="text" name="altr_mobile" placeholder="Alternate Mobile Number*" required>
                                </div>
                                <div class="single-contact-form">
                                    <input type="text" name="addr1" placeholder="Flat, House no., Building, Company, Apartment*" required>
                                </div>
                                <div class="single-contact-form">
                                    <input type="text" name="addr2" placeholder="Area, Colony, Street, Sector, Village*" required>
                                </div>
                                <div class="single-contact-form">
                                    <input type="text" name="addr3" placeholder="Landmark e.g. near apollo hospital*" required>
                                </div>
                                <div class="single-contact-form">
                                    <input type="text" name="city" placeholder="City*" required>
                                </div>
                               <div class="single-contact-form">
                                    <input type="text" name="state" placeholder="State*" required>
                                </div>
                                <div class="single-contact-form">
                                    <input type="text" name="country" placeholder="Country*" required>
                                </div>
                                <div class="single-contact-form">
                                    <input type="text" name="pincode" placeholder="Pincode*" required>
                                </div>
                                <div class="contact-btn">
                                    <button type="submit" name="add_address">Save Address</button>
                                </div>
                            </form>
                        </div> 
                        <div class="form-output">
                            <p class="form-messege">
                        </div>
        			</div>
        			<div class="col-lg-4 col-12 md-mt-40 sm-mt-40">
        				<div class="widget account-details">
      <h3 class="widget-title">Account</h3>
      	<br/>
      <ul class="bg-white">
         <li><a href="account-information.php"> My Account </a></li>
         <li><a href="order-history.php">Orders</a></li>
         <li class="active"><a href="address-book.php">Address Books</a></li>
         <li><a href="change-password.php">Change Password</a></li>
      </ul>
   </div>
        			</div>
        		</div>
        	</div>

        </section>
        <!-- End Contact Area -->

<?php include('footer.php');?>
</div>

	<!-- JS Files -->
	<script src="js/vendor/jquery-3.2.1.min.js"></script>
	<script src="js/popper.min.js"></script>
	<script src="js/bootstrap.min.js"></script>
	<script src="js/plugins.js"></script>
	<script src="js/active.js"></script>
  <script src="js/bootbox.min.js"></script>
  
<script>
$(document).ready(function(){

  // Delete 
  $('.delete').click(function(){
    var el = this;
  
    // Delete id
    var deleteid = $(this).data('id');
    // Confirm box
    bootbox.confirm("<p>Do you really want to delete record?</p>", function(result) {
 
       if(result){
         // AJAX Request
         $.ajax({
           url: 'ajax.php',
           type: 'POST',
           data: { address_delete_id:deleteid },
           success: function(response){
// console.log(response);
             // Removing row from HTML Table
             if(response == 1){
    $(el).closest('.addrs').css('background','tomato');
                $(el).closest('.addrs').fadeOut(800,function(){
       $(this).remove();
    });
       }else{
    bootbox.alert('Record not deleted.');
       }

           }
         });
       }
 
    });
 
  });
});
</script>
</body>
</html>