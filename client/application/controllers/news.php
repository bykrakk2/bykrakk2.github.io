<?php
class news extends FE_Controller {
	function __Construct() {
        parent::__construct();
    }
	public function index($id=NULL)
	{
		
       $this->data['subview'] = 'news';
	   $this->data['title'] = 'Новости';
		$this->load->view('main_layout',$this->data);
		
	}
	
}
?>