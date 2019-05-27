<?php
class sitedesign extends MY_Model {
	public $rules = array(
		'block_3' => array('field' => 'block_3', 'label' => 'Favicon', 'rules' => 'trim'),
		'block_2' => array('field' => 'block_2', 'label' => 'Favicon', 'rules' => 'trim'),
		'site_logo' => array('field' => 'site_logo', 'label' => 'Логотип', 'rules' => 'trim'),
		'site_flogo' => array('field' => 'site_logo', 'label' => 'Логотип', 'rules' => 'trim'),
		'jobsite' => array('field' => 'jobsite', 'label' => 'jobsite ', 'rules' => 'trim'),
		'ssb' => array('field' => 'ssb', 'label' => 'Кол-во товаров на страницу ', 'rules' => 'trim|xss_clean'),
				
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