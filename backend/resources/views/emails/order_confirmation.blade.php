<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
<meta name="format-detection" content="telephone=no"> 
<meta name="viewport" content="width=device-width, initial-scale=1.0"/>
<meta http-equiv="X-UA-Compatible" content="IE=9; IE=8; IE=7; IE=EDGE" />

<title>Order Confirmation</title>
<style type="text/css">
  body{padding:0; margin:0; background-color:#f5f5f4; font-family:arial; font-size:13px;}
  table{ border-collapse:collapse !important; mso-table-lspace:0pt !important; mso-table-rspace:0pt !important; }  
  td {font-family: arial, sans-serif; color: #010101;}
  img{border:0 !important;} 
    
  @media all and (max-width: 767px) 
  { 
    body,table,td,p,a,li,blockquote { -webkit-text-size-adjust:none !important;}
    a{white-space:nowrap;}
    table [class="contenttable"] { width:100% !important;}
    .responsive-image img { height: auto !important; max-width: 100% !important;    
  }
</style>
</head>

<body text="#010101" link="#010101" vlink="#010101" alink="#010101" marginheight="0" marginwidth="0" bgcolor="#ffffff" style="background-color:#ffffff; color:#010101;">
<table border="0" cellpadding="0" cellspacing="0" width="100%" bgcolor="#ffffff" style="background-color:#ffffff; color:#232323;">
  <tbody>
    <tr>
      <td style="padding: 0 15px;"><table width="650" border="0" cellspacing="0" cellpadding="0" align="center" style="border-collapse:collapse; mso-table-lspace:0pt; mso-table-rspace:0pt; background-color:#fff;" class="contenttable">
        <tbody>
          <tr>
            <td align="center" style="background-color:#fff; padding:18px 0;" class="logo"><img src="images/logo.png" alt=""></td>
          </tr>
          <tr>
            <td style="padding: 20px 0; border-top: 1px #f1f1f1 solid; border-bottom: 1px #f1f1f1 solid;"><table border="0" cellspacing="0" cellpadding="0" width="100%" style="border-collapse:collapse; mso-table-lspace:0pt; mso-table-rspace:0pt;" class="contenttable">
              <tr>
                <td style="font-family:Arial, Helvetica, sans-serif; font-size:16px; font-weight: bold;  line-height:20px; padding:0 0 15px;">Thanks for your order, <?php echo '[#'.$order['id'].']'; ?></td>
                </tr>
                <tr>
                <td style="font-family:Arial, Helvetica, sans-serif; font-size:16px; font-weight: bold;  line-height:20px; padding:0 0 15px;">Dear User,</td>
                </tr>
                <tr>
                <td style="font-family:Arial, Helvetica, sans-serif; font-size:16px; font-weight: bold;  line-height:20px;">Our driver will bring a Spotlex branded bag for your items at the time of collection. Simply seprate your items according to the services that you have booked (e.g iron only, laundry or dry cleaning)</td>
              </tr>
            </table></td>
          </tr>
          <tr>
            <td style="padding: 20px 0;"><table border="0" cellspacing="0" cellpadding="0" width="100%" style="border-collapse:collapse; mso-table-lspace:0pt; mso-table-rspace:0pt;" class="contenttable">
              <tr>
                <td style="font-family:Arial, Helvetica, sans-serif; font-size:16px; font-weight: bold; line-height:20px; padding:0 0 15px; border-bottom: 2px #2fb2ff solid;">Address</td>
              </tr>
                <tr>
                <td style="font-family:Arial, Helvetica, sans-serif; font-size:16px; line-height:20px; padding:15px 0;"><?php echo $order['street_name'].' '.$order['building_name_no']; ?><br>
                  <br>
                  state<br><?php echo $order['post_code'];?></td>
                </tr></table></td>
          </tr>

          <tr>
            <td style="padding: 20px 0 0;"><table border="0" cellspacing="0" cellpadding="0" width="100%" style="border-collapse:collapse; mso-table-lspace:0pt; mso-table-rspace:0pt;" class="contenttable">
              <tr>
                <td style="font-family:Arial, Helvetica, sans-serif; font-size:16px; font-weight: bold; line-height:20px; padding:0 0 15px; border-bottom: 2px #2fb2ff solid;">Collection and Delivery Details</td>
              </tr>
                <tr>
                <td style="padding: 20px 0 10px;"><table border="0" align="left" cellspacing="0" cellpadding="0" width="47%" style="border-collapse:collapse; mso-table-lspace:0pt; mso-table-rspace:0pt;" class="contenttable">
                  <tr>
                    <td style="padding: 15px; font-family:Arial, Helvetica, sans-serif; font-size:16px; line-height: 24px; background-color: #404040; color: #fff;">Collection  </br></br><?php echo $order['collection_date']; ?></br><?php echo $order['collection_time']?></td>
                  </tr>
                </table><table border="0" align="right" cellspacing="0" cellpadding="0" width="47%" style="border-collapse:collapse; mso-table-lspace:0pt; mso-table-rspace:0pt;" class="contenttable">
                  <tr>
                    <td style="padding: 15px; font-family:Arial, Helvetica, sans-serif; font-size:16px; line-height: 24px; background-color: #404040; color: #fff;">Delivery  </br></br><?php echo $order['delivery_date']; ?></br><?php echo $order['delivery_time']; ?></td>
                  </tr>
                </table></td>
                </tr></table></td>
          </tr>
          <tr>
            <td style="font-family:Arial, Helvetica, sans-serif; font-size:13px; line-height:20px; color: #999999;">Please note a $10 charge applies to orders that are cancelled or rescheduled less that 4 hours before collection.</td>
          </tr>
          <tr>
            <td style="padding: 20px 0;"><table border="0" cellspacing="0" cellpadding="0" width="100%" style="border-collapse:collapse; mso-table-lspace:0pt; mso-table-rspace:0pt;" class="contenttable">
              <tr>
                <td style="font-family:Arial, Helvetica, sans-serif; font-size:16px; font-weight: bold; line-height:20px; padding:0 0 15px; border-bottom: 2px #2fb2ff solid;">Items</td>
              </tr>
                <tr>
                <td style="padding:20px 0;"><table align="center" border="0" cellspacing="0" cellpadding="0" width="65%" style="border-collapse:collapse; mso-table-lspace:0pt; mso-table-rspace:0pt;" class="contenttable">
                  <tr>
                    <td width="50" style="padding: 5px 10px;"><img src="images/prod.jpg" alt=""></td>
                    <td width="30" align="center" style="font-family:Arial, Helvetica, sans-serif; font-size:15px; line-height:20px; color: #2fb2ff;">1x</td>
                    <td style="padding: 5px 10px; font-family:Arial, Helvetica, sans-serif; font-size:15px; line-height:20px; color: #222222; font-weight: bold;">two piece of suite</td>
                    <td align="right" style="padding: 5px 10px; font-family:Arial, Helvetica, sans-serif; font-size:15px; line-height:20px; color: #222222; font-weight: bold;">$10.50</td>
                  </tr>
                  <tr>
                    <td width="50" style="padding: 5px 10px;"><img src="images/prod.jpg" alt=""></td>
                    <td width="30" align="center" style="font-family:Arial, Helvetica, sans-serif; font-size:15px; line-height:20px; color: #2fb2ff;">1x</td>
                    <td style="padding: 5px 10px; font-family:Arial, Helvetica, sans-serif; font-size:15px; line-height:20px; color: #222222; font-weight: bold;">two piece of suite</td>
                    <td align="right" style="padding: 5px 10px; font-family:Arial, Helvetica, sans-serif; font-size:15px; line-height:20px; color: #222222; font-weight: bold;">$10.50</td>
                  </tr>
                </table>
                
                </td>
                </tr>
                <tr>
                <td style="padding:20px 0; border-bottom: 2px #2fb2ff solid; border-top: 2px #2fb2ff solid; "><table align="center" border="0" cellspacing="0" cellpadding="0" width="65%" style="border-collapse:collapse; mso-table-lspace:0pt; mso-table-rspace:0pt;" class="contenttable">
                  <tr>
                    <td style="padding: 2px 10px; font-family:Arial, Helvetica, sans-serif; font-size:15px; line-height:20px; color: #222222; font-weight: bold;">Subtotal</td>
                   
                    <td align="right" style="padding: 2px 10px; font-family:Arial, Helvetica, sans-serif; font-size:15px; line-height:20px; color: #222222; font-weight: bold;">$45.00</td>
                  </tr>
                  <tr>
                    <td style="padding: 2px 10px; font-family:Arial, Helvetica, sans-serif; font-size:15px; line-height:20px; color: #222222; font-weight: bold;">Discount</td>
                   
                    <td align="right" style="padding: 2px 10px; font-family:Arial, Helvetica, sans-serif; font-size:15px; line-height:20px; color: #222222; font-weight: bold;">$10.00</td>
                  </tr>
                  <tr>
                    <td style="padding: 2px 10px; font-family:Arial, Helvetica, sans-serif; font-size:18px; line-height:20px; color: #222222; font-weight: bold;">Total</td>
                   
                    <td align="right" style="padding: 2px 10px; font-family:Arial, Helvetica, sans-serif; font-size:18px; line-height:20px; color: #222222; font-weight: bold;">$30.00</td>
                  </tr>
                  
                </table>
                
                </td>
                </tr>
                <tr>
                <td style="padding:20px 0; "><table border="0" cellspacing="0" cellpadding="0" width="100%" style="border-collapse:collapse; mso-table-lspace:0pt; mso-table-rspace:0pt;" class="contenttable">
                  <tr>
                    <td style="padding: 2px 10px; font-family:Arial, Helvetica, sans-serif; font-size:13px; line-height:20px; color: #222222; font-weight: bold;">Refer a friend to recieve a discount you can both enjoy</td>
                  </tr>
                  <tr>
                    <td style="padding: 2px 10px 10px; font-family:Arial, Helvetica, sans-serif; font-size:13px; line-height:20px; color: #999; ">Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud <span style="color: green; font-weight: bold;">exercitation</span></td>
                  </tr>
                  <tr>
                    <td align="center"> <a href="#"><img src="images/share.png" alt=""></a> </td>
                  </tr>
                  
                </table>
                
                </td>
                </tr>
                
               
                </table></td>
          </tr>
          <tr>
                 <td class="footer" style="padding: 20px 20px 10px; text-align: center; background-color: #333333;"><table border="0" cellspacing="0" cellpadding="0" width="100%" style="border-collapse:collapse; mso-table-lspace:0pt; mso-table-rspace:0pt;" class="contenttable">
                  <tr>
                    <td style="padding:10px; font-family:Arial, Helvetica, sans-serif; font-size:13px; line-height:20px; color: #222222;"><table align="center" border="0" cellspacing="0" cellpadding="0" style="border-collapse:collapse; mso-table-lspace:0pt; mso-table-rspace:0pt;" class="contenttable">
                    <tr>
                      <td style="padding: 5px;"> <a href="https://www.facebook.com/spotlexinfo"><img src="<?php echo 'http://3.11.134.243/images/image/facebook.png';?>" alt=""></a> </td>
                      <td style="padding: 5px;"> <a href="https://twitter.com/spotlexInfo"><img src="<?php echo 'http://3.11.134.243/images/image/twitter.png';?>" alt=""></a> </td>
                      <td style="padding: 5px;"> <a href="https://www.instagram.com/spotlexpics"><img src="<?php echo 'http://3.11.134.243/images/image/instagram.png';?>" alt=""></a> </td>
                      <td style="padding: 5px;"> <a href="#"><img src="<?php echo 'http://3.11.134.243/images/image/link-icon.png';?>" alt=""></a> </td>
                    </tr>
                    </table></td>
                  </tr>
                  <tr>
                    <td style="padding: 2px 10px 10px; font-family:Arial, Helvetica, sans-serif; font-size:12px; line-height:20px; color: #fff;">Copyright 2019 Sptlex, All rights reserved. </br>You are recieving this email because you are a registered customer.</td>
                  </tr>
                 
                </table></td>
                </tr>
        </tbody>
      </table></td>
    </tr>
  </tbody>
</table>

</body>
</html>
