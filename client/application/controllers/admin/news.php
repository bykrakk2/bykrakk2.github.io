<?php
class news extends Admin_Controller {
	function __Construct() {
        parent::__construct();
		$this->load->model('news_model');
    }
	
	public function index () {
		$this->data['news'] = $this->news_model->get();
		
		$this->data['subview'] = 'admin/news/index';
		$this->load->view('admin/layout_main',$this->data);
	}
	
	public function edit ($id = NULL)
	{
		if($id) {
			$this->data['news'] = $this->news_model->get($id);
			count($this->data['news']) || $this->data['errors'][] = 'Страница не найдена';
		}
		else {
			$this->data['news'] = $this->news_model->get_new();
		}
		$rules = $this->news_model->rules;
		$this->form_validation->set_rules($rules);
		
		if($this->form_validation->run() == TRUE) {
			$data = $this->news_model->array_from_post(array('name','date','time','text'));
			$this->news_model->save($data,$id);
			redirect('admin/news');
		}
		
		$this->data['subview'] = 'admin/news/edit';
		$this->load->view('admin/layout_main',$this->data);
	}
	
	
	
	public function delete($id) {
		$this->news_model->delete($id);
		redirect('admin/news');
	}
	
	public function _unique_slug($str) {
		$id = $this->uri->segment(4);
		$this->db->where('slug',$this->input->post('slug'));
		!$id || $this->db->where('id !=',$id);
		$news = $this->news_model->get();
		
		if(count($news)) {
			$this->form_validation->set_message('_unique_slug','%s должен быть уникальным');
			return FALSE;
		}
		return TRUE;
	}
}
?>