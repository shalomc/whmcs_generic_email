<?php

 function hook_generic_tickets($vars) {


 	// get and modify the ticket only if not assigned to any account
	if ( empty($vars["userid"])  ) {          
		$adminuser = "apiapi";
		$command = "getticket";		
		// imitialize API data structure
		$apivalues = array (
			"ticketid" => $vars["ticketid"],
			"responsetype" => "json"  // Probably unnecessary
			); 
		$getticket = localAPI($command,$apivalues,$adminuser);
		$email = strtolower( $getticket["email"] );
		$domain = array_pop(explode('@', $email));
		// check if email is in a generic domain on the domain map, and if yes, set the client according to map, and add email to cc

		$generic_email_table_name="mod_generic_email"; 
		$fields = "id,email_domain,customerid";
		$where = NULL; 
		$where = array("email_domain"=>$domain);
		$result = select_query($generic_email_table_name,$fields,$where);
		
		$domain_map_client = array (); 
			
		while($row = mysql_fetch_array($result)){ 
			$domain_map_client[$row['email_domain']] =  $row['customerid'];
		}
			
		if (array_key_exists($domain, $domain_map_client)) {
			// append email to cc
			$cc = ( empty($getticket["cc"]) ? $email : $getticket["cc"] . "," . $email ); 
			$command = "updateticket";		
			// imitialize API data structure
			$apivalues = array (
				"ticketid" => $vars["ticketid"],
				"responsetype" => "json",	// Probably unnecessary
				"userid" => $domain_map_client[$domain],
				"cc" => $cc
				); 
			$updateticket = localAPI($command,$apivalues,$adminuser);
		}
	}
}
  
 add_hook("TicketOpen",100,"hook_generic_tickets");
 add_hook("TicketOpenAdmin",100,"hook_generic_tickets");

