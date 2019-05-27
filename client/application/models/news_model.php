<?php
class news_model extends MY_Model {
	protected $table_name = 'news';
	protected $order_by = 'id';
	public $rules = array(
	'name' => array('field' => 'name', 'label' => 'News Name', 'rules' => 'trim|required|max_length[100]|xss_clean'),
	'text' => array('field' => 'text', 'label' => 'News text', 'rules' => 'trim|required'),
	'date' => array('field' => 'date', 'label' => 'News text', 'rules' => 'trim|required'),
	'time' => array('field' => 'time', 'label' => 'News text', 'rules' => 'trim|required'),
	);
	
	public function get_new() {
		$new = new stdClass();
		$new->name = '';
		$new->text = '';
	    $new->date = '';
		$new->time = '';
		return $new;
	}
	public function get_nested() {
		$table = $this->db->get('news')->result();
		if(count($table))
		{
  	foreach($table as $key=>$item) {
			$ret[] = array(
			'name' => $item->name,
			'text' => $item->text,
			'date' => $item->date,
			'time' => $item->time,
			);
		}
		}
		else
		{
			$ret = 'Записи отсутствуют!';
		}
		return $ret;
	}
}
?>