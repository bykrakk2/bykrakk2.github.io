<?php
class sitebloks extends MY_Model {
	public $rules = array(
		'stblok' => array('field' => 'stblok', 'label' => 'Случайные товары (Блок)', 'rules' => 'trim'),
		'mpblok' => array('field' => 'mpblok', 'label' => 'Мы принимаем (Блок)', 'rules' => 'trim'),
		'ppblok' => array('field' => 'ppblok', 'label' => 'Последние покупки (Блок)', 'rules' => 'trim'),
		'kblok' => array('field' => 'kblok', 'label' => 'Контакты (Блок)', 'rules' => 'trim'),
                'pplimit' => array('field' => 'pplimit', 'label' => 'Лимит на вывод', 'rules' => 'trim'),
                'ppcolor' => array('field' => 'ppcolor', 'label' => 'Цвет даты', 'rules' => 'trim'),
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