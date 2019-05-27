<?php
class gifts_model extends MY_Model {
	protected $table_name = 'gifts';
	protected $order_by = 'id';
	protected $timestamps = FALSE;
	public $rules = array(
	'title' => array('field' => 'title', 'label' => 'Название', 'rules' => 'trim|required|max_length[100]|xss_clean'),
	'descr' => array('field' => 'descr', 'label' => 'Категория', 'rules' => 'trim|integer'),
	'vk_group' => array('field' => 'vk_group', 'label' => 'На главной', 'rules' => 'trim|integer|valid_url'),
	'photo' => array('field' => 'photo', 'label' => 'Описание', 'rules' => 'trim|required|valid_url'),
	'time' => array('field' => 'time', 'label' => 'Иконка (URL)', 'rules' => 'trim|required'),
	'status' => array('field' => 'status', 'label' => 'Иконка (URL)', 'rules' => 'trim|required|integer'),
	);
	
	public function get_new() {
		$gifts = new stdClass();
		$gifts->title = '';
		$gifts->descr = '';
		$gifts->vk_group = '';
        $gifts->photo = '';
		$gifts->time = '';
        $gifts->status = '1';
		return $gifts;
	}

}
?>