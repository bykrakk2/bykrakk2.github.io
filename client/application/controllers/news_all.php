<?php
class news_all extends FE_Controller {
	function __Construct() {
        parent::__construct();
				$this->load->model('news_model');
    }
	public function index()
	{
		
		$this->data['subview'] = 'news_all';
		$this->data['title'] = 'Новости';
		$this->load->view('main_layout',$this->data);
		
	}
		
	}              
	
?>