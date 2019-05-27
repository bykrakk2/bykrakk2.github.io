<?php
class categories extends Admin_Controller {
	function __Construct() {
        parent::__construct();
		$this->load->model('categories_model');
        if (in_array($this->session->userdata('group'), array("3"))) {
            show_404(); exit;
        }
    }
	
	public function index () {
		$items = $this->categories_model->get();

		$this->data['categories'] = $items;
		$this->data['subview'] = 'admin/categories/index';
		$this->load->view('admin/layout_main',$this->data);
	}
	
	public function edit ($id = NULL)
	{
		if($id) 
		{
			$this->data['categories'] = $this->categories_model->get($id);
			count($this->data['categories']) || $this->data['errors'][] = 'Страница не найдена';
		}
		else 
		{
			$this->data['categories'] = $this->categories_model->get_new();
		}
		$rules = $this->categories_model->rules;
		$this->form_validation->set_rules($rules);
		
		if($this->form_validation->run() == TRUE) 
		{
			$data = $this->categories_model->array_from_post(array('title','slug','icon','sort','show'));
			$this->categories_model->save($data,$id);
			redirect('admin/categories');
		}
		else
		{
			$this->data['error'] = validation_errors();
			$this->data['subview'] = 'admin/categories/edit';
			$this->load->view('admin/layout_main',$this->data);
		}
		
		
	}
	
	public function delete($id) {
		$this->categories_model->delete($id);
		redirect('admin/categories');
	}
	
	public function _unique_slug($str) {
		$id = $this->uri->segment(4);
		$this->db->where('slug',$this->input->post('slug'));
		!$id || $this->db->where('id !=',$id);
		$categories = $this->categories_model->get();
		
		if(count($categories)) {
			$this->form_validation->set_message('_unique_slug','%s должен быть уникальным');
			return FALSE;
		}
		return TRUE;
	}
	
	public function chg_order_ajax() {
		$items = $this->input->post('item');
		$total_items = count($this->input->post('item'));
		for($item = 0; $item < $total_items; $item++ )
		{
			$data = array(
				'id' => $items[$item],
				'rank' => $rank = $item
			);
			$this->db->where('id', $data['id']);
			$this->db->update('categories', $data);
		}  
	}
}
?>