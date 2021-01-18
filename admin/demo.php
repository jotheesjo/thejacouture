<?php include("header.php"); ?>
<?php include("nav_bar.php"); ?>
<?php include("nav_left.php"); ?>

		<div class="main">
			<!-- MAIN CONTENT -->
			<div class="main-content">
				<div class="container-fluid">
					<!-- OVERVIEW -->
					<div class="panel panel-headline">
						<div class="panel-heading">
							<h3 class="panel-title">Dashboard</h3>
							<p class="panel-subtitle"></p>
						</div>
						<div class="panel-body">
							<div class="row">


								<div class="col-md-3">
									<div class="metric">
										<span class="icon"><i class="fa fa-anchor"></i></span>
										<p>
											<span class="number"><?=$overallproducts;?></span>
											<span class="title">Products</span>
										</p>
									</div>
								</div>
								<div class="col-md-3">
									<div class="metric">
										<span class="icon"><i class="fa fa-users"></i></span>
										<p>
											<span class="number"><?=$overalluser;?></span>
											<span class="title">Customers</span>
										</p>
									</div>
								</div>
								
								<div class="col-md-3">
									<div class="metric">
										<span class="icon"><i class="fa fa-shopping-bag"></i></span>
										<p>
											<span class="number"><?=$overallorder;?></span>
											<span class="title">Orders</span>
										</p>
									</div>
								</div>
								<div class="col-md-3">
									<div class="metric">
										<span class="icon"><i class="fa fa-inr"></i></span>
										<p>
											<span class="number">INR <?=$overallsales;?></span>
											<span class="title">Total Sales</span>
										</p>
									</div>
								</div>
							</div>
						</div>
					</div>
					<!-- END OVERVIEW -->
