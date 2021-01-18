<?php include("header.php"); ?>
<?php include("nav_bar.php"); ?>
<?php include("nav_left.php"); 
$j=1;?> 
       <div class="main">
            <!-- MAIN CONTENT -->
            <div class="main-content">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-md-12">
                            <!-- BASIC TABLE -->
                            <div class="panel">
                                <div class="panel-heading">
                                    <h3 class="panel-title">Create Product</h3>
                                </div>
                                <div class="panel-body">

                                	<?php if(isset($_GET['msg'])){ ?> 
                                        <div class="alert alert-info">
                                            <strong>Info!</strong> <?=$_GET['msg'];?></div>
                                    <?php } ?>
                                	<form class="" action="insert.php" method="post" enctype="multipart/form-data">
			  <fieldset class="panel-body" >
                     <div class="row">
                     	<div class="col-xs-12 col-md-12">
						<div class="form-group">
                     		<div class="form-group">
                     			<label><strong>Name</strong>&nbsp;</label> <br>
                     			<input type="text" name="name" class="form-control" required>
                     		</div>
							</div>
                     	</div>
                     	<div class="col-xs-12 col-md-6">
						<div class="form-group">
                     		<label><strong>Category</strong></label> <br>
                     		<select class="form-control" name="category" id="category" required>
                     			<option disabled selected value>Choose category</option>
                     			<?php $r=$db->query("SELECT * FROM category WHERE status='active'");
                     			while($row=mysqli_fetch_assoc($r)){ 
                     				echo '<option value="'.$row['id'].'">'.$row['cat_name'].'</option>';
                     			}?>
                     		</select>
                     	</div>
						</div>

                     	<div class="col-xs-12 col-md-6">
						<div class="form-group">
                     		<label><strong>Subcategory</strong></label> <br>
                     		<select class="form-control" name="subcategory" id="subcategorylist" required>
                     			<option disabled selected value>Choose Subcategory</option>
                     		</select>
                     	</div>
						</div>

                     	
                     	<div class="col-xs-12 col-md-12">
                     	<div class="form-group">
						<label><strong>Images:</strong>&nbsp;</label> <br>
						 <input type="file" name="file_img[]" multiple class="form-control" required>
					 </div>
					 </div>

					 <div class="col-xs-12 col-md-12">
					 	<div class="form-group">
						<label><strong>Short Description:</strong>&nbsp;</label> <br>
						 <textarea class="form-control tinymce" name="short_description"></textarea>
					 </div>
					</div>

					<div class="col-xs-12 col-md-12">
					 	<div class="form-group">
						<label><strong>Description:</strong>&nbsp;</label> <br>
						 <textarea class="form-control tinymce" name="description"></textarea>
					 </div>
					</div>

<div class="col-xs-12 col-md-6">
<div class="form-group">
                     		<label><strong>Brand</strong></label> <br>
                     		<select class="form-control" name="brand" id="brand" required>
                     			<?php $brand=$db->query("SELECT * FROM variation_brand WHERE status='1'");
                     			while($brands=mysqli_fetch_assoc($brand)){ 
                     				echo '<option value="'.$brands['brand_id'].'">'.$brands['brand_name'].'</option>';
                     			}?>
                     		</select>
                     	</div>
						</div>

                     	<div class="col-xs-12 col-md-6">
						<div class="form-group">
                     		<label><strong>Material Type</strong></label> <br>
                     		<select class="form-control" name="material" id="materialtype" required>
                     			<option disabled selected value>Choose Material</option>
                     			<?php $material=$db->query("SELECT * FROM variation_type WHERE status='1'");
                     			while($materials=mysqli_fetch_assoc($material)){ 
                     				echo '<option value="'.$materials['type_id'].'">'.$materials['type_name'].'</option>';
                     			}?>
                     		</select>
                     	</div>
						</div>						
					<table class="timetable_sub table responsive-data-table  dataTable">
						<thead>
							<tr>
							    <!-- <th></th> -->
								
								<th>Size</th>
								<th>Color</th>	<th>Weight</th>									
								<th>Qty</th>
								<th>Price</th>
								<th>Offer</th>
<!--								<th>Action</th>-->
							</tr>
						</thead>
