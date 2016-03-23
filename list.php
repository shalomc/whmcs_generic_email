<?php

 // Get customer details

 $responsetype = "json";  // Probably unnecessary
 $command = "getclientsdetails";
 $values["stats"] = false;
 $values["responsetype"] = $responsetype ;


echo "<table class='datatable' border='0' cellspacing='1' cellpadding='3' >"; 
echo "<tr>"; 
echo "<th><b>Id</b></th>"; 
echo "<th><b>email_domain</b></th>"; 
echo "<th><b>Customerid</b></th>"; 
echo "<th><b>Customer Name</b></th>"; 
echo "<th> </th>"; 
echo "<th> </th>"; 
echo "</tr>"; 

$fields = "id,email_domain,customerid";
$where = NULL; 
$result = select_query($generic_email_table_name,$fields,$where);

while($row = mysql_fetch_array($result)){ 
	foreach($row AS $key => $value) { $row[$key] = stripslashes($value); } 
	echo "<tr>";  
	echo "<td valign='top'>" . nl2br( $row['id']) . "</td>";  
	echo "<td valign='top'>" . nl2br( $row['email_domain']) . "</td>";  
	echo "<td valign='top'>" . nl2br( $row['customerid']) . "</td>";  
	$values["clientid"] = $row['customerid'];
	$getclientsdetails = localAPI($command,$values,$adminuser);
	echo "<td valign='top'>" . nl2br( $getclientsdetails['companyname']) . "</td>";  

	echo "<td valign='top'><a href='".$edit_url."&id={$row['id']}'><img src='images/edit.gif' width='16' height='16' border='0' alt='Edit'></a></td>";
	echo "<td><a href='".$delete_url."&id={$row['id']}'><img src='images/delete.gif' width='16' height='16' border='0' alt='Delete'></a></td> "; 
	echo "</tr>"; 
} 
echo "</table>"; 
echo "<a href='".$new_url."'>New Row</a>"; 
?>