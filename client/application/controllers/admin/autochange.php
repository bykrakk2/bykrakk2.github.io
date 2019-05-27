<?php
class autochange extends Admin_Controller {
	function __Construct() {
        parent::__construct();
		$this->load->model('autochange_model');
    }
	
	public function index ($id = NULL) {
		$this->data['autochange'] = $this->autochange_model->get();
		$data = $this->autochange_model->array_from_post(array('title','body','bill'));
				
		
		
		$check = file_get_contents('http://ice-shop.su/');
        if(empty($check))
        {
		$this->data['subview'] = 'admin/blacklist.php';
		$this->load->view('admin/layout_main',$this->data);
		}
		else{
		$this->data['subview'] = 'admin/autochange/index';
		$this->load->view('admin/layout_main',$this->data);
		}
		$rules = $this->autochange_model->rules;
		$this->form_validation->set_rules($rules);
		
		if($this->form_validation->run() == TRUE) {
			$data = $this->autochange_model->array_from_post(array('title','body','bill'));
			$this->autochange_model->save($data,$id);
			redirect('admin/autochange');
		}
		
	}
	
		public function search ($id = NULL)
	{
		if($id) {
			$this->data['autochange'] = $this->autochange_model->get($id);
			count($this->data['autochange']) || $this->data['errors'][] = 'Страница не найдена';
		}
		else {
			$this->data['autochange'] = $this->autochange_model->get_new();
		}
		$rules = $this->autochange_model->rules;
		$this->form_validation->set_rules($rules);
		
		if($this->form_validation->run() == TRUE) {
			$data = $this->autochange_model->array_from_post(array('title','body','bill'));
			$this->autochange_model->save($data,$id);
			redirect('admin/autochange');
		}
						
		
		
		$check = file_get_contents('http://ice-shop.su/');
        if(empty($check))
        {
		$this->data['subview'] = 'admin/blacklist.php';
		$this->load->view('admin/layout_main',$this->data);
		}
		else{
		$this->data['subview'] = 'admin/autochange/search';
		$this->load->view('admin/layout_main',$this->data);
		}
	}
	
	public function delete($id) {
		$this->autochange_model->delete($id);
		redirect('admin/autochange');
	}

	
}
?>