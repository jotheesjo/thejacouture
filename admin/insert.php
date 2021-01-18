<?php include('init.php'); ?>
    <?php 
  if(isset($_POST['btn_upload'])){
if(empty($_POST['offer'][0])){
    $_POST['offer'][0]=0;
}
//      print_r($_POST);
$url=strtolower(str_replace(" ","-",$_POST['name']));
      $TotalUploadedFiles=count($_FILES['file_img']['name']);
      if($_FILES['file_img']['name'][0]!='')
{
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
  $img_paths=json_encode($img_path);
    }
}else{
  $img_paths='';
   $filepath2='';
}
//echo '<pre>';print_R($_POST['size']);echo '</pre>';
    function variation($size,$color,$weight,$qty,$price,$offer) {
    return array(
        'size' => $size,
        'color' => $color,
        'weight' => $weight,
        'qty' => $qty,
        'price' => $price,
        'offer' => $offer
    );
}
$map=array_map('variation',$_POST['size'],$_POST['color'],$_POST['weight'],$_POST['qty'],$_POST['price'],$_POST['offer']);
//echo'<pre>';print_r($map);echo'</pre>';
$combine=mysqli_fetch_assoc($db->query("SELECT product_id FROM products ORDER BY product_id DESC LIMIT 0,1 "));
 if($combine==''){
       $combine_id="101";
     }else{
       $combine_id=$combine['product_id']+101;
     }