<div class="row">
						<div class="col-md-6">
							<div class="panel">
								<div class="panel-heading">
									<h3 class="panel-title">Monthly Purchases</h3>
									<div class="right">
										<button type="button" class="btn-toggle-collapse"><i class="lnr lnr-chevron-up"></i></button>
										<button type="button" class="btn-remove"><i class="lnr lnr-cross"></i></button>
									</div>
								</div>
								<div class="panel-body no-padding">
									<div id="monthly-chart" class="ct-chart"></div>
								</div>
							</div>
						
						</div>
						<div class="col-md-6">
								<div class="panel">
								<div class="panel-heading">
									<h3 class="panel-title">Daily Purchases</h3>
									<?php echo "SELECT SUM(grant_total) as d0 FROM `orders` WHERE date LIKE '".date('Y-m-d')."%'" ;?>
									<div class="right">
										<button type="button" class="btn-toggle-collapse"><i class="lnr lnr-chevron-up"></i></button>
										<button type="button" class="btn-remove"><i class="lnr lnr-cross"></i></button>
									</div>
								</div>
								<div class="panel-body no-padding">
									<div id="daily-chart" class="ct-chart"></div>
								</div>
							</div>
						</div>
					</div>

					<div class="row">
						<div class="col-md-6">
							<!-- RECENT PURCHASES -->
							<div class="panel">
								<div class="panel-heading">
									<h3 class="panel-title">Recent Purchases</h3>
									<div class="right">
										<button type="button" class="btn-toggle-collapse"><i class="lnr lnr-chevron-up"></i></button>
										<button type="button" class="btn-remove"><i class="lnr lnr-cross"></i></button>
									</div>
								</div>
								<div class="panel-body no-padding">
									<table class="table table-striped">
										<thead>
											<tr>
												<th>Order No.</th>
												<th>Name</th>
												<th>Amount</th>
												<th>Date &amp; Time</th>
												<th>Status</th>
											</tr>
										</thead>
										<tbody>
											 <?php $order = $db->query("select * from orders ORDER By date DESC LIMIT 0,5 ");
                                            while($row1 = mysqli_fetch_array($order)){
											$user=$db->queryUniqueObject("SELECT * from signup WHERE id='$row1[user_id]'") ;
											//echo $user;
											?>

                                                <tr>
                                                    <td><a href="invoice.php?orders_id=<?=$row1[id];?>" target="_blank">ORD<?php  echo $row1['id'];?></a></td>
                                                    <td><?php  echo $user->f_name;?></td>
                                                    <td><?php  echo $row1['total_price'];?></td>
                                                    <td><?php  echo $row1['date'];?></td>
                                                    <td><?php  echo $row1['order_status'];?></td>
                                                    </tr>
                                                <?php  } ?>
										</tbody>
									</table>
								</div>
								<div class="panel-footer">
									<div class="row">
										<div class="col-md-4"><span class="panel-note"><i class="fa fa-clock-o"></i> Last 5 orders</span></div>
										<div class="col-md-8 text-right"><a href="orders.php" class="btn btn-primary">View All Purchases</a> <a href="reports.php" class="btn btn-primary">Report</a></div>

									</div>
								</div>
							</div>
						
						</div>
						<div class="col-md-6">
							
							<div class="panel">
								<div class="panel-heading">
									<h3 class="panel-title">Recent Serviceszxczcxzc</h3>
									<div class="right">
										<button type="button" class="btn-toggle-collapse"><i class="lnr lnr-chevron-up"></i></button>
										<button type="button" class="btn-remove"><i class="lnr lnr-cross"></i></button>
									</div>
								</div>
								<div class="panel-body no-padding">
									<table class="table table-striped">
										<thead>
											<tr>
												<th>Order No.</th>
												<th>Name</th>
												<th>Amount</th>
												<th>Date &amp; Time</th>
												<th>Status</th>
											</tr>
										</thead>
										<tbody>
											 <?php $service_order = $db->query("select * from service_order ORDER By order_time DESC LIMIT 0,5 ");
                                            while($row1 = mysqli_fetch_array($service_order)){ ?>
                                                <tr>
                                                    <td><?php  echo $row1['id'];?></td>
                                                    <td><?php  echo $row1['name'];?></td>
                                                    <td><?php  echo $row1['totalp'];?></td>
                                                    <td><?php  echo $row1['order_time'];?></td>
                                                    <td><?php  echo $row1['status'];?></td>
                                                    </tr>
                                                <?php  } ?>
										</tbody>
									</table>
								</div>
								<div class="panel-footer">
									<div class="row">
										<div class="col-md-6"><span class="panel-note"><i class="fa fa-clock-o"></i> Last 5 orders</span></div>
										<div class="col-md-6 text-right"><a href="service-order.php" class="btn btn-primary">View All Purchases</a></div>
										</div>
								</div>
							</div>
					
						</div>
					</div>
					<div class="row">
						<div class="col-md-6">
							
							<div class="panel">
								<div class="panel-heading">
									<h3 class="panel-title">Purchase Reports asdsa</h3>
									<div class="right">
										<button type="button" class="btn-toggle-collapse"><i class="lnr lnr-chevron-up"></i></button>
										<button type="button" class="btn-remove"><i class="lnr lnr-cross"></i></button>
									</div>
								</div>
								<form method="post" action="export.php">
								<div class="panel-body no-padding">
									<table class="table table-striped">
										<thead>
											<tr>
												<th>From</th>
												<th>TO</th>
											</tr>
										</thead>
										<tbody>
											 
                                                <tr>
                                                    <td><input type="date" name="from" class="form-control"></td>
                                                    <td><input type="date" name="to" class="form-control"></td>
                                                </tr>
										</tbody>
										
								</table>
							</div>
							<div class="panel-footer">
											<div class="row">asdasd
											<div class="col-md-12 text-right"><input type="submit" name="export" class="btn btn-primary" value="Generate"></div>
										</div>
									</div>
								</form>
							</div>
					
						</div>
					</div>
				</div>

			</div>
		</div>
yjgyjgghjh
    </div>
    <!-- END WRAPPER -->
    <!-- Javascript -->
   
</body>

</html>




