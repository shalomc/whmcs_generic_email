<?php 

$id = (int) $_GET['id']; 
	$fields = "id,email_domain,customerid";
	$where = array("id"=>$id);
	$result = select_query($generic_email_table_name,$fields,$where);
	$row = mysql_fetch_array ( $result ); 
$email_domain=$row['email_domain'];
$customerid=$row['customerid'];

mysql_query("DELETE FROM ".$generic_email_table_name." WHERE id = '$id' ") ; 
echo (mysql_affected_rows() ? "Row deleted.<br /> " : "Nothing deleted.<br /> "); 
if (mysql_affected_rows()) 
		$command = "logactivity";
		$responsetype = "json";  // Probably unnecessary
		$api_input["description"] = "Deleted generic email ${id}: $email_domain => Customer id: $customerid";
		$api_input["responsetype"] = $responsetype ; 
		$results = localAPI($command,$api_input,$adminuser);
	

echo "<a href='".$list_url."'>Back To Listing</a>"; 
echo "<script>window.location.href='".$list_url."';</script>"; 

?> 