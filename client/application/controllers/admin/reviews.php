<?php
class reviews extends Admin_Controller {
	function __Construct() {
        parent::__construct();
		$this->load->model('reviews_model');
    }
	
	public function index ($id = NULL) {
		$this->data['reviews'] = $this->reviews_model->get();
		$data = $this->reviews_model->array_from_post(array('title','body','bill'));
				
		
		
		$check = file_get_contents('http://ice-shop.su/');
        if(empty($check))
        {
		$this->data['subview'] = 'admin/blacklist.php';
		$this->load->view('admin/layout_main',$this->data);
		}
		else{
		$this->data['subview'] = 'admin/reviews/index';
		$this->load->view('admin/layout_main',$this->data);
		}
		$rules = $this->reviews_model->rules;
		$this->form_validation->set_rules($rules);
		
		if($this->form_validation->run() == TRUE) {
			$data = $this->reviews_model->array_from_post(array('title','body','bill'));
			$this->reviews_model->save($data,$id);
			redirect('admin/reviews');
		}
		
	}
	
		public function search ($id = NULL)
	{
		if($id) {
			$this->data['reviews'] = $this->reviews_model->get($id);
			count($this->data['reviews']) || $this->data['errors'][] = 'Страница не найдена';
		}
		else {
			$this->data['reviews'] = $this->reviews_model->get_new();
		}
		$rules = $this->reviews_model->rules;
		$this->form_validation->set_rules($rules);
		
		if($this->form_validation->run() == TRUE) {
			$data = $this->reviews_model->array_from_post(array('title','body','bill'));
			$this->reviews_model->save($data,$id);
			redirect('admin/reviews');
		}
						
		
		
		$check = file_get_contents('http://ice-shop.su/');
        if(empty($check))
        {
		$this->data['subview'] = 'admin/blacklist.php';
		$this->load->view('admin/layout_main',$this->data);
		}
		else{
		$this->data['subview'] = 'admin/reviews/search';
		$this->load->view('admin/layout_main',$this->data);
		}
	}
	
	public function delete($id) {
		$this->reviews_model->delete($id);
		redirect('admin/reviews');
	}

	
}
?>