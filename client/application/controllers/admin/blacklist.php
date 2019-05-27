<?php
class blacklist extends Admin_Controller {
	function __Construct() {
        parent::__construct();
		$this->load->model('blacklist_model');
        if (in_array($this->session->userdata('group'), array("3"))) {
            show_404(); exit;
        }
    }
	public function index()
	{
	$this->data['ips'] = $this->blacklist_model->get();
	$this->data['subview'] = 'admin/blacklist/index';
	$this->load->view('admin/layout_main',$this->data);
	}
	public function edit($id=NULL)
	{
		if($id) {
			$this->data['ip'] = $this->blacklist_model->get($id);
			count($this->data['ip']) || $this->data['errors'][] = 'Страница не найдена';
		}
		else {
			$this->data['ip'] = $this->blacklist_model->get_new();
		}
		$rules = $this->blacklist_model->rules;
		$this->form_validation->set_rules($rules);
		
		if($this->form_validation->run() == TRUE) {
			$data = $this->blacklist_model->array_from_post(array('ip'));
			$this->blacklist_model->save($data,$id);
			redirect('admin/blacklist');
		}
		
		
		$this->data['subview'] = 'admin/blacklist/edit';
		$this->load->view('admin/layout_main',$this->data);
	}

	public function delete($id) {
		$this->blacklist_model->delete($id);
		redirect('admin/blacklist');
	}
		
}              
?>