foreach($map as $prod){
  //print_r($prod);
  $prod_id = mysqli_fetch_assoc($db->query("SELECT product_id FROM products ORDER BY product_id DESC LIMIT 0,1 "));
     if($prod_id==''){
       $prod_id="10001";
     }else{
       $prod_id=$prod_id['product_id']+10001;
     }
     $sku=$prod_id;
     if($prod['offer']!='' && $prod['offer']!='0'){
       $final_price=$prod["price"]-($prod["price"]*($prod['offer']/100));
     }else{
       $final_price=$prod["price"];
     }
    if(!isset($_POST['subcategory'])){
        $_POST['subcategory']='0';
    }
   $short_description=mysqli_real_escape_string($db->connection, $_POST['short_description']);
   $description=mysqli_real_escape_string($db->connection, $_POST['description']);
  $q=$db->query("insert into products(category,subcategory,name,sku,brand,material,size,color,weight,short_description,description,qty,price,offer,final_price,img_path,url,combine_variable,added_date) values('$_POST[category]','$_POST[subcategory]','$_POST[name]','$sku','$_POST[brand]','$_POST[material]','$prod[size]','$prod[color]','$prod[weight]','$short_description','$description','$prod[qty]','$prod[price]','$prod[offer]','$final_price','$img_paths','$url','$combine_id',NOW())");
 
} 
if($q){
echo ("<SCRIPT LANGUAGE='JavaScript'>
    window.location.href='add_product.php?msg=Product created successfully';
    </SCRIPT>");  
}else{
  echo ("<SCRIPT LANGUAGE='JavaScript'>
    window.location.href='add_product.php?msg=Failed to create product';
    </SCRIPT>");  
}

  }
  elseif(isset($_POST['bannersubmit']))
  {
    $file_name = $_FILES['file']['name'];
      $file_size =$_FILES['file']['size'];
      $file_tmp =$_FILES['file']['tmp_name'];
      $file_type=$_FILES['file']['type'];
     
      $rand=rand(1,10000);
        $tmp="../uploads/banner/".$rand.$file_name;  
        $tmp2="uploads/banner/".$rand.$file_name;
              move_uploaded_file($file_tmp,$tmp);
    $inr=$db->query("insert into banner(path) values ('$tmp2')");
        
      echo ("<SCRIPT LANGUAGE='JavaScript'>
    window.alert('Succesfully  Banner Added .. ')
    window.location.href='add_banner.php';
    </SCRIPT>");
      }
      else if(isset($_POST['brandsubmit']))  {
   $uomname=$_POST['brands']; 
   $uomdesc=$_POST['uomdesc'];

      $file_name = $_FILES['icon']['name'];
      $file_size =$_FILES['icon']['size'];
      $file_tmp =$_FILES['icon']['tmp_name'];
      $file_type=$_FILES['icon']['type'];
     
      $rand=rand(1,10000);
        $tmp="../uploads/brands/".$rand.$file_name;  
        $tmp2="uploads/brands/".$rand.$file_name;
              move_uploaded_file($file_tmp,$tmp);
              
     $uomc = $db->query("SELECT * FROM brands WHERE type='$uomname' AND brand='$uomdesc' ");
  if (mysqli_num_rows($uomc) != 0)
  {
       echo ("<SCRIPT LANGUAGE='JavaScript'>
    window.alert('Brands already exist Try another.. ')
    window.location.href='add_brand.php';
    </SCRIPT>");
  }
  else {

  $inr=$db->query("insert into brands(type,brand,status,path,time) values('$uomname','$uomdesc','active','$tmp2',NOW())");
    if ($inr) {
          echo ("<SCRIPT LANGUAGE='JavaScript'>
    window.alert('Succesfully  Brands Added .. ')
    window.location.href='add_brand.php';
    </SCRIPT>");
    }
    else {
   echo ("<SCRIPT LANGUAGE='JavaScript'>
    window.alert('Error While Adding .. ')
    window.location.href='add_brand.php';
    </SCRIPT>");
    }   
  } 
}else if(isset($_POST['couponsubmit'])){
  $inr=$db->query("insert into coupons(coupon,coupon_pecent,coupon_min_price,exp_date,create_date) values('$_POST[coupon]','$_POST[coupon_pecent]','$_POST[coupon_min_price]','$_POST[expdate]',NOW())");
   if ($inr) {
          echo ("<SCRIPT LANGUAGE='JavaScript'>
    window.location.href='coupon.php?msg=Coupon code created successfully';
    </SCRIPT>");
    }
    else {
   echo ("<SCRIPT LANGUAGE='JavaScript'>
    window.alert('Error While Adding .. ')
    window.location.href='coupon.php';
    </SCRIPT>");
    } 
}else if(isset($_POST['servicebrandsubmit'])){
    $inr=$db->query("insert into service_brand(name,create_date) values('$_POST[brand]',NOW())");
    if ($inr) {
          echo ("<SCRIPT LANGUAGE='JavaScript'>
    window.alert('Succesfully Updated .. ')
    window.location.href='add-service-brand.php';
    </SCRIPT>");
    }
    else {
   echo ("<SCRIPT LANGUAGE='JavaScript'>
    window.alert('Error While Adding .. ')
    window.location.href='add-service-brand.php';
    </SCRIPT>");
    } 
}else if(isset($_POST['servicemodelsubmit'])){
  
   $inr=$db->query("insert into service_model(brand,model,create_time,flash,charge,camera,tl,speaker,other_issue) values('$_POST[brands]','$_POST[model]',NOW(),'$_POST[flash]','$_POST[charge]','$_POST[camera]','$_POST[tl]','$_POST[speaker]','$_POST[other_issue]')");
   if ($inr) {
          echo ("<SCRIPT LANGUAGE='JavaScript'>
    window.alert('Succesfully Created .. ')
    window.location.href='add-service-models.php';
    </SCRIPT>");
    }
    else {
   echo ("<SCRIPT LANGUAGE='JavaScript'>
    window.alert('Error While Adding .. ')
    window.location.href='add-service-models.php';
    </SCRIPT>");
    } 
}


else if(isset($_POST['catsubmit'])){
if($_FILES['file']['name']==''){
   $tmp2="uploads/category/no_image.png";
}else{
  $file_name = $_FILES['file']['name'];
      $file_size =$_FILES['file']['size'];
      $file_tmp =$_FILES['file']['tmp_name'];
      $file_type=$_FILES['file']['type'];
     
      $rand=rand(1,10000);
        $tmp="../uploads/category/".$rand.$file_name;  
        $tmp2="uploads/category/".$rand.$file_name;
              move_uploaded_file($file_tmp,$tmp);
}
  
  
  $inr=$db->query("insert into category(cat_name,cat_desc,path) values('$_POST[catname]','$_POST[catdesc]','$tmp2')");
  if ($inr) {
         echo ("<SCRIPT LANGUAGE='JavaScript'>
   window.location.href='add_category.php?msg=category created successfully';
   </SCRIPT>");
   }
   else {
  echo ("<SCRIPT LANGUAGE='JavaScript'>window.location.href='add_category.php?msg=Error on create category';
   </SCRIPT>");
   } 
}else if(isset($_POST['subcatsubmit'])){
if($_FILES['file']['name']==''){
   $tmp2="uploads/subcategory/no_image.png";
}else{
  $file_name = $_FILES['file']['name'];
      $file_size =$_FILES['file']['size'];
      $file_tmp =$_FILES['file']['tmp_name'];
      $file_type=$_FILES['file']['type'];
     
      $rand=rand(1,10000);
        $tmp="../uploads/subcategory/".$rand.$file_name;  
        $tmp2="uploads/subcategory/".$rand.$file_name;
              move_uploaded_file($file_tmp,$tmp);
}
  
  
  $inr=$db->query("insert into sub_category(cat_id,scat_name,scat_img,scat_desc,status) values('$_POST[catid]','$_POST[scatname]','$tmp2','$_POST[scatdesc]','1')");
  if ($inr) {
         echo ("<SCRIPT LANGUAGE='JavaScript'>
   window.location.href='add_subcategory.php?msg=subcategory created successfully';
   </SCRIPT>");
   }
   else {
  echo ("<SCRIPT LANGUAGE='JavaScript'>window.location.href='view_subcategory.php?msg=Error on create subcategory';
   </SCRIPT>");
   } 
}else if(isset($_POST['btn_blog'])){
  $title=mysqli_real_escape_string($db->connection, $_POST['title']);
  $blog=mysqli_real_escape_string($db->connection, $_POST['blog']);
  $short_blog=mysqli_real_escape_string($db->connection, $_POST['short_blog']);
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
    $filepath2='';
  }
  $q= $db->query("insert into blog(path,status,time,title,blog,shortblog) values('$filepath2','active',NOW(),'$title','$blog','$short_blog')");
    if($q){
     echo ("<SCRIPT LANGUAGE='JavaScript'>
   window.location.href='blog.php?success=Blogs created successfully';
   </SCRIPT>");  
   }else{
     echo ("<SCRIPT LANGUAGE='JavaScript'>
    window.location.href='blog.php?success=Error on create blogs';
    </SCRIPT>");
   }
  

}else if(isset($_POST['btn_experience'])){
  print_r($_POST);
  $title=mysqli_real_escape_string($db->connection, $_POST['title']);
  $experience=mysqli_real_escape_string($db->connection, $_POST['experience']);
  $desc=mysqli_real_escape_string($db->connection, $_POST['desc']);
  $short_desc=mysqli_real_escape_string($db->connection, $_POST['short_desc']);
$inr= $db->query("insert into job(status,time,title,experience,description,short_desc) values('active',NOW(),'$title','$experience','$desc','$short_desc')");
  if ($inr) {
         echo ("<SCRIPT LANGUAGE='JavaScript'>
          window.location.href='career.php?msg=career created successfully';
          </SCRIPT>");
   }
   else {
  echo ("<SCRIPT LANGUAGE='JavaScript'>
   window.alert('Error While Adding .. ')
   window.location.href='career.php?msg=Error on create career';
   </SCRIPT>");
   } 
}else if(isset($_POST['add_size'])){
  //size variation 
  $inr=$db->query("insert into variation_size(size_name,size_desc,status) values('$_POST[size_name]','$_POST[size_desc]','1')");
  if ($inr) {
         echo ("<SCRIPT LANGUAGE='JavaScript'>
   window.location.href='add_size.php?msg=variation created successfully';
   </SCRIPT>");
   }
   else {
  echo ("<SCRIPT LANGUAGE='JavaScript'>window.location.href='add_size.php?msg=Error on create variation';
   </SCRIPT>");
   } 
}else if(isset($_POST['add_color'])){
  //color variation 
  $inr=$db->query("insert into variation_color(color_name,color_desc,status) values('$_POST[color_name]','$_POST[color_desc]','1')");
  if ($inr) {
         echo ("<SCRIPT LANGUAGE='JavaScript'>
   window.location.href='add_color.php?msg=variation created successfully';
   </SCRIPT>");
   }
   else {
  echo ("<SCRIPT LANGUAGE='JavaScript'>window.location.href='add_color.php?msg=Error on create variation';
   </SCRIPT>");
   } 
}else if(isset($_POST['add_type'])){
  //type variation 
  $inr=$db->query("insert into variation_type(type_name,type_desc,status) values('$_POST[type_name]','$_POST[type_desc]','1')");
  if ($inr) {
         echo ("<SCRIPT LANGUAGE='JavaScript'>
   window.location.href='add_type.php?msg=variation created successfully';
   </SCRIPT>");
   }
   else {
  echo ("<SCRIPT LANGUAGE='JavaScript'>window.location.href='add_type.php?msg=Error on create variation';
   </SCRIPT>");
   } 
}else if(isset($_POST['add_brand'])){
  //brand variation 
  $inr=$db->query("insert into variation_brand(brand_name,brand_desc,status) values('$_POST[brand_name]','$_POST[brand_desc]','1')");
  if ($inr) {
         echo ("<SCRIPT LANGUAGE='JavaScript'>
   window.location.href='add_brand.php?msg=variation created successfully';
   </SCRIPT>");
   }
   else {
  echo ("<SCRIPT LANGUAGE='JavaScript'>window.location.href='add_brand.php?msg=Error on create variation';
   </SCRIPT>");
   } 
}elseif(isset($_POST['feedbacksubmit']))
  {
    $file_name = $_FILES['file']['name'];
      $file_size =$_FILES['file']['size'];
      $file_tmp =$_FILES['file']['tmp_name'];
      $file_type=$_FILES['file']['type'];
     
      $rand=rand(1,10000);
        $tmp="../uploads/feedback/".$rand.$file_name;  
        $tmp2="uploads/feedback/".$rand.$file_name;
              move_uploaded_file($file_tmp,$tmp);
    $inr=$db->query("insert into feedback(path) values ('$tmp2')");
        
      echo ("<SCRIPT LANGUAGE='JavaScript'>
    window.location.href='feedback.php';
    </SCRIPT>");
      }

                ?>