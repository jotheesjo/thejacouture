<?php include("init.php"); ?> 
<?php 
if(isset($_POST['prod_create_cat_id'])){
 $r=$db->query("SELECT id,scat_name FROM sub_category WHERE cat_id='$_POST[prod_create_cat_id]' AND status='1'");
                     			while($row=mysqli_fetch_assoc($r)){ 
                     				echo '<option value="'.$row['id'].'">'.$row['scat_name'].'</option>';
                     			}
}
?>