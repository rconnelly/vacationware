<?php

// Show admin panel after activated
if (is_admin() && isset($_GET['activated'] ) && $pagenow == "themes.php" ) {

	//Do redirect
	header( 'Location: '.admin_url().'themes.php?page=admin-options.php' ) ;
	
}

?>