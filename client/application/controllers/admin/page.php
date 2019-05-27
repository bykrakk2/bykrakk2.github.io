<?php
class page extends Admin_Controller {
	function __Construct() {
        parent::__construct();
		$this->load->model('page_model');
        if (in_array($this->session->userdata('group'), array("3"))) {
            show_404(); exit;
        }
    }
	
	public function index () {
		$this->data['pages'] = $this->page_model->get();
		
		$this->data['subview'] = 'admin/page/index';
		$this->load->view('admin/layout_main',$this->data);
	}
	
	public function edit ($id = NULL)
	{
		if($id) {
			$this->data['page'] = $this->page_model->get($id);
			count($this->data['page']) || $this->data['errors'][] = '—траница не найдена';
		}
		else {
			$this->data['page'] = $this->page_model->get_new();
		}
		$rules = $this->page_model->rules;
		$this->form_validation->set_rules($rules);
		
		if($this->form_validation->run() == TRUE) {
			$data = $this->page_model->array_from_post(array('title','slug','body','loader','tpl'));
			if (empty($data['loader'])) { $data['loader'] = 0; } else { $data['loader'] = 1;}
			$this->page_model->save($data,$id);
			redirect('admin/page');
		}
		
		$this->data['subview'] = 'admin/page/edit';
		$this->load->view('admin/layout_main',$this->data);
	}
	
	public function delete($id) {
		$this->page_model->delete($id);
		redirect('admin/page');
	}
	
	public function _unique_slug($str) {
		$id = $this->uri->segment(4);
		$this->db->where('slug',$this->input->post('slug'));
		!$id || $this->db->where('id !=',$id);
		$page = $this->page_model->get();
		
		if(count($page)) {
			$this->form_validation->set_message('_unique_slug','%s должен быть уникальным');
			return FALSE;
		}
		return TRUE;
	}
}
?>