<?php
class gifts extends Admin_Controller {
	function __Construct() {
        parent::__construct();
		$this->load->model('gifts_model');
        if (in_array($this->session->userdata('group'), array("3"))) {
            show_404(); exit;
        }
    }
	
	public function index () {
		$this->data['gifts'] = $this->gifts_model->get();
		$this->data['subview'] = 'admin/gifts/index';
		$this->load->view('admin/layout_main',$this->data);
	}
	
	public function edit ($id = NULL)
	{
		if($id) {
			$this->data['gift'] = $this->gifts_model->get($id);
			count($this->data['gift']) || $this->data['errors'][] = 'Страница не найдена';
		}
		else {
			$this->data['gift'] = $this->gifts_model->get_new();
		}
		$rules = $this->gifts_model->rules;
		$this->form_validation->set_rules($rules);
		
		if($this->form_validation->run() == TRUE) {
			$data = $this->gifts_model->array_from_post(array('title','descr','photo','vk_group','time'));
			$this->gifts_model->save($data,$id);
			redirect('admin/gifts');
		}
		
		$this->data['subview'] = 'admin/gifts/edit';
		$this->load->view('admin/layout_main',$this->data);
	}
	
	public function delete($id) {
		$this->gifts_model->delete($id);
		redirect('admin/gifts');
	}
	

}
?>