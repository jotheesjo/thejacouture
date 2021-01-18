<?php include("header.php");
include("nav_bar.php");
include("nav_left.php");
$info=$db->queryUniqueObject("SELECT a.*,b.cat_name,d.brand_name,e.color_name,f.size_name,g.type_name FROM products a, category b,sub_category c, variation_brand d,variation_color e,variation_size f,variation_type g WHERE product_id='$_GET[proid]' AND b.id=a.category AND d.brand_id=a.brand AND e.color_id=a.color AND f.size_id=a.size AND g.type_id=a.material");?>
   <div class="main">

            <!-- MAIN CONTENT -->
            <div class="main-content">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-md-12">
                            <!-- BASIC TABLE -->
                            <div class="panel">
                                <div class="panel-heading">
                                    <h3 class="panel-title"><?=$info->name;?></h3>
                                </div>
                                <div class="panel-body">
                                 <table width="100%"  class="table convert-data-table table-striped">
                                        <thead>
                                          <tr><th>Category</th><th><?=$info->cat_name;?></th></tr>
                                          <tr><th>SKU</th><th><?=$info->sku;?></th></tr>
                                          <tr><th>Brand</th><th><?=$info->brand_name;?></th></tr>
                                            <tr><th>Material</th><th><?=$info->type_name;?></th></tr>
                                            <tr><th>Size</th><th><?=$info->size_name;?></th></tr>
                                            <tr><th>Color</th><th><?=$info->color_name;?></th></tr>
                                            <tr><th>Short Description</th><th><?=$info->short_description;?></th></tr>
                                            <tr><th>Description</th><th><?=$info->description;?></th></tr>
                                            <tr><th>Available Quantity</th><th><?=$info->qty;?></th></tr>
                                            <tr><th>Price</th>
                                              <th><?=$info->price;?> <?php if($info->offer!='' && $info->offer!='0'){
                                                echo $info->offer.'% off';
                                              }?></th></tr>
                                            <tr><th>Images</th><th><?php 
                                            $pro_img=json_decode($info->img_path);
                                            
                                            foreach($pro_img as $pr_img){ ?>
                                              <img src="../<?=$pr_img;?>" style="float:left;width:150px; padding:25px"/>
                                            <?php }
                                            ?></th></tr>
                                            <tr><th>Status</th><th><?php if($info->status=='1'){ echo "active";}else{ echo "inactive"; }?></th></tr>
                                            <tr><th>Created Date</th><th><?=$info->added_date;?></th></tr>
                                            <tr><th>Last Updated</th><th><?=$info->updated_date;?></th></tr>
                                        </thead>
                                    </table>
<a href="edit-product.php?proid=<?=$info->product_id;?>" class="m-r-15 text-muted  btn btn-warning btn-sm"  data-toggle="tooltip" data-placement="top" title="Edit" data-original-title="Edit"><i class="lnr lnr-pencil font-18"></i> Edit product</a>
                                </div>
                              </div>
                            </div>
                          </div>
                           
                          </div>




                        </div>
                      </div>




 

								

								<?php include("footer.php") ?>