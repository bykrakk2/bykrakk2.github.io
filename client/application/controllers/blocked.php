<?php
class blocked extends FE_Controller {
	function __Construct() {
        parent::__construct();
	 }
	public function index()
	{
		
		$this->load->view('blocked');
	}
}
?>