<!-- NAVBAR -->
        <nav class="navbar navbar-default navbar-fixed-top">
            <div class="brand">
                <a href="welcome.php"><img src="<?php echo $admind->logo; ?>" alt="Mobienviron" class="img-responsive adlogo"></a>
            </div>
            <div class="container-fluid">
                
                <div id="navbar-menu">
                    <ul class="nav navbar-nav navbar-right">
                        <li><div class="navbar-btn">
                    <button type="button" class="btn-toggle-fullwidth"><i class="lnr lnr-arrow-left-circle"></i></button>
                </div></li>
                        <li class="dropdown">
                            <a href="#" class="dropdown-toggle icon-menu" data-toggle="dropdown">
                                <i class="lnr lnr-alarm"></i>
                                <span class="badge bg-danger"><?=$allnotification;?></span>
                            </a>
                            <ul class="dropdown-menu notifications">
                            <?php if($totproductorders>0){ ?>
                                <li><a href="orders.php" class="notification-item"><span class="dot bg-success"></span>You have <?=$totproductorders;?> unview Order</a></li>
                            <?php } ?>
                            <?php if($totreview>0){ ?>
                                <li><a href="reviews.php" class="notification-item"><span class="dot bg-warning"></span>You have <?=$totreview;?> unread Reviews</a></li>
                            <?php } ?>
                            </ul>
                        </li>
                        
                        <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown"><img src="assets/img/user.png" class="img-circle" alt="Avatar"> <span>Administrator</span> <i class="icon-submenu lnr lnr-chevron-down"></i></a>
                            <ul class="dropdown-menu">
                                <li><a href="profile.php"><i class="lnr lnr-user"></i> <span>My Profile</span></a></li>
                                <li><a href="logout.php"><i class="lnr lnr-exit"></i> <span>Logout</span></a></li>
                            </ul>
                        </li>
                      
                    </ul>
                </div>
            </div>
        </nav>
        <!-- END NAVBAR -->
