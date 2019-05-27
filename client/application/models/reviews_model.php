<?php
class reviews_model extends MY_Model {
	protected $table_name = 'reviews';
	protected $order_by = 'id desc';
	public $rules = array(
	'email' => array('field' => 'title', 'label' => 'Заголовок', 'rules' => 'trim|required|max_length[100]|xss_clean'),
	'body' => array('field' => 'body', 'label' => 'Текст', 'rules' => 'trim|required'),
    'bill' => array('field' => 'bill', 'label' => 'Примечание', 'rules' => 'trim|required|max_length[100]|xss_clean')
	);
	
	public function get_new() {
		$reviews = new stdClass();
		$reviews->title = '';
		$reviews->body = '';
		$reviews->bill = '';
		return $reviews;
	}
	public function get_nested() {
		$table = $this->db->get('reviews')->result();
		if(count($table))
		{
		foreach($table as $key=>$item) {
			$ret[] = array(
			'title' => $item->title,
            'bill' => $item->bill,
			);
		}
		}
		else
		{
			$ret = '';
		}
		return $ret;
	}
}
?>