<?php
if(isset($_POST['variable_status'])){
if($_POST['variable_status'] == 1)
    $sql = mysqli_qurey($conn, "SELECT * FROM product");
    $result = mysqli_qurey($sql);
    while ($row = mysqli_fetch_assoc($result)) {
    echo " <select name='variable_product'  class='form-control' required>
    <option value='none'>-</option>
    
    <option value='1'>Yes</option> 
    <option value='0'>No</option>
 </select>";
    }
}
?>