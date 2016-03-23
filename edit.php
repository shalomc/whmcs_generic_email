<?php

if (isset($_GET['id']) ) { 
$id = (int) $_GET['id']; 


	if (isset($_POST['submitted'])) { 
		foreach($_POST AS $key => $value) { $_POST[$key] = mysql_real_escape_string($value); } 
		$email_domain = $_POST['email_domain'];
		$customerid = $_POST['customerid'];
		$update = array(
			"email_domain"=>$email_domain ,
			"customerid"=>$customerid ,
			);
		$where = array("id"=>$id);

		update_query($generic_email_table_name,$update,$where);
		$command = "logactivity";
		$responsetype = "json";  // Probably unnecessary
		$api_input["description"] = "Modified generic email ${id}: $email_domain => Customer id: $customerid";
		$api_input["responsetype"] = $responsetype ; 
		$results = localAPI($command,$api_input,$adminuser);

		echo (mysql_affected_rows()) ? "<strong>Edited row.</strong><br />" : "<strong>Nothing changed.</strong> <br />"; 
		echo "<a href='".$list_url."'>Back To Listing</a><p/>"; 
		echo "<script>window.location.href='".$list_url."';</script>"; 
	} 
	$fields = "id,email_domain,customerid";
	$where = array("id"=>$id);
	$result = select_query($generic_email_table_name,$fields,$where);
	$row = mysql_fetch_array ( $result ); 

	echo "<form action='' method='POST'> ";
	echo "<p><b>email_domain:</b><br /><input type='text' name='email_domain' value='". $row['email_domain']."' /> ";
	echo "<p><b>Customerid:</b><br /><input type='text' name='customerid' value='" . $row['customerid'] . "' /> ";
	echo "<p><input type='submit' value='Edit Row' /><input type='hidden' value='1' name='submitted' /> ";
	echo "</form> "; 
 } 
 
 ?> 
