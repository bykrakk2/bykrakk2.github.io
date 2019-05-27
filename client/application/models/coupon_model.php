<?php
class coupon_model extends MY_Model {
	protected $table_name = 'coupon';
	protected $order_by = 'id';
	public $rules = array(
	'coupon' => array('field' => 'coupon', 'label' => 'Купон', 'rules' => 'trim|required|max_length[100]|xss_clean'),
	'sum' => array('field' => 'sum', 'label' => 'Сумма', 'rules' => 'trim|required|max_length[100]'),
	'activate' => array('field' => 'activate', 'label' => 'activate', 'rules' => 'trim|required'),
	);
	
	public function get_new() {
		$coupon = new stdClass();
		$coupon->coupon = '';
		$coupon->sum = '';
		$coupon->activate = '';
		return $coupon;
	}
	public function get_nested() {
		$table = $this->db->get('coupon')->result();
		if(count($table))
		{
		foreach($table as $key=>$item) {
			$ret[] = array(
			'coupon' => $item->coupon,
			'sum' => $item->sum,
			'activate' => $item->activate,
			);
		}
		}
		else
		{
			$ret = 'Купоны отсутствуют!';
		}
		return $ret;
	}
}
?>