
<?php
class template_model extends MY_Model {
	public $rules = array(

		'site_name' => array('field' => 'site_name', 'label' => 'Название сайта', 'rules' => 'trim'),
		'sitedescription' => array('field' => 'sitedescription', 'label' => 'Фраза под заголовком', 'rules' => 'trim|max_length[255]'),
		'metadescr' => array('field' => 'metadescr', 'label' => 'Мета-описание сайта', 'rules' => 'trim'),
		'wmid' => array('field' => 'wmid', 'label' => 'wmid', 'rules' => 'integer|trim|xss_clean'),
		'WMR' => array('field' => 'WMR', 'label' => 'WMR', 'rules' => 'trim|xss_clean'),
		'WMZ' => array('field' => 'WMZ', 'label' => 'WMZ', 'rules' => 'trim|xss_clean'),
		'wm_pass' => array('field' => 'WMZ', 'label' => 'WMZ', 'rules' => 'trim'),
		'site_pwebmoney' => array('field' => 'site_pwebmoney', 'label' => 'WebMoney', 'rules' => 'trim'),
		'site_pqiwi' => array('field' => 'site_pqiwi', 'label' => 'QIWI', 'rules' => 'trim'),
		'site_pyandex' => array('field' => 'site_pyandex', 'label' => 'Yandex', 'rules' => 'trim'),
                'site_ppkolvo' => array('field' => 'site_ppkolvo', 'label' => 'Полоска выбора Кол-Во', 'rules' => 'trim'),
	);
 public function __construct()
 {
  parent::__construct();
 }
 public function get_all()
 {
  return $this->db->get('config_data');
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