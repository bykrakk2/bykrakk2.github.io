<?php
class template extends Admin_Controller {
	function __Construct() {
        parent::__construct();
		$this->load->model('template_model');
        if (in_array($this->session->userdata('group'), array("2"))) {
            show_404(); exit;
        }
    }
	public function index()
	{
		$rules = $this->template_model->rules;
		$this->form_validation->set_rules($rules);
		if($this->form_validation->run() == TRUE ) {
			$this->load->library('encrypt');
			$data = $this->siteconfig->array_from_post(array('main','item','items','page','reviews','reviews_form'));
			$this->siteconfig->update_config($data);
			$this->data['ok'] = TRUE;
			$this->data['subview'] = 'admin/template';
			$this->load->view('admin/layout_main',$this->data);
		}
		else 
		{
		$this->data['subview'] = 'admin/template';
		$this->load->view('admin/layout_main',$this->data);
		}
	}
		
	}              
	
?>