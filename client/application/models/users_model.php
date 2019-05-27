<?php
class users_model extends MY_Model {
	protected $table_name = 'users';
	protected $order_by = 'id';
	protected $timestamps = FALSE;
	public $rules = array(
	'email' => array('field' => 'email', 'label' => 'Email', 'rules' => 'trim|required'),
	'password' => array('field' => 'password', 'label' => 'Пароль', 'rules' => 'trim'),
	'group' => array('field' => 'group', 'label' => 'Группа', 'rules' => 'trim|required'),
	);
	
	public function get_new() {
		$users = new stdClass();
		$users->email = '';
		$users->password = '';
        $users->group = '1';
		return $users;
	}

}
?>