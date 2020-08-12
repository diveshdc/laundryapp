<!DOCTYPE html>
<html>
	<head>
		<title>Email Of login credentials<title>
	</head>
	<body>
		<p>Hi,</p>
		<p></p>
		<p>Below is the login credentials of <b><?php echo $name; ?></b></p>
		<p></p>
		<p></p>
		<table border="1" style="border: 1px solid black;">
			 <tbody>
                <tr>
                    <th>
                     Email  
                    </th>
                    <td>
                        <?php echo $email;?>
                    </td>
                </tr>
                <tr>
                    <th>
                       Password
                    </th>
                    <td>
                    	<?php echo $password;?>
                    </td>
                </tr>
            </tbody>
		<p>This email was sent from Spotlex</p>
	</body>
</html>