<?php
class kupon_model extends MY_Model {
	protected $table_name = 'kupons';
	protected $order_by = 'order';
	public $rules = array(
	'kupon_name' => array('field' => 'kupon_name', 'label' => 'Coupon name', 'rules' => 'trim|required|max_length[100]|xss_clean'),
	'percentage' => array('field' => 'percentage', 'label' => 'Coupon %', 'rules' => 'trim|required'),
	'pago' => array('field' => 'pago', 'label' => 'Number of Uses', 'rules' => 'trim|required'),
	'goods' => array('field' => 'goods', 'label' => 'ID goods', 'rules' => 'trim|required'),
	);
	
	public function get_new() {
		$kupon = new stdClass();
		$kupon->kupon_name = '';
		$kupon->percentage = '';
	    $kupon->goods = '';
		$kupon->pago = '';
		return $kupon;
	}
	public function get_nested() {
		$table = $this->db->get('kupons')->result();
		if(count($table))
		{
		foreach($table as $key=>$item) {
			$ret[] = array(
			'kupon_name' => $item->kupon_name,
			'percentage' => $item->percentage,
			'goods' => $item->goods,
			'pago' => $item->pago,
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