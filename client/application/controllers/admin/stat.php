<?php
class stat extends Admin_Controller {
	function __Construct() {
        parent::__construct();
		$this->load->model('sitestat');
    }
	public function index()
	{

		$this->data['subview'] = 'admin/stat';
		$this->load->view('admin/layout_main',$this->data);
	
		
	}
	}              
?>