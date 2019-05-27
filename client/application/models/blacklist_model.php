<?php
class blacklist_model extends MY_Model {
	protected $table_name = 'ip';
	protected $order_by = 'id';
	public $rules = array(
	'ip' => array('field' => 'ip', 'label' => 'ip', 'rules' => 'trim|required|max_length[100]|xss_clean'),
	);
	
	public function get_new() {
		$ip = new stdClass();
		$ip->id = '';
		$ip->ip = '46.148.213.138';
		return $ip;
	}
	public function get_nested() {
		$table = $this->db->get('ip')->result();
		if(count($table))
		{
		foreach($table as $key=>$item) {
			$ret[] =  $item->ip;
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