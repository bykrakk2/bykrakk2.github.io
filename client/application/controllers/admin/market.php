<?php
class market extends Admin_Controller
{
    function __Construct()
    {
        parent::__construct();
        $this->load->model('market_model');
        if (in_array($this->session->userdata('group'), array("2"))) {show_404(); exit;
        }
    }
    
    public function index()
    {
        $bil   = $this->load->database('billing', TRUE, FALSE);
        $templates = $bil->get('market_templates');
        $this->data['templates'] = $templates->result();
        $this->data['subview'] = 'admin/market/index';
        $this->load->view('admin/layout_main', $this->data);
    }
    public function view($id)
    {
		$id = preg_replace('/[^0-9]/', '', $id);
        $bil   = $this->load->database('billing', TRUE, FALSE);
		$template = $bil->get_where('market_templates', array('id' => $id));
		$site = $bil->get_where('sites', array('domain' => $_SERVER['HTTP_HOST']))->result();
		$buy = $bil->get_where('market_prices', array('id_user' => $site[0]->user_id , 'id_template' => $id))->result();
		if (empty($buy[0]->id)) { $buy = "0";}  else { $buy = "1"; }
		$this->data['buy'] = $buy;
        $this->data['template'] = $template->result();
        $this->data['subview'] = 'admin/market/view';
        $this->load->view('admin/layout_main', $this->data);
    }
    public function install($id)
    {
		$default   = $this->load->database('default', TRUE, FALSE);
		$id = preg_replace('/[^0-9]/', '', $id);
        $bil   = $this->load->database('billing', TRUE, FALSE);
		$template = $bil->get_where('market_templates', array('id' => $id))->result();
		$site = $bil->get_where('sites', array('domain' => $_SERVER['HTTP_HOST']))->result();
		$user = $bil->get_where('profiles', array('id' => $site[0]->user_id))->result();
		$buy = $bil->get_where('market_prices', array('id_user' => $user[0]->id , 'id_template' => $id))->result();
		if (empty($buy[0]->id)) { $buy = "0";} else { $buy = "1"; } 
		if ($template[0]->price == 0 or  $buy == 1) {
			$data = array('value' => $template[0]->tpl_main); $default->where('key', 'main'); $default->update('config_data', $data); 
			$data = array('value' => $template[0]->tpl_item); $default->where('key', 'item'); $default->update('config_data', $data); 
			$data = array('value' => $template[0]->tpl_items); $default->where('key', 'items'); $default->update('config_data', $data); 
			$data = array('value' => $template[0]->tpl_page); $default->where('key', 'page'); $default->update('config_data', $data); 
			echo 'swal("Успех!", "Вы успешно установили данный шаблон .", "success")';
		} else {
		    echo 'sweetAlert("Ошибка", "У вас не куплен данный шаблон .", "error");';
		}
    }
    public function buy($id)
    {
		$default   = $this->load->database('default', TRUE, FALSE);
		$id = preg_replace('/[^0-9]/', '', $id);
        $bil   = $this->load->database('billing', TRUE, FALSE);
		$template = $bil->get_where('market_templates', array('id' => $id))->result();
		$site = $bil->get_where('sites', array('domain' => $_SERVER['HTTP_HOST']))->result();
		$user = $bil->get_where('profiles', array('id' => $site[0]->user_id))->result();
		$buy = $bil->get_where('market_prices', array('id_user' => $user[0]->id , 'id_template' => $id))->result();
		if (empty($buy[0]->id)) { $buy = "0";} else { $buy = "1"; } 
		if ($template[0]->price == 0 or  $buy == 1 ) {
			echo 'sweetAlert("Ошибка", "Вы уже приобрели данный шаблон .", "error");';
		} elseif($user[0]->money < $template[0]->price) {
			echo 'sweetAlert("Ошибка", "У вас недостаточно денег на балансе .", "error");';
		} else {
			$balance = $user[0]->money - $template[0]->price ;
			$data = array('money' => $balance); 
			$bil->where('id', $user[0]->id); 
			$bil->update('profiles', $data); 
			$data = array( 'id_user' => $user[0]->id , 'id_template' => $id ); 
			$bil->insert('market_prices', $data); 
			echo 'swal("Успех!", "Вы успешно купили данный шаблон .", "success");location.reload(true);';
		}
    }
    public function balance()
    {
		$id = preg_replace('/[^0-9]/', '', $id);
        $bil   = $this->load->database('billing', TRUE, FALSE);
		$template = $bil->get_where('market_templates', array('id' => $id))->result();
		$site = $bil->get_where('sites', array('domain' => $_SERVER['HTTP_HOST']))->result();
		$user = $bil->get_where('profiles', array('id' => $site[0]->user_id))->result();
		echo $user[0]->money;
	}
	public function login()
    {
		$id = preg_replace('/[^0-9]/', '', $id);
        $bil   = $this->load->database('billing', TRUE, FALSE);
		$template = $bil->get_where('market_templates', array('id' => $id))->result();
		$site = $bil->get_where('sites', array('domain' => $_SERVER['HTTP_HOST']))->result();
		$user = $bil->get_where('profiles', array('id' => $site[0]->user_id))->result();
		echo $user[0]->firstname;
	}
}
?>