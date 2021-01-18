<?php 

if(isset($_POST["contactsubmit"])) { 
$name=$_POST['name']; 
$phone=$_POST['phone'];
$email=$_POST['email'];
$address=$_POST['address'];
$message=$_POST['message'];



$error ='check';

if($error != '') {
    
    
	  $to = "mktgco@ultrarmc.com";
     $to1 = "enquiry@ultrarmc.com";
	
      
$ref=$_SERVER['HTTP_REFERER'];

$ref=$_SERVER['HTTP_REFERER'];
$subject="Enquiry Form - Ultra RMC : Enquiry from". " " .$name;


if($name=='' || $name=='Name'){ echo "<span style=color:red>Enter a Valid Name</span>  <a href=".$ref.">Go Back</a>"; }
else{
    
$message='<table width=100% border=0 border-color:none cellspacing=3 cellpadding=3 class=text style="font-family:Arial; line-height:160% word-spacing:0.4em font-size:14px; border: 1px solid" bgcolor="#F9F9F9" color:"#465864">
<tr >
<td colspan="4"  align="center" bgcolor="#e0e1e1" ><strong >Enquiry Form (Star Apparels) : Enquiry from '.$name.'</strong></td>
</tr>

<tr> <td>Name</td> <td>:</td> <td >'.$name.'</td> </tr>
<tr> <td>Mobile Number</td> <td>:</td> <td>'.$phone.'</td> </tr>
<tr> <td>Email Id</td> <td>:</td><td>'.$email.'</td> </tr>
<tr> <td>Address </td> <td>:</td><td>'.$address.'</td> </tr>
<tr> <td>Message</td> <td>:</td> <td>'.$message.'</td> </tr>
  
</table>'; 
   
//echo $message;
  
   
// Set content-type header for sending HTML email
$headers = "MIME-Version: 1.0" . "\r\n";
$headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";

// Additional headers
$headers .= 'From:'.$from;

         
         $retval='ok';
     
         
         if( $retval == true ) {
             
 mail ($to,$subject,$message,$headers);
   mail ($to1,$subject,$message,$headers);
    
    
//$register = mysqli_query($con,"insert into login_tree(name,email,password,phone,country) values('$_POST[t1]','$_POST[t2]','$_POST[t3]','$_POST[t4]','$_POST[t5]')");

    
      
if($retval)
{
        echo ("<SCRIPT LANGUAGE='JavaScript'>
          window.alert('Thank you .. ')
    window.location.href='http://ultrarmc.com/contact-us.php?msg=thank you';
    </SCRIPT>");
    
}
else
{
        echo ("<SCRIPT LANGUAGE='JavaScript'>
    window.alert('Error While Adding .. ')
    window.location.href='http://ultrarmc.com/contact-us.php?msg=Error..';
    </SCRIPT>");    
}

      }
      
      
      
}   
}
}