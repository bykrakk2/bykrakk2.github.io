<?php
class Autochange extends FE_Controller {
	function __Construct() {
        parent::__construct();
		$this->load->model('autochange_model');
    }
	public function index()
	{
			//Получаем IP
if(getenv('HTTP_X_FORWARDED_FOR'))
{$ip = getenv('HTTP_X_FORWARDED_FOR');}
elseif(getenv('REMOTE_ADDR'))
{$ip = getenv('REMOTE_ADDR');}
 
//Сравниваем с ip-шниками в БД
$query = "SELECT * FROM `ban` WHERE `title` = '$ip'";
$result = @mysql_query($query);
if(@mysql_num_rows($result) > 0 ) {
        $this->data['subview'] = 'blocked.php';
		$this->load->view('main_layout',$this->data);
}
else{
		$this->data['subview'] = 'autochange';
		$this->data['autochange'] = $this->autochange_model->get_by(array('slug' => (string) $this->uri->segment(2)),TRUE);

		$this->load->view('main_layout',$this->data);
	}
	}
		
		}
?>