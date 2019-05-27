<?php
class sitebloks extends MY_Model {
	public $rules = array(
        'vkblok' => array('field' => 'vkblok', 'label' => 'ID ������ ���������', 'rules' => 'trim'),
	'theme_color_j' => array('field' => 'theme_color_j', 'label' => '���� �������', 'rules' => 'trim'),
			'slide1' => array('field' => 'sitefon', 'label' => '�������� �� ���', 'rules' => 'trim'),
		'slide2' => array('field' => 'sitefon', 'label' => '�������� �� ���', 'rules' => 'trim'),
		'slide3' => array('field' => 'sitefon', 'label' => '�������� �� ���', 'rules' => 'trim'),
				'ss1' => array('field' => 'sitefon', 'label' => '�������� �� ���', 'rules' => 'trim'),
		'ss2' => array('field' => 'sitefon', 'label' => '�������� �� ���', 'rules' => 'trim'),
		'ss3' => array('field' => 'sitefon', 'label' => '�������� �� ���', 'rules' => 'trim'),
				'su1' => array('field' => 'sitefon', 'label' => '�������� �� ���', 'rules' => 'trim'),
		'su2' => array('field' => 'sitefon', 'label' => '�������� �� ���', 'rules' => 'trim'),
		'su3' => array('field' => 'sitefon', 'label' => '�������� �� ���', 'rules' => 'trim'),

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