<?php

if (isset($_POST['submitted'])) { 
	foreach($_POST AS $key => $value) { $_POST[$key] = mysql_real_escape_string($value); } 
	$email_domain = $_POST['email_domain'];
	$customerid = $_POST['customerid'];

	$values = array(
		"email_domain"=>$email_domain, 
		"customerid"=>$customerid
		);
	$newid = insert_query($generic_email_table_name,$values);
		$command = "logactivity";
		$responsetype = "json";  // Probably unnecessary
		$api_input["description"] = "Added generic email $email_domain => Customer id: $customerid";
		$api_input["responsetype"] = $responsetype ; 
		$results = localAPI($command,$api_input,$adminuser);

	echo "Added row.<br />"; 
	echo "<a href='".$list_url."'>Back To Listing</a><p/>"; 
	echo "<script>window.location.href='".$list_url."';</script>"; 
} 
?>

<form action='' method='POST'> 
<p><b>email_domain:</b><br /><input type='text' name='email_domain'/> 
<p><b>Customerid:</b><br /><input type='text' name='customerid'/> 
<p><input type='submit' value='Add Row' /><input type='hidden' value='1' name='submitted' /> 
</form> 
