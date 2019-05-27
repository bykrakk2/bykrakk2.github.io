<?php
class categories_model extends MY_Model {
	protected $table_name = 'categories';
	protected $order_by = 'sort asc';
	protected $timestamps = FALSE;
	public $rules = 
	array(
		'title' => array(
				'field' => 'title', 
				'label' => 'Название', 
				'rules' => 'trim|required|max_length[100]|xss_clean'
						),
		'slug' => array(
				'field' => 'slug', 
				'label' => 'Urls', 
				'rules' => 'trim|required|max_length[100]|xss_clean|valid_url'
				),
		'sort' => array(
				'field' => 'sort', 
				'label' => '', 
				'rules' => 'trim|integer'
				),
	);
	
	public function get_new() {
		$categories = new stdClass();
		$categories->title = '';
		$categories->slug = '';
		$categories->show = '1';
		$categories->sort = '0';
		$categories->icon = '<img style="width: 16px; height: 16px;" src="свою картинку" alt="">';
		return $categories;
	}

}
?>