<input type="hidden"  id="lastid" value="<?php echo $j;?>">
 <tbody class="ss<?php echo $j;?>">
 	</tbody>
 	<tr class="variation<?php echo $j;?>" id="table_body_row" >
 		<td>
 			<select class="form-control" name="size[]" id="size<?=$j;?>" required>
                     			<?php $variation_size=$db->query("SELECT * FROM variation_size WHERE status='1'");
                     			while($size=mysqli_fetch_assoc($variation_size)){ 
                     				echo '<option value="'.$size['size_id'].'">'.$size['size_name'].'</option>';
                     			}?>
                     		</select>

 		</td>
 		<td>
 			<select class="form-control" name="color[]" id="color<?=$j;?>" required>
                     			<option disabled selected value>Color</option>
                     			<?php $variation_color=$db->query("SELECT * FROM variation_color WHERE status='1'");
                     			while($color=mysqli_fetch_assoc($variation_color)){ 
                     				echo '<option value="'.$color['color_id'].'">'.$color['color_name'].'</option>';
                     			}?>
                     		</select>
 		</td>		<td><input type="number" name="weight[]" class="form-control" required id="weight<?=$j;?>">(gm)</td>
 		<td><input type="number" name="qty[]" class="form-control" required id="qty<?=$j;?>"></td>
 		<td><input type="text" name="price[]" class="form-control" required id="price<?=$j;?>"></td>
 		<td><input type="number" name="offer[]" class="form-control" value="0"  id="offer<?=$j;?>"></td>
<!--
 		<td>
 			<p> <input  id="add<?php echo $j;?>" type="button" class="add-row btn btn-primary" value="+" onclick="add(this.id)"> &nbsp;<input  id="remove<?php echo $j;?>" type="button" class="delete-row btn btn-danger" onclick="dele_row(this.id);" value="-"></p>
 		</td>
-->
 	</tr>
 </table>


 <div class="form-group">
					 	<button type="submit" name="btn_upload" class="btn btn-primary waves-effect waves-light">Submit</button>
					 </div>

					 </div>
					 
                   <div id="sda"></div>

                                            </form>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>









<?php include("footer.php"); ?>
<script>
	$(document).ready(function(){
		$("#category").change(function(){
			var cat=this.value;
			$.ajax({
				url: 'ajax.php',
				type: 'POST',
				data: { prod_create_cat_id:cat},
				success: function(data){
					console.log(data);
					$('#subcategorylist').html('');
					$("#subcategorylist").append('<option disabled selected value>Choose Subcategory</option>');
					$("#subcategorylist").append(data);
				}
			});
		});
	

	});


//add clone
 function add(id){
	   var ids = id.match(/\d+/);
       var prefix = id.replace(/\d+/g, '');
	  var sufix=$(':hidden#lastid').val();
       var tbody=$(':hidden#stbody'+ids).val();

	var newNum=+sufix+1;
	$(".ss"+sufix).removeClass('ss'+sufix);
	//$(".variation"+ids).find("tbody").addClass('ss'+ids);
	
	$(".variation"+ids).closest("tbody").addClass('ss'+ids);
    // var newElem = row.append(row);
	var newElem = $(".variation"+ids).clone().appendTo(".ss"+ids);
	    //  newElem.find('.variation'+ids).rem('.variation'+''+newNum);
    newElem.closest("tbody").removeClass('ss'+ids);
    newElem.closest("tbody").addClass('ss'+newNum);
	newElem.closest("tr").removeClass('variation'+ids);
    newElem.closest("tr").addClass('variation'+newNum);
	newElem.find(":input[id*='size"+ids+"']").attr('id', 'size'+''+newNum);
	newElem.find(":input[id*='color"+ids+"']").attr('id', 'color'+''+newNum);	newElem.find(":input[id*='qty"+ids+"']").attr('id', 'qty'+''+newNum);
	newElem.find(":input[id*='qty"+ids+"']").attr('id', 'qty'+''+newNum);
	newElem.find(":input[id*='price"+ids+"']").attr('id', 'price'+''+newNum);
	newElem.find(":input[id*='offer"+ids+"']").attr('id', 'offer'+''+newNum);



	newElem.find(":input[id*='add"+ids+"']").attr('id', 'add'+''+newNum);
		newElem.find(":input[id*='remove"+ids+"']").attr('id', 'remove'+''+newNum);
		newElem.find(":input[id*='plus_"+ids+"']").attr('id', 'plus_'+''+newNum);
		newElem.find(":input[id*='minus_"+ids+"']").attr('id', 'minus_'+''+newNum);

		  
   document.getElementById('lastid').value=newNum;


   }
   
   //remove clone
   function dele_row(id){
	   
	   var suffix = id.match(/\d+/);
         var numItems = $('.variation'+suffix).length;
        $(".variation"+suffix+":last").remove();
      
   }

</script>
