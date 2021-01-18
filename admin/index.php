<?php
session_start(); ?>
<?php if(isset($_SESSION['rights'])){
 if($_SESSION['rights'] = 'admin'){   
    header ('location:welcome.php');
}
}
?>
<!doctype html>
<html lang="en" class="fullscreen-bg">
<head>
    <title>Theja Couture| Admin Dashboard</title>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0">
    <!-- VENDOR CSS -->
    <link rel="stylesheet" href="assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/vendor/font-awesome/css/font-awesome.min.css">
    <link rel="stylesheet" href="assets/vendor/linearicons/style.css">
    <!-- MAIN CSS -->
    <link rel="stylesheet" href="assets/css/main.css">
    <!-- FOR DEMO PURPOSES ONLY. You should remove this in your project -->
    <link rel="stylesheet" href="assets/css/demo.css">
    <!-- GOOGLE FONTS -->
    <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700" rel="stylesheet">
    <!-- ICONS -->
    <link rel="apple-touch-icon" sizes="76x76" href="assets/img/apple-icon.png">
    <link rel="icon" type="image/png" sizes="96x96" href="assets/img/favicon.png">
</head>

<body>
    <!-- WRAPPER -->
    <div id="wrapper">
        <div class="vertical-align-wrap">
            <div class="vertical-align-middle">
                <div class="auth-box ">
                    <div class="left">
                        <div class="content">
                            <div class="header">
                                <div class="logo text-center"><img src="assets/img/logo.png" alt="Mobienviron" class="img-responsive" style="margin: 0 auto;"></div>
                                <p class="lead">Login to your account</p>
                            </div>
                            <form class="form-auth-small" action="checklogin.php" method="POST">                   
                                <div class="form-group">
								<h3><?php if(isset($_GET['msg'])){ echo $_GET['msg']; } ?></h3>
                                    <label for="signin-email" class="control-label sr-only">Email</label>
                                    <input type="text" class="form-control" id="signin-email" name="username" value="" placeholder="Email">
                                </div>
                                <input type="hidden" name="position" value="login"> 
                                <div class="form-group">
                                    <label for="signin-password" class="control-label sr-only">Password</label>
                                    <input type="password" class="form-control" id="signin-password" name="password" value="" placeholder="Password">
                                </div>
                                
                                <button type="submit" class="btn btn-primary btn-lg btn-block">LOGIN</button>
                            </form>
                        </div>
                    </div>
                    <div class="right">
                        <div class="overlay"></div>
                        <div class="content text">
                            <h1 class="heading">Welcome Back Admin !!</h1>
                            <p>Enter credintials to login</p>
                        </div>
                    </div>
                    <div class="clearfix"></div>
                </div>
            </div>
        </div>
    </div>
    <!-- END WRAPPER -->
</body>
</html>