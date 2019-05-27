<?php
class project_model extends MY_Model {
	protected $table_name = 'sites';
	protected $order_by = 'id';
	protected $timestamps = FALSE;
	public $rules = array(
	'domain' => array('field' => 'domain', 'label' => 'Название', 'rules' => 'trim|required|max_length[100]|xss_clean'),
	'email' => array('field' => 'email', 'label' => 'Баннер (URL)', 'rules' => 'trim|required|valid_url|xss_clean'),
	'user_id' => array('field' => 'user_id', 'label' => 'Пользователь', 'rules' => 'trim|required|xss_clean'),
	'password' => array('field' => 'password', 'label' => 'Полное описание', 'rules' => 'trim|required|xss_clean'),
	);
	
	public function get_new() {
		$project = new stdClass();
		$project->domain = '';
		$project->email = '';
		$project->user_id = '';
		$project->password = '';
		return $project;
	}
	public function get_nested() {
		$table = $this->db->get('sites')->result();
		if(count($table))
		{
		foreach($table as $key=>$project) {
			$ret[] = array(
			'domain' => $project->domain,
			'email' => $project->email,
			'user_id' => $project->user_id,
			'password' => $project->password,
			);
		}
		}
		else
		{
			$ret = 'Магазины отсутствуют!';
		}
		return $ret;
	}
}
?>