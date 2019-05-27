<?php
class sitesecurity extends MY_Model {
	public $rules = array(
		'old_password' => array('field' => 'old_password', 'label' => 'Tекущий пароль', 'rules' => 'callback_check_user_pass|trim|required'),
    'password' => array(
      'field' => 'password', 
      'label' => 'Password', 
      'rules' => 'trim|required|matches[password1]'
    ),
    'password1' => array(
      'field' => 'password1', 
      'label' => 'Confirm password', 
      'rules' => 'trim|required|matches[password]'
    ),
	);
 public function __construct()
 {
  parent::__construct();
 }
 public function get_all()
 {
  return $this->db->get();
 }
 public function update_config($data)
 {
  $success = '0';
  foreach($data as $key=>$value)
  {
   if(!$this->save($key,$value))
   {
    $success='1';
    break;  
   }
  }
  return $success;
 }
 public function save($key,$value)
 {
  $config_data=array(
    'key'=>$key,
    'value'=>$value
    );
  $this->db->where('key', $key);
  return $this->db->update('config_data',$config_data); 
 }
}
?>