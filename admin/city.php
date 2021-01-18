<?php include("header.php") ?>
<?php include("nav_bar.php") ?>
<?php include("nav_left.php") ?>

  <div class="main">
            <div class="main-content">
                <div class="container-fluid">
                    <h3 class="page-title">City</h3>
                    <div class="row">
                        <div class="col-md-6">
                            <!-- BASIC TABLE -->
                            <div class="panel">
                                <div class="panel-heading">
                                    <h3 class="panel-title"></h3>
                                </div>
                                <div class="panel-body">
                                    <table id="datatable" class="table responsive-data-table  dataTable" width="100%" cellspacing="0">
                                                <thead>
                                                <tr role="row">
                                                    <th>S.no</th>
                                                <th>City</th>
                                                <th>Status</th>
                                                <th>Action</th>
                                               </thead>
                                                <tbody>
                                                    <?php $sql=$db->query("SELECT * FROM cities");
                                                    while($city=mysqli_fetch_array($sql)){ ?>
                                                        <tr>
                                                            <td><?=$city['id'];?></td>
                                                            <td><?=$city['city'];?></td>
                                                            <td><?=$city['status'];?></td>
                                                            <td><?php if($city['status']=='inactive'){ ?>
                                                                <form action="update.php" method="post">
                                                                    <input type="hidden" name="id" value="<?=$city['id'];?>">
                                                                    <input type="hidden" name="status" value="active">
                                                                <input type="submit" name="updatecity" class="btn btn-success" value="Active">
                                                                </form>
                                                           <?php  }else{ ?>
                                                            <form action="update.php" method="post">
                                                                <input type="hidden" name="id" value="<?=$city['id'];?>">
                                                                <input type="hidden" name="status" value="inactive">
                                                                <input type="submit" name="updatecity" class="btn btn-danger" value="Inactive">
                                                            </form>
                                                          <?php  } ?></td>
                                                        </tr>
                                                    <?php } ?>
                                                </tbody>
                                            </tr>
                                        </thead>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
    </div>
