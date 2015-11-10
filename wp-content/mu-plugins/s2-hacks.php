<?php
add_filter("ws_plugin__s2member_login_redirect", "my_custom_login_redirect", 10, 2);
function my_custom_login_redirect($redirect, $vars = array())
	{
		// If you want s2Member to perform the redirect, return true.
		// return true;
		
		// Or, if you do NOT want s2Member to perform the redirect, return false.
		// return false;
		
		// Or, if you want s2Member to redirect, but to a custom URL, return that URL.
		return '/my-account';
		
		// Or, just return what s2Member already says about the matter.
		// return $redirect;
	}
?>
