<?php
class kupon extends Admin_Controller {
	function __Construct() {
        parent::__construct();
		$this->load->model('kupon_model');
        if (in_array($this->session->userdata('group'), array("3"))) {
            show_404(); exit;
        }
    }
	
	public function index () {
		$this->data['kupons'] = $this->kupon_model->get();
		
		$this->data['subview'] = 'admin/kupon/index';
		$this->load->view('admin/layout_main',$this->data);
	}
	
	public function edit ($id = NULL)
	{
		if($id) {
			$this->data['kupon'] = $this->kupon_model->get($id);
			count($this->data['kupon']) || $this->data['errors'][] = 'Страница не найдена';
		}
		else {
			$this->data['kupon'] = $this->kupon_model->get_new();
		}
		$rules = $this->kupon_model->rules;
		$this->form_validation->set_rules($rules);
		
		if($this->form_validation->run() == TRUE) {
			$data = $this->kupon_model->array_from_post(array('kupon_name','percentage','pago','goods'));
			$this->kupon_model->save($data,$id);
			redirect('admin/kupon');
		}
		
		$this->data['subview'] = 'admin/kupon/edit';
		$this->load->view('admin/layout_main',$this->data);
	}
	
	public function edit_more ($id = NULL)
	{
		if($id) {
			$this->data['kupon'] = $this->kupon_model->get($id);
			count($this->data['kupon']) || $this->data['errors'][] = 'Страница не найдена';
		}
		else {
			$this->data['kupon'] = $this->kupon_model->get_new();
		}
		$rules = $this->kupon_model->rules;
		$this->form_validation->set_rules($rules);
		
		if($this->form_validation->run() == TRUE) {
			$data = $this->kupon_model->array_from_post(array('kupon_name','percentage','pago','goods'));
			$this->kupon_model->save($data,$id);
			redirect('admin/kupon');
		}
		
		$this->data['subview'] = 'admin/kupon/edit_more';
		$this->load->view('admin/layout_main',$this->data);
	}
	
	public function delete($id) {
		$this->kupon_model->delete($id);
		redirect('admin/kupon');
	}
	
	public function _unique_slug($str) {
		$id = $this->uri->segment(4);
		$this->db->where('slug',$this->input->post('slug'));
		!$id || $this->db->where('id !=',$id);
		$kupon = $this->kupon_model->get();
		
		if(count($kupon)) {
			$this->form_validation->set_message('_unique_slug','%s должен быть уникальным');
			return FALSE;
		}
		return TRUE;
	}
}
?>