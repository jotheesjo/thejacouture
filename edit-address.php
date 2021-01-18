<?php session_start();
include('db.php');
if(!isset($_SESSION['user_id'])){  header("Location: login.php"); exit; }?>
<!doctype html>
<html class="no-js" lang="en">
<head>
	<meta charset="utf-8">
	<meta http-equiv="x-ua-compatible" content="ie=edge">
	<title>Edit Address</title>
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
                <?php $query=mysqli_query($conn,"SELECT * FROM customer_address WHERE address_id='$_GET[address]' AND customer_id='$_SESSION[user_id]'");
$query_count=mysqli_num_rows($query);
if($query_count>0){ 
  $addinfo=mysqli_fetch_assoc($query);?>
                 <?php if(isset($_GET['msg'])){
                  echo '<h4>'.$_GET['msg'].'</h4>';
                } ?> 
        				<div class="contact-form-wrap">
        				<h3>Edit Address </h3><br/>
                            <form action="insert.php" method="post">
                                <div class="single-contact-form space-between">
                                    <input type="text" name="name" placeholder="Full Name*" required value="<?=$addinfo['name'];?>">
                                    <input type="email" name="email" placeholder="Email*" required value="<?=$addinfo['email'];?>">
                                   <input type="hidden" name="address_id" required value="<?=$addinfo['address_id'];?>">
                                </div>
                                 <div class="single-contact-form space-between">
                                     <input type="text" name="mobile" placeholder="Mobile Number*" required value="<?=$addinfo['phone'];?>">
                                      <input type="text" name="altr_mobile" placeholder="Alternate Mobile Number*" required value="<?=$addinfo['alter_phone'];?>">
                                </div>
                                <div class="single-contact-form">
                                    <input type="text" name="addr1" placeholder="Flat, House no., Building, Company, Apartment*" required value="<?=$addinfo['addr1'];?>">
                                </div>
                                <div class="single-contact-form">
                                    <input type="text" name="addr2" placeholder="Area, Colony, Street, Sector, Village*" required value="<?=$addinfo['addr2'];?>">
                                </div>
                                <div class="single-contact-form">
                                    <input type="text" name="addr3" placeholder="Landmark e.g. near apollo hospital*" required value="<?=$addinfo['addr3'];?>">
                                </div>
                                <div class="single-contact-form">
                                    <input type="text" name="city" placeholder="City*" required value="<?=$addinfo['city'];?>">
                                </div>
                               <div class="single-contact-form">
                                    <input type="text" name="state" placeholder="State*" required value="<?=$addinfo['state'];?>">
                                </div>
                                <div class="single-contact-form">
                                    <input type="text" name="country" placeholder="Country*" required value="<?=$addinfo['country'];?>">
                                </div>
                                <div class="single-contact-form">
                                    <input type="text" name="pincode" placeholder="Pincode*" required value="<?=$addinfo['zip'];?>">
                                </div>
                                <div class="contact-btn">
                                    <button type="submit" name="update_address">Save Address</button>
                                </div>
                            </form>
                        </div> 
                        <div class="form-output">
                            <p class="form-messege">
                        </div>
                      <?php }else{
                        echo '<h4>Something went wrong</h4>';
                      } ?>
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
         <li><a href="wishlist.php">Wishlist</a></li>
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
console.log(response);
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