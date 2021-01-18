<?php include("../db.php");

//include("header.php");
//include("nav_bar.php");
//include("nav_left.php");
$ordinfo=mysqli_fetch_array(mysqli_query($conn,"SELECT * FROM orders WHERE id='$_GET[ordid]'")); 
$ship=json_decode($ordinfo['shipping_address']);
//$bill=json_decode($ordinfo->billing_address);
//$orderdata=json_decode($ordinfo->order_detail,TRUE);
?>
<?php
$curl = curl_init();

curl_setopt_array($curl, array(
  CURLOPT_URL => "https://track.delhivery.com/api/p/packing_slip?wbns=".$_GET['waybill'],
  CURLOPT_RETURNTRANSFER => true,
  CURLOPT_ENCODING => "",
  CURLOPT_MAXREDIRS => 10,
  CURLOPT_TIMEOUT => 0,
  CURLOPT_FOLLOWLOCATION => true,
  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
  CURLOPT_CUSTOMREQUEST => "GET",
  CURLOPT_HTTPHEADER => array(
    "Authorization: Token d21171173d06430805e5331ce1942757122c1148"
  ),
));

$response = curl_exec($curl);

curl_close($curl);
//echo $response;
$resp=json_decode($response,true);
//echo '<pre>';
//print_r($resp);
//echo '</pre>';

$html='';
$html.='<html>
<body>
  <center> 
  <div id="html-content-holder"> 
<table style="width:400px!important;border-spacing:0;border-collapse:collapse; border:1px solid;">
        <tbody>
            <tr>
                <td style="border:1px solid;">
					<h2>Theja Franchise</h2>
				</td>
				<td style="border:1px solid;">
					<img src="assets/img/delhivery.png"/>
				</td>
			</tr>
            <tr>
            <table style="width:400px!important;border-spacing:0;border-collapse:collapse; border:1px solid;">
                <tbody>
                <tr>
                    <td>
                    <img style="display:block;margin:0 auto;padding:30px;"src="'.$resp['packages'][0]['barcode'].'"/>
                        </td>
                    </tr>
                    <tr>
                        <td>'.$resp['packages'][0]['pin'].'</td>
                        <td>'.$resp['packages'][0]['sort_code'].'</td>
                    </tr>
                    <tr>
                   
                    </tr>
                </tbody>
            </table>   
            </tr>
            
            <tr>
            <table style="width:400px!important;border-spacing:0;border-collapse:collapse; border:1px solid;">
                <tbody>
                    <tr>
                        <td style="width:300px!important;border-spacing:0;border-collapse:collapse; border:1px solid;">
                        <p>Shipping Address:</p>
                            <strong>'.$ship->sname.'</strong>
                            <p><strong>Phone :</strong>'.$ship->smobile.'</p>
                            <p>'.$ship->saddr1.', '.$ship->saddr2.', '.$ship->saddr3.', '.$ship->scity.', '.$ship->sstate.', '.$ship->scountry.'</p>
                           <p><strong>Pin : </strong>'.$ship->spincode.'</p>
                        </td>
                        <td style="border-spacing:0;border-collapse:collapse; border:1px solid;">
                            '.$resp['packages'][0]['pt'].'
                        </td>
                    </tr>
                    <tr>
                   
                    </tr>
                </tbody>
            </table>   
            </tr>
            <tr>
            <table style="width:400px!important;border-spacing:0;border-collapse:collapse; border:1px solid;">
                <tbody>
                    <tr>
                        <td style="width:300px!important;border-spacing:0;border-collapse:collapse; border:1px solid;">
                        <p>Seller Address:</p>
                            <strong>Theja Couture</strong>
                            <p>1046-1047, '.$resp['packages'][0]['sadd'].'</p>
                            
                           <p><strong>Pin : </strong>'.$resp['packages'][0]['pin'].'</p>
                        </td>
                        <td style="border-spacing:0;border-collapse:collapse; border:1px solid;">
                            '.$resp['packages'][0]['cd'].'
                        </td>
                    </tr>
                    <tr>
                   
                    </tr>
                </tbody>
            </table>   
            </tr>
            <tr>
                <table style="width:400px!important;border-spacing:0;border-collapse:collapse; border:1px solid;">
                <tbody>
                    <tr>
                        <td style="border-spacing:0;border-collapse:collapse; border:1px solid;">Product</td>
                        <td style="border-spacing:0;border-collapse:collapse; border:1px solid;">Price</td>
                        <td style="border-spacing:0;border-collapse:collapse; border:1px solid;">Total</td>
                    </tr>
                    <tr>
                        <td style="border-spacing:0;border-collapse:collapse; border:1px solid;">'.$resp['packages'][0]['prd'].'</td>
                        <td style="border-spacing:0;border-collapse:collapse; border:1px solid;">Rs. '.$ordinfo['grant_total'].'</td>
                        <td style="border-spacing:0;border-collapse:collapse; border:1px solid;">Rs. '.$ordinfo['grant_total'].'</td>
                    </tr>
                    <tr>
                        <td style="border-spacing:0;border-collapse:collapse; border:1px solid;">Total</td>
                        <td style="border-spacing:0;border-collapse:collapse; border:1px solid;">Rs. '.$ordinfo['grant_total'].'</td>
                        <td style="border-spacing:0;border-collapse:collapse; border:1px solid;">Rs. '.$ordinfo['grant_total'].'</td>
                    </tr>
                    </tbody>
                </table>
            </tr>
            <tr>
            <table style="width:400px!important;border-spacing:0;border-collapse:collapse; border:1px solid;">
                <tbody>
                <tr>
                    <td>
                    <img style="display:block;margin:0 auto;padding:30px;"src="'.$resp['packages'][0]['oid_barcode'].'"/>
                        </td>
                    </tr>
                    <tr>
                    <td style="border-spacing:0;border-collapse:collapse; border:1px solid;">
                     <p><strong>Return Address: </strong>1046-1047, '.$resp['packages'][0]['sadd'].' '.$resp['packages'][0]['pin'].'</p>
                        </td>
                    </tr>
                </tbody>
            </table>   
            </tr>
           
		</tbody>
</table>
  </center> 
  </div>
</body>
</html>';

?>
<?php
echo $html;
?>

    <input id="btn-Preview-Image" type="button"
                value="Preview" />  
          
    <a id="btn-Convert-Html2Image" href="#"> 
        Download 
    </a> 
  
    <br/> 
      
    <h3>Preview :</h3> 
      
    <div id="previewImage"></div> 
          <script src= 
"https://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"> 
    </script> 
      
    <script src= 
"https://files.codepedia.info/files/uploads/iScripts/html2canvas.js"> 
    </script> 
    <script> 
        $(document).ready(function() { 
          
            // Global variable 
            var element = $("#html-content-holder");  
          
            // Global variable 
            var getCanvas;  
  
            $("#btn-Preview-Image").on('click', function() { 
                html2canvas(element, { 
                    onrendered: function(canvas) { 
                        $("#previewImage").append(canvas); 
                        getCanvas = canvas; 
                    } 
                }); 
            }); 
  
            $("#btn-Convert-Html2Image").on('click', function() { 
                var imgageData =  
                    getCanvas.toDataURL("image/png"); 
              
                // Now browser starts downloading  
                // it instead of just showing it 
                var newData = imgageData.replace( 
                /^data:image\/png/, "data:application/octet-stream"); 
              
                $("#btn-Convert-Html2Image").attr( 
                "download", "GeeksForGeeks.png").attr( 
                "href", newData); 
            }); 
        }); 
    </script> 