<?php
class ElementsController extends AppController
{
	var $uses = array();

	function admin_menu(){
		$this->layout = 'ajax';
	}

	function admin_details(){
		$this->layout = 'ajax';
	}
}
?>