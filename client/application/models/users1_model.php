<?php
class users1_model extends MY_Model {
	protected $table_name = 'profiles';
	protected $order_by = 'id';
	public $rules = array(
	'mail' => array('field' => 'mail', 'label' => 'Заголовок', 'rules' => 'trim|required'),
	'password' => array('field' => 'password', 'label' => 'Альт. заголовок', 'rules' => 'trim'),
	'login' => array('field' => 'login', 'label' => 'Текст', 'rules' => 'trim|required'),
	'money' => array('field' => 'money', 'label' => 'Иконка', 'rules' => 'trim|required'),
	);
	
	public function get_new() {
		$page = new stdClass();
		$page->mail = '';
		$page->password = '';
		$page->login = '';
		$page->money = '0';
		return $page;
	}
	public function get_nested() {
		$table = $this->db->get('pages')->result();
		if(count($table))
		{
		foreach($table as $key=>$item) {
			$ret[] = array(
			'email' => $item->mail,
			'password' => $item->password,
			'login' => $item->login,
			'money' => $item->money,
			);
		}
		}
		else
		{
			$ret = 'Пользователи отсутствуют!';
		}
		return $ret;
	}
}
?>