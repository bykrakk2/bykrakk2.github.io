<?php
class profile extends FE_Controller {
	function __Construct() {
        parent::__construct();
    }
	
	public function index() {
		$this->data['subview'] = 'profile';
		$this->load->view('main_layout',$this->data);
	}
}
?>