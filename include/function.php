<?php
	session_start();
	function get_param($param_name){
		$param_value = "";
		if(isset($_POST[$param_name]))
			$param_value = $_POST[$param_name];
		else if(isset($_GET[$param_name]))
			$param_value = $_GET[$param_name];
		return trim($param_value);
	}
	function location($url){
		echo '<script type="text/javascript">window.location = "'. $url . '";</script>';
	}
?>