<?php
session_start();
class oplata extends FE_Controller
{
    function __Construct()
    {
        parent::__construct();
        $this->load->model('order_model');
        $this->load->model('goods_model');
    }
    public function index($id = NULL)
    {
		$domain = $_SERVER['HTTP_HOST'];
		$this->data['pro'] = '1';
        function no($a)
        {
            $a = stripslashes($a);
            $a = htmlspecialchars($a);
            $a = trim($a);
            $a = mysql_real_escape_string($a);
            return $a;
        }
        $orders = $this->order_model->get_by(array(
            'bill' => no($_SESSION['order']['bill'])
        ), TRUE);
        if (count($orders)) {
            $this->data['order'] = $orders;
        }
        $this->data['subview'] = 'oplata/pay';
		$this->data['title'] = 'Оплата завершена';
        $this->load->view('oplata/pay', $this->data);
		
    }
    public function cash($id = NULL)
    {
		$this->data['pro'] = '1';
		$domain = $_SERVER['HTTP_HOST'];
        function no($a)
        {
            $a = stripslashes($a);
            $a = htmlspecialchars($a);
            $a = trim($a);
            $a = mysql_real_escape_string($a);
            return $a;
        }
        $items = $this->goods_model->get(no($id));
        if (count($items)) {
            if ($items->sell_method == 0) {
                $filename = preg_replace('/[^\p{L}\p{N}\s]/u', '', md5(config_item('encryption_key') . $items->name));
                $uppath   = './assets/uploads/' . preg_replace('/[^\p{L}\p{N}\s]/u', '', md5(config_item('encryption_key') . $filename . $items->name)) . '/';
                $data     = file($uppath . $filename);
                if (empty($data)) {
                    $items->count = '0';
                } else {
                    $items->count = count($data);
                    $items->goods = "";
                }
            } elseif ($items->sell_method == 1) {
                $items->count = '????';
                $items->goods = "";
            }
            $this->data['item']    = $items;
			$this->data['title'] = 'Оплата';
            $this->data['subview'] = 'oplata/cash';
            $this->load->view('oplata/cash', $this->data);
        } else {
            $this->data['subview'] = 'error';
            $this->load->view('payr', $this->data);
        }
        
        
    }
}
?> 