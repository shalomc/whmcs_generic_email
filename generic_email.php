<?php
function generic_email_config(){
 $configarray = array(
        "name" => "Generic email for tickets",
        "description" => "Assign tickets to customers based on email domains",
        "version" => "1.0",
        "author" => "Shalom Carmel",
    );
    return $configarray;
}
function generic_email_activate() {
	
	
  $query = "CREATE TABLE IF NOT EXISTS mod_generic_email(
			id INT( 10 ) NOT NULL AUTO_INCREMENT ,
			email_domain varchar(128)  NOT NULL ,
			customerid INT( 10 )  NOT NULL  ,
			PRIMARY KEY ( id ) 
			) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;";
	$result = mysql_query($query);
	   
    return array('status' => 'success', 'description' => 'Activation successful.');
    return array('status' => 'error', 'description' => 'Error in Activation');
    return array('status' => 'info', 'description' => 'Todolist');
}
function generic_email_deactivate() {
}
function generic_email_output($vars){
	 $modulelink = $vars['modulelink'];
	 
	$edit_url=$modulelink.'&action=edit';
	$list_url=$modulelink.'&action=list';
	$delete_url=$modulelink.'&action=delete';
	$new_url= $modulelink.'&action=new';

	$generic_email_table_name="mod_generic_email";
	$adminuser=$_SESSION['adminid']; 
//	$adminuser="your-api-user"; 
	 switch ($_GET["action"]) {
			case "list": 
				include("list.php");
				break;

			case "edit": 
				include("edit.php");
				break;

			case "delete": 
				include("delete.php");
				break;

			case "new": 
				include("new.php");
				break;

			default: 
				include("list.php");
				break;
	}

}


function curPageURL() {
 $pageURL = 'http';
 if ($_SERVER["HTTPS"] == "on") {$pageURL .= "s";}
 $pageURL .= "://";
 if ($_SERVER["SERVER_PORT"] != "80") {
  $pageURL .= $_SERVER["SERVER_NAME"].":".$_SERVER["SERVER_PORT"].$_SERVER["REQUEST_URI"];
 } else {
  $pageURL .= $_SERVER["SERVER_NAME"].$_SERVER["REQUEST_URI"];
 }
 return $pageURL;
}

?>

