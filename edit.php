<?php 
		require_once('init.php');
		$edit = new edit_form;
		$edit->update_employee();
		$edit->print_form();
?>