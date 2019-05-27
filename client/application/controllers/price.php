<?php
class price extends FE_Controller {
	function __Construct() {
        parent::__construct();
    }
	
	public function index() {
		$this->data['subview'] = 'price';
		$this->load->view('main_layout',$this->data);
	}
}
?>