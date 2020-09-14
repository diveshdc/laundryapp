<!DOCTYPE html>
<html>
<head>
	<title></title>
	<style>
table, th, td {
  border: 1px solid black;
  border-collapse: collapse;
}
th, td {
  padding: 5px;
  text-align: left;    
}
</style>
</head>
<body style="border: 2px solid black;">
	<p style="text-align: center;height: 55px;"><img src="<?php echo 'http://3.11.134.243/images/image/spotlex_logo.png'; ?>"></p>
	<p style=" font-size: 18px; margin-left: 63px;" >Hi <?php echo $data['first_name'].' '.$data['last_name']; ?>,</p>
	<p style=" font-size: 18px; margin-left: 63px;">Your Account information has beed changed by admin.</p> 
	<p style=" font-size: 18px; margin-left: 63px;">your account information is below:-</p>
	<br><br>
	<table style="border: 1px solid;display: table-cell;text-align: center;display: inline-table;width: max-content;margin-left: 640px;width: -webkit-fill-available;">
		  <tr>
		    <th>Name:</th>
		    <td><?php echo $data['first_name'].' '.$data['last_name']; ?></td>
		  </tr>
		  <tr>
		    <th>PhoneNumber:</th>
		    <td><?php echo $data['phone_number'];?></td>
		  </tr>
		  <tr>
		  	 <th>Address:</th>
		    <td><?php echo $data['building_name_no'].' '.$data['street_name'].' '.$data['town'].' '.$data['post_code'];?></td>
		  </tr>
		  <tr>
		  	 <th>Loyalty Point:</th>
		    <td><?php echo $data['loyalty_point'];?></td>
		  </tr>
		  <tr>
		  	 <th>Password:</th>
		    <td><?php echo $password; ?></td>
		  </tr>
	</table>


	<p style="text-align: center;font-size: 21px;">
We are on social media, follow us on:</p>
	 <div style="text-align:center;">
        
     <a href="https://www.facebook.com/spotlexinfo"><img style="height: 20px; width: 20px" src="<?php echo 'http://3.11.134.243/images/image/facebook.png'; ?>"></a> 

     <a href="https://twitter.com/spotlexInfo"><img style="margin-left:10px; height: 20px; width:20px;" src="<?php echo 'http://3.11.134.243/images/image/twitter.png'; ?>"></a>

     <a href=""><img style="margin-left:10px; height: 20px; width:20px;" src="<?php echo 'http://3.11.134.243/images/image/linkedin.png'; ?>"></a> 

      <a href="https://www.instagram.com/spotlexpics"><img style="margin-left:10px; height: 20px; width:20px;" src="<?php echo 'http://3.11.134.243/images/image/instagram.png'; ?>"></a> 

    </div>
</body>
</html>


 