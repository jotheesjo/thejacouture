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
											<span class="number">₹ <?=$overallsales;?></span>
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
									<?php "SELECT SUM(grant_total) as d0 FROM `orders` WHERE date LIKE '".date('Y-m-d')."%'" ;?>
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
						<div class="col-md-12">
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
											$user=$db->queryUniqueObject("SELECT * from customer WHERE customer_id='$row1[user_id]'") ;
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
						
					</div>
                    
                    
                    <div class="row">
						<div class="col-md-12">
							<div class="panel">
								<div class="panel-heading">
									<h3 class="panel-title">Request to pickup</h3>
								</div>
								<div class="panel-body">
                                      <form method="GET" action="">
            <div class="form-group">
                <input type="text" name="pickup_time" value="" placeholder="13:10:00" required>
                <input type="text" name="pickup_date" placeholder="yyyy-mm-dd" required>
                <input type="text" name="pickup_location" value="THEJAFRANCHISE-B2C" required>
                <input type="number" name="package_count" value="" required>
             <button type="submit" class="btn btn-sm btn-success" name="req_to_pickup">Request to Delhivery </button>
           </div>
         </form>    
                        
<?php
if(isset($_GET['package_count'])){
        
$pickup_time=$_GET['pickup_time'];
    $pickup_date=$_GET['pickup_date'];
    $pickup_location=$_GET['pickup_location'];
    $expected_package_count=$_GET['package_count'];
$curl = curl_init();
curl_setopt_array($curl, array(
  CURLOPT_URL => "https://track.delhivery.com/fm/request/new/",
  CURLOPT_RETURNTRANSFER => true,
  CURLOPT_ENCODING => "",
  CURLOPT_MAXREDIRS => 10,
  CURLOPT_TIMEOUT => 0,
  CURLOPT_FOLLOWLOCATION => true,
  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
  CURLOPT_CUSTOMREQUEST => "POST",
  //CURLOPT_POSTFIELDS => array('pickup_time' => '13:10:51','pickup_date' => '2020-10-13','pickup_location' => 'THEJAFRANCHISE-B2C','expected_package_count' => '5'),
     CURLOPT_POSTFIELDS =>"{\"pickup_time\":\"$pickup_time\",\"pickup_date\":\"$pickup_date\",\"pickup_location\":\"$pickup_location\",\"expected_package_count\":\"$expected_package_count\"}",
  CURLOPT_HTTPHEADER => array(
    "Authorization: Token d21171173d06430805e5331ce1942757122c1148",
    "Content-Type: application/json"
  ),
));

$response = curl_exec($curl);

curl_close($curl);
$resp=json_decode($response);
//echo '<pre>';
//print_r($resp);
if(isset($resp->pr_exist)){
    echo $resp->data->message;
}else{
    echo "your pickup request is initiated on ".$resp->pickup_date." ".$resp->pickup_time.". Your pickup id is:".$resp->pickup_id.". Total package count is: ".$resp->expected_package_count;
}
//echo '</pre>';

    }
?>
                                </div>
                            </div>
    </div>
</div>
                    
                    
				</div>

			</div>
		</div>




<?php include("footer.php"); ?>
