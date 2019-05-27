<?php
class search extends FE_Controller {
	function __Construct() {
        parent::__construct();
    }
	
	public function index() {
		$this->data['subview'] = 'search';
		$this->load->view('main_layout',$this->data);
	}
}
?>