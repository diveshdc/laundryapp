<!DOCTYPE html>
<html>
<head>
<title>Page Title</title>
</head>
<body style="border: 2px solid black;">
	<p style="text-align: center;height: 55px;"><img src="<?php echo 'http://3.11.134.243/images/image/spotlex_logo.png'; ?>"></p>
<p>Hello <?php echo $user['first_name'].' '.$user['last_name'];?>,</p> 
<p>A request has been received to change your password for your Spotlex account. If you really did, please click below to reset your password.'</p> <br>
<p style="text-align:center;"><a href="<?php echo 'http://3.11.134.243/find/'.$token; ?>" class="button button-primary" style="font-family:'-apple-system', BlinkMacSystemFont, 'Segoe UI', Roboto, Helvetica, Arial, sans-serif, 'Apple Color Emoji', 'Segoe UI Emoji', 'Segoe UI Symbol';color:#FFF;text-decoration:none;background-color:#3490DC;border-top:10px solid #3490DC;border-right:18px solid #3490DC;border-bottom:10px solid #3490DC;border-left:18px solid #3490DC;" rel="nofollow">Reset Password</a> </p><br>

<p>If you did not request a password reset, then safely ignore this email and your password will not change. Thanks</p>
<p>Kind regards</p>
<p>Spotlex help team</p>
<p>Email: info@spotlex.co.uk</p> 
<p style="text-align: center; font-size: 18px;">Follow us on social media for news and special offers.</p>
  <div style="text-align:center;">
     <a href="https://www.facebook.com/spotlexinfo"><img style="height: 20px; width: 20px" src="<?php echo 'http://3.11.134.243/images/image/facebook.png'; ?>"></a> 

     <a href="https://twitter.com/spotlexInfo"><img style="margin-left:10px; height: 20px; width:20px;" src="<?php echo 'http://3.11.134.243/images/image/twitter.png'; ?>"></a>

     <a href=""><img style="margin-left:10px; height: 20px; width:20px;" src="<?php echo 'http://3.11.134.243/images/image/linkedin.png'; ?>"></a> 

      <a href="https://www.instagram.com/spotlexpics"><img style="margin-left:10px; height: 20px; width:20px;" src="<?php echo 'http://3.11.134.243/images/image/instagram.png'; ?>"></a> 

    </div><br>
    <p>If you're having trouble clicking the "Reset Password" button, copy and paste the URL below into your web browser: <a href="<?php echo 'http://3.11.134.243/find/'.$token; ?>"><?php echo 'http://3.11.134.243/find/'.$token; ?></a></p>
</body>
</html> 