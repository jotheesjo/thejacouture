<?php include('init.php'); ?>
<?php 
if(isset($_POST['bannerstatus'])){
	$db->query("UPDATE banner set status='$_POST[bstatus]' WHERE id='$_POST[banid]'");
	echo ("<script language='javascript'>
	window.location.href='add_banner.php?msg=banner status updated successfully';
    </SCRIPT>");
}else if(isset($_POST['bannerdelete'])){
        $db->query("DELETE FROM banner WHERE id='$_POST[banid]'");
         echo ("<SCRIPT LANGUAGE='JavaScript'>
    window.location.href='add_banner.php?msg=banner deleted successfully';
    </SCRIPT>");
      }elseif(isset($_POST['feedbackstatus'])){
	$db->query("UPDATE feedback set status='$_POST[bstatus]' WHERE id='$_POST[banid]'");
	echo ("<script language='javascript'>
	window.location.href='feedback.php?msg=Feedback status updated successfully';
    </SCRIPT>");
}else if(isset($_POST['feedbackdelete'])){
        $db->query("DELETE FROM feedback WHERE id='$_POST[banid]'");
         echo ("<SCRIPT LANGUAGE='JavaScript'>
    window.location.href='feedback.php?msg=feedback deleted successfully';
    </SCRIPT>");
      }
  elseif (isset($_POST['updatebrands'])) {
$t1=$_POST['brands'];
$t2=$_POST['uomdesc'];
$id=$_POST['uomid'];
 $file_name = $_FILES['icon']['name'];
      $file_size =$_FILES['icon']['size'];
      $file_tmp =$_FILES['icon']['tmp_name'];
      $file_type=$_FILES['icon']['type'];
       $rand=rand(1,10000);
        $tmp="../uploads/brands/".$rand.$file_name;  
        $tmp2="uploads/brands/".$rand.$file_name;
              move_uploaded_file($file_tmp,$tmp);
              if($file_name!=''){
             $upcat =$db->query("update brands set type='$t1',brand='$t2' ,path='$tmp2' where id='$id'");
              }else{
                 $upcat =$db->query("update brands set type='$t1',brand='$t2' where id='$id'");
              }
	if($upcat) {			
	 echo ("<SCRIPT LANGUAGE='JavaScript'>
    window.alert('Succesfully Brands Updated .. ')
    window.location.href='add_brand.php';
    </SCRIPT>");	
	  }
	 else{			
	 echo ("<SCRIPT LANGUAGE='JavaScript'>
    window.alert('Error .. ')
    window.location.href='add_brand.php';
    </SCRIPT>");	
	  }
  }elseif(isset($_POST['updatcat'])){
   $file_name = $_FILES['file']['name'];
   if($file_name!=''){
    $file_size =$_FILES['file']['size'];
      $file_tmp =$_FILES['file']['tmp_name'];
      $file_type=$_FILES['file']['type'];
     
      $rand=rand(1,10000);
       $tmp="../uploads/category/".$rand.$file_name;  
        $tmp2="uploads/category/".$rand.$file_name;
              move_uploaded_file($file_tmp,$tmp);
 $upcat =$db->query("update category set cat_name='$_POST[name]',cat_Desc='$_POST[description]',status='$_POST[status]', path='$tmp2' where id='$_POST[catid]'");
   }else{
    $upcat =$db->query("update category set cat_name='$_POST[name]',cat_Desc='$_POST[description]',status='$_POST[status]' where id='$_POST[catid]'");
   }
  if($upcat){
     echo ("<SCRIPT LANGUAGE='JavaScript'>
    window.location.href='view_category.php?msg=Category updated successfully';
    </SCRIPT>");  
     }
   else{     
   echo ("<SCRIPT LANGUAGE='JavaScript'>
    window.location.href='view_category.php?msg=Error on update category';
    </SCRIPT>");  
    }
  }elseif(isset($_POST['updatsubcat'])){

   $file_name = $_FILES['file']['name'];
   if($file_name!=''){
    $file_size =$_FILES['file']['size'];
      $file_tmp =$_FILES['file']['tmp_name'];
      $file_type=$_FILES['file']['type'];
     
      $rand=rand(1,10000);
       $tmp="../uploads/subcategory/".$rand.$file_name;  
        $tmp2="uploads/subcategory/".$rand.$file_name;
              move_uploaded_file($file_tmp,$tmp);
 $upcat =$db->query("update sub_category set cat_id='$_POST[catid]',scat_name='$_POST[scatname]',scat_desc='$_POST[scatdesc]',status='$_POST[status]', scat_img='$tmp2' where id='$_POST[scatid]'");
   }else{
    $upcat =$db->query("update sub_category set cat_id='$_POST[catid]',scat_name='$_POST[scatname]',scat_desc='$_POST[scatdesc]',status='$_POST[status]' where id='$_POST[scatid]'");
   }
  if($upcat){
     echo ("<SCRIPT LANGUAGE='JavaScript'>
    window.location.href='view_subcategory.php?msg=Subcategory updated successfully';
    </SCRIPT>");  
     }
   else{     
   echo ("<SCRIPT LANGUAGE='JavaScript'>
    window.location.href='view_subcategory.php?msg=Error on update subcategory';
    </SCRIPT>");  
    }
  }elseif (isset($_POST['btn_update'])) {
//print_r($_POST);
    $TotalUploadedFiles=count($_FILES['file_img']['name']);
$img=$db->queryuniqueObject("SELECT img_path from products WHERE product_id='$_POST[proid]'");
      if($_FILES['file_img']['name'][0]!=''){
        $img_path=array();
  $rand=rand(1,10000);
    for($i = 0; $i < $TotalUploadedFiles; $i++){
      $filetmp = $_FILES["file_img"]["tmp_name"][$i];
    $filename = $_FILES["file_img"]["name"][$i];
    $filetype = $_FILES["file_img"]["type"][$i];
    $filepath = "../uploads/products/".$rand.$filename;
    $filepath2 = "uploads/products/".$rand.$filename;
  move_uploaded_file($filetmp,$filepath); 
  $img_path[]=$filepath2;
    }
$old_img=json_decode($img->img_path);
// $new_img=json_encode(array_merge($old_img,$img_path));
$new_img=json_encode($img_path);
}else{
  $new_img=$img->img_path;
}
 if($_POST['offer']!='' && $_POST['offer']!='0'){
       $final_price=$_POST["price"]-($_POST["price"]*($_POST['offer']/100));
     }else{
     $_POST['offer']='0';
       $final_price=$_POST["price"];
     }
     //echo "UPDATE products set name='$_POST[name]',short_description='$_POST[short_description]',description='$_POST[description]', size='$_POST[size]',color='$_POST[color]',qty='$_POST[qty]',price='$_POST[price]',offer='$_POST[offer]',final_price='$final_price',status='$_POST[status]' WHERE id='$_POST[proid]'";
      $short_description=mysqli_real_escape_string($db->connection, $_POST['short_description']);
   $description=mysqli_real_escape_string($db->connection, $_POST['description']);
   $inr=$db->query("UPDATE products set name='$_POST[name]',short_description='$short_description',description='$description', size='$_POST[size]',color='$_POST[color]',weight='$_POST[weight]',qty='$_POST[qty]',price='$_POST[price]',offer='$_POST[offer]',final_price='$final_price',img_path='$new_img',status='$_POST[status]',updated_date=NOW() WHERE product_id='$_POST[proid]'");
    if($inr){
   echo ("<SCRIPT LANGUAGE='JavaScript'>
    window.location.href='view_product.php?msg=product updated successfully';
    </SCRIPT>"); 
 }else{
  echo ("<SCRIPT LANGUAGE='JavaScript'>
    window.location.href='view_product.php?msg=Failed to update products';
    </SCRIPT>"); 
 }
   

  }
  else if(isset($_POST['updatereview'])){
    $uprev =$db->query("update product_review set notification='0',status_review='$_POST[status]' where review_id='$_POST[reviewid]'");
  if($uprev) {      
   echo ("<SCRIPT LANGUAGE='JavaScript'>
    window.location.href='reviews.php?msg=review updated successfully';
    </SCRIPT>");  
    }
    else{     
   echo ("<SCRIPT LANGUAGE='JavaScript'>
    window.alert('Error...')
    window.location.href='reviews.php';
    </SCRIPT>");  
    }

  }else if(isset($_POST['updatecustomertatus'])){
    $uprev =$db->query("update customer set status='$_POST[status]' where customer_id='$_POST[userid]'");
    if($uprev) {      
   echo ("<SCRIPT LANGUAGE='JavaScript'>
    window.location.href='customers.php?msg=status updated successfully';
    </SCRIPT>");  
    }
    else{     
   echo ("<SCRIPT LANGUAGE='JavaScript'>
    window.location.href='customers.php?msg=Failed to update status';
    </SCRIPT>");  
    }
  }
  else if(isset($_POST['btn_update_profile'])){
  // print_r($_POST);
  $uprev =$db->query("UPDATE customer SET f_name='$_POST[f_name]',l_name='$_POST[l_name]',phone='$_POST[phone]',email='$_POST[email]',user_address='$_POST[user_address]',city='$_POST[city]',state='$_POST[state]',country='$_POST[country]',zip='$_POST[zip]',information='$_POST[information]' WHERE customer_id='$_POST[id]'");
  if($uprev) {      
   echo ("<SCRIPT LANGUAGE='JavaScript'>
    window.location.href='customers.php?msg=Profile updated successfully';
    </SCRIPT>");  
    }
    else{     
   echo ("<SCRIPT LANGUAGE='JavaScript'>
    window.location.href='customers.php?msg=Failed to update profile';
    </SCRIPT>");  
    }
}else if(isset($_POST['update_order_status'])){
      $uprev =$db->query("update orders set notification='0',order_status='$_POST[status]',shipping_information='$_POST[shipping_information]' WHERE id='$_POST[order_id]'");
      $ref=$_SERVER['HTTP_REFERER'];
      $to=$_POST['ship_email'];
$message="Dear ".$_POST['ship_name'].", <br> You order ".$_POST[status]." <br>Order id :".$_POST[order_id]." <br>".$_POST[shipping_information];
$subject="Message From Theja Couture";
      $headers  = 'MIME-Version: 1.0' . "\r\n";
$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
$headers .= 'From:  theja@thejacouture.in';

mail($to,$subject,"$message",$headers);
        if($uprev) {      
   echo ("<SCRIPT LANGUAGE='JavaScript'>
    window.location.href='order-information.php?msg=Status updated successfully&ordid=".$_POST['order_id']."&userid=".$_POST['user_id']."'</SCRIPT>");  
    }
    else{     
   echo ("<SCRIPT LANGUAGE='JavaScript'>
    window.location.href='order-information.php?msg=Failed to update status&ordid=".$_POST['order_id']."&userid=".$_POST['user_id']."'</SCRIPT>");  
    }
  }else if(isset($_POST['couponupdate'])){
    $uprev =$db->query("update coupons set coupon='$_POST[coupon]',exp_date='$_POST[expdate]',coupon_pecent='$_POST[coupon_pecent]',coupon_min_price='$_POST[coupon_min_price]' where id='$_POST[id]'");
    if($uprev) {      
   echo ("<SCRIPT LANGUAGE='JavaScript'>
    window.location.href='coupon.php?msg=Coupon updated successfully';
    </SCRIPT>");  
    }
    else{     
   echo ("<SCRIPT LANGUAGE='JavaScript'>
    window.alert('Error...')
    window.location.href='coupon.php';
    </SCRIPT>");  
    }
  }else if(isset($_POST['updateservicebrands'])){
    $uprev =$db->query("update service_brand set name='$_POST[ueditname]' where id='$_POST[brandid]'");
    echo ("<SCRIPT LANGUAGE='JavaScript'>
    window.alert('seccess...')
    window.location.href='add-service-brand.php';
    </SCRIPT>");  
  }else if(isset($_POST['updateservicemodel'])){
    $uprev =$db->query("update service_model set model='$_POST[model]',brand='$_POST[brands]',flash='$_POST[flash]',charge='$_POST[charge]',camera='$_POST[camera]',tl='$_POST[tl]',speaker='$_POST[speaker]',other_issue='$_POST[other_issue]' where id='$_POST[modelid]'");
    echo ("<SCRIPT LANGUAGE='JavaScript'>
    window.alert('seccess...')
    window.location.href='add-service-models.php';
    </SCRIPT>");  
  }else if(isset($_POST['servstatus'])){
    $uprev =$db->query("update service_order set status='$_POST[servordstatus]',notification='0' where id='$_POST[id]'");
    echo ("<SCRIPT LANGUAGE='JavaScript'>
    window.alert('seccess...')
    window.location.href='service-order.php';
    </SCRIPT>");  
  }else if(isset($_POST['updatecity'])){
    $uprev =$db->query("update cities set status='$_POST[status]' where id='$_POST[id]'");
    echo ("<SCRIPT LANGUAGE='JavaScript'>
    window.location.href='city.php';
    </SCRIPT>");  
  }else if(isset($_POST['btn_tandc'])){
    $tandc=mysqli_real_escape_string($db->connection,$_POST['tandc']);
    $uprev =$db->query("update policies set terms_and_con='$tandc'");
    echo "update policies set terms_and_con='$tandc'";
    echo ("<SCRIPT LANGUAGE='JavaScript'>
    window.location.href='terms-and-condition.php?msg=Content updated successfully';
    </SCRIPT>");  
  }else if(isset($_POST['btn_privacy'])){
    $uprev =$db->query("update policies set privacy_policy='$_POST[privacy]'");
    echo ("<SCRIPT LANGUAGE='JavaScript'>
    window.location.href='privacy-policy.php?msg=Content updated successfully';
    </SCRIPT>");  
  }else if(isset($_POST['btn_delivery'])){
    $uprev =$db->query("update policies set delivery_information='$_POST[delivery]'");
    echo ("<SCRIPT LANGUAGE='JavaScript'>
    window.location.href='delivery-information.php?msg=Content updated successfully';
    </SCRIPT>");  
  }else if(isset($_POST['btn_return'])){
    $uprev =$db->query("update policies set return_policy='$_POST[return]'");
    echo ("<SCRIPT LANGUAGE='JavaScript'>
    window.location.href='return-policy.php?msg=Content updated successfully';
    </SCRIPT>");  
  }else if(isset($_POST['btn_our_works'])){
    $uprev =$db->query("update policies set our_works='$_POST[our_works]'");
    echo ("<SCRIPT LANGUAGE='JavaScript'>
    window.location.href='our-works.php?msg=Content updated successfully';
    </SCRIPT>");  
  }else if(isset($_POST['btn_about_us'])){
       $TotalUploadedFiles=count($_FILES['file_img']['name']);
      if($_FILES['file_img']['name'][0]!='')
{
    for($i = 0; $i < $TotalUploadedFiles; $i++){
      $filetmp = $_FILES["file_img"]["tmp_name"][$i];
    $filename = $_FILES["file_img"]["name"][$i];
    $filetype = $_FILES["file_img"]["type"][$i];
    $filepath = "../uploads/about/".$filename;
  $filepath2 = "uploads/about/".$filename;
  move_uploaded_file($filetmp,$filepath);
    } 
}else{
    $pp=$db->queryUniqueObject("SELECT about_img FROM policies WHERE id='1'");
    $filepath2=$pp->path;
  }
      
    $uprev =$db->query("update policies set about='$_POST[about]' ,about_img='$filepath2'");
    echo ("<SCRIPT LANGUAGE='JavaScript'>
    window.location.href='about-us.php?msg=Content updated successfully';
    </SCRIPT>");  
  }else if(isset($_POST['btn_profile'])){
    $uprev =$db->query("update admin_details set name='$_POST[name]',mobile='$_POST[mobile]',email='$_POST[email]',add1='$_POST[add1]',add2='$_POST[add2]',gst='$_POST[gst]',state='$_POST[state]',city='$_POST[city]',pin='$_POST[pin]',web='$_POST[web]',running='$_POST[running]'");
    echo ("<SCRIPT LANGUAGE='JavaScript'>
    window.location.href='profile.php';
    </SCRIPT>");  
  }else if(isset($_POST['ordupstatus'])){
     $upord =$db->query("update orders set notification='0',order_status='$_POST[servordstatus]' WHERE id='$_POST[id]'");
    echo ("<SCRIPT LANGUAGE='JavaScript'>
    window.location.href='orders.php';
    </SCRIPT>");  
  }else if(isset($_POST['update_blog'])){
  $title=mysqli_real_escape_string($db->connection, $_POST['title']);
  $shortblog=mysqli_real_escape_string($db->connection, $_POST['shortblog']);
  $blog=$blog=mysqli_real_escape_string($db->connection,$_POST['blog']);
  $TotalUploadedFiles=count($_FILES['file_img']['name']);
      if($_FILES['file_img']['name'][0]!='')
{
    for($i = 0; $i < $TotalUploadedFiles; $i++){
      $filetmp = $_FILES["file_img"]["tmp_name"][$i];
    $filename = $_FILES["file_img"]["name"][$i];
    $filetype = $_FILES["file_img"]["type"][$i];
    $filepath = "../uploads/blogs/".$filename;
  $filepath2 = "uploads/blogs/".$filename;
  move_uploaded_file($filetmp,$filepath);
    } 
}else{
    $pp=$db->queryUniqueObject("SELECT path FROM blog WHERE id='$_POST[id]'");
    $filepath2=$pp->path;
  }
  $uprev =$db->query("UPDATE blog SET path = '$filepath2',title='$title',shortblog='$shortblog',blog='$blog',time=NOW(),status='$_POST[status]' WHERE id ='$_POST[id]'");
  echo ("<SCRIPT LANGUAGE='JavaScript'>
   window.location.href='blog.php?success=Blog updated successfully';
    </SCRIPT>");
}elseif(isset($_POST['updatsize'])){
     $upord =$db->query("update variation_size set size_name='$_POST[name]',size_desc='$_POST[description]',status='$_POST[status]' WHERE size_id='$_POST[id]'");
     if($upord){
     echo ("<SCRIPT LANGUAGE='JavaScript'>
    window.location.href='view_size.php?msg=Variation updated successfully';
    </SCRIPT>");  
     }
   else{     
   echo ("<SCRIPT LANGUAGE='JavaScript'>
    window.location.href='view_size.php?msg=Error on update variation';
    </SCRIPT>");  
   }
  
}elseif(isset($_POST['updatsize'])){
  //variation Size
     $upord =$db->query("update variation_size set size_name='$_POST[name]',size_desc='$_POST[description]',status='$_POST[status]' WHERE size_id='$_POST[id]'");
     if($upord){
     echo ("<SCRIPT LANGUAGE='JavaScript'>
    window.location.href='view_size.php?msg=Variation updated successfully';
    </SCRIPT>");  
     }
   else{     
   echo ("<SCRIPT LANGUAGE='JavaScript'>
    window.location.href='view_size.php?msg=Error on update variation';
    </SCRIPT>");  
   }
  
  }elseif(isset($_POST['updatcolor'])){
    //variation color
     $upord =$db->query("update variation_color set color_name='$_POST[name]',color_desc='$_POST[description]',status='$_POST[status]' WHERE color_id='$_POST[id]'");
     if($upord){
     echo ("<SCRIPT LANGUAGE='JavaScript'>
    window.location.href='view_color.php?msg=Variation updated successfully';
    </SCRIPT>");  
     }
   else{     
   echo ("<SCRIPT LANGUAGE='JavaScript'>
    window.location.href='view_color.php?msg=Error on update variation';
    </SCRIPT>");  
   }
  
  }elseif(isset($_POST['updattype'])){
    //variation type
     $upord =$db->query("update variation_type set type_name='$_POST[name]',type_desc='$_POST[description]',status='$_POST[status]' WHERE type_id='$_POST[id]'");
     if($upord){
     echo ("<SCRIPT LANGUAGE='JavaScript'>
    window.location.href='view_type.php?msg=Variation updated successfully';
    </SCRIPT>");  
     }
   else{     
   echo ("<SCRIPT LANGUAGE='JavaScript'>
    window.location.href='view_type.php?msg=Error on update variation';
    </SCRIPT>");  
   }
  
  } elseif(isset($_POST['updatbrand'])){
    //variation brand
     $upord =$db->query("update variation_brand set brand_name='$_POST[name]',brand_desc='$_POST[description]',status='$_POST[status]' WHERE brand_id='$_POST[id]'");
     if($upord){
     echo ("<SCRIPT LANGUAGE='JavaScript'>
    window.location.href='view_brand.php?msg=Variation updated successfully';
    </SCRIPT>");  
     }
   else{     
   echo ("<SCRIPT LANGUAGE='JavaScript'>
    window.location.href='view_brand.php?msg=Error on update variation';
    </SCRIPT>");  
   }
  
  }   ?>