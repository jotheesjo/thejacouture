<?php include('db.php');
session_start(); 
if((isset($_SESSION['user_id'])) && ($_SESSION['user_type']!='guest')){  header("Location: account-information.php"); exit; } ?>
<!doctype html>
<html class="no-js" lang="en">
<head>
	<meta charset="utf-8">
	<meta http-equiv="x-ua-compatible" content="ie=edge">
	<title>Login</title>
	<meta name="description" content="">
	<meta name="viewport" content="width=device-width, initial-scale=1">
<?php include('head.php');?>
</head>
<body>
	<!-- Main wrapper -->
	<div class="wrapper" id="wrapper">
	<?php include('header.php');?>
        <!-- Start Bradcaump area -->
        <div class="ht__bradcaump__area bg-image--6">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="bradcaump__inner text-center">
                        	<h2 class="bradcaump-title">My Account</h2>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- End Bradcaump area -->
		<!-- Start My Account Area -->
		<section class="my_account_area pt--80 pb--55">
			<div class="container">
				<div class="row">
					<div class="col-lg-6 col-12">
						<div class="my__account__wrapper">
							<h3 class="account__title">Login</h3>
							<form action="#" id="login">
								<div class="account__form">
									<div class="input__box">
										<label>Email address <span>*</span></label>
										<input type="email" required name="email_login">
									</div>
									<div class="input__box">
										<label>Password<span>*</span></label>
										<input type="password"  required name="pwd_login">
									</div>
									<div class="form__btn">
										<button type="submit" name="login">Login</button>
									</div>
									<a class="forget_pass" href="forgot-password.php">Lost your password?</a>
									<br/>
									<h4 class="text-danger text-center" id="response2"></h4>
								</div>
							</form>
						</div>
					</div>
					<div class="col-lg-6 col-12">
						<div class="my__account__wrapper">
							<h3 class="account__title">Register</h3>
							<form action="#" id="signup">
								<div class="account__form">
									<div class="input__box">
										<label>Name<span>*</span></label>
										<input type="text" required name="sign_name">
									</div>
									<div class="input__box">
										<label>Email address <span>*</span></label>
										<input type="email" required name="sign_email">
									</div>
									<div class="input__box">
										<label>Password<span>*</span></label>
										<input type="password" name="sign_password" id="pwd" required>
									</div>
									<div class="input__box">
										<label>Confirm password<span>*</span></label>
                                                <input type="password" name="cpwd" id="cpwd" required >
                                                <span id="err" style="color: #ff0000;padding: 5px;display: none;">Password Mismatch</span>
                                            </div>

									<div class="form__btn">
										<button type="submit" id="submit">Register</button>
									</div>
									<br/>
									<h4 class="text-danger text-center" id="response"></h4>
								</div>
							</form>
						</div>
					</div>
				</div>
			</div>
		</section>
		<!-- End My Account Area -->
<?php include('footer.php');?>
</div>

	<!-- JS Files -->
	<script src="js/vendor/jquery-3.2.1.min.js"></script>
	<script src="js/popper.min.js"></script>
	<script src="js/bootstrap.min.js"></script>
	<script src="js/plugins.js"></script>
	<script src="js/active.js"></script>
	
	<script>
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

    //signup
     $(function (){
$('#signup').on('submit', function(e){
e.preventDefault();

$.ajax({
type:'POST',
url:'ajax.php',
data:$('#signup').serialize(),
success:function(data){
$('#response').html(data);
console.log(data);
$('#signup')[0].reset();
        } 
    })
});
});

//login
$(function (){
$('#login').on('submit', function(e){
e.preventDefault();

$.ajax({
type:'POST',
url:'ajax.php',
data:$('#login').serialize(),
success:function(data){
$('#response2').html(data);
$('#login')[0].reset();
        } 
    })
});
});
</script>

</body>
</html>