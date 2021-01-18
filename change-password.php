<?php session_start();
include('db.php');
if((isset($_SESSION['user_id'])) && ($_SESSION['user_type']=='guest')){   header("Location: login.php"); exit; }?>
<!doctype html>
<html class="no-js" lang="en">
<head>
	<meta charset="utf-8">
	<meta http-equiv="x-ua-compatible" content="ie=edge">
	<title>Change Password</title>
	<meta name="description" content="">
	<meta name="viewport" content="width=device-width, initial-scale=1">
<?php include('head.php');?>
</head>
<body>
	<!-- Main wrapper -->
	<div class="wrapper" id="wrapper">
	<?php include('header.php');?>
        <!-- Start Contact Area -->
        <section class="wn_contact_area pt--80  pb--30">
        	<div class="container">
        		<div class="row">
        			<div class="col-lg-8 col-12">
        				<div class="contact-form-wrap">
        					<h3>Change Password </h3><br/>
                            <form id="change_password" action="#">
                                <div class="single-contact-form">
                                    <input type="password" name="ch_pwd" id="pwd" required placeholder="New password">
                                </div>
                                <div class="single-contact-form">
                                   
                                     <input type="password" name="cpwd" id="cpwd" required placeholder="Confirm password" >
                                     <span id="err" style="color: #ff0000;padding: 5px;display: none;">Password Mismatch</span>
                                </div>
                                
                                <div class="contact-btn">
                                    <button type="submit" id="submit">Change Password</button>
                                </div>

									<br/>
									<h4 class="text-danger text-center" id="response"></h4>
                            </form>
                        </div> 
        			</div>
        			<div class="col-lg-4 col-12 md-mt-40 sm-mt-40">
        				<div class="widget account-details">
      <h3 class="widget-title">Account</h3>
      	<br/>
      <ul class="bg-white">
         <li><a href="account-information.php"> My Account </a></li>
         <li><a href="order-history.php">Orders</a></li>
         <li><a href="address-book.php">Address Books</a></li>
         <li class="active"><a href="change-password.php">Change Password</a></li>
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
		<script>
		//validate password
    $(document).ready(function(){
        $("#cpwd, #pwd").keyup(function(){
            var cpwd=$("#cpwd").val();
            var pwd=$("#pwd").val();
            if(cpwd != pwd){
                $("#submit").prop('disabled', true);
                $("#err").show();
            }else{
                $("#submit").prop('disabled', false);
                $("#err").hide();
            }
        });
    });

    //change password
        //signup
     $(function (){
$('#change_password').on('submit', function(e){
e.preventDefault();

$.ajax({
type:'POST',
url:'ajax.php',
data:$('#change_password').serialize(),
success:function(data){
$('#response').html(data);
$('#change_password')[0].reset();
        } 
    })
});
});
</script>
</body>
</html>