<?php
class orders extends Admin_Controller {
	function __Construct() {
        parent::__construct();
		$this->load->model('goods_model');
		$this->load->model('order_model');
        if (in_array($this->session->userdata('group'), array("3"))) {
            show_404(); exit;
        }
    }
	
	public function index () {
		$orders = $this->order_model->get_by(array('paid' => '1'));
		foreach($orders as $order) {
			if(empty($order->name)) {
				$name = $this->goods_model->get($order->item_id);
				if(!empty($name))
				{
					$name = $name->name;
					$order->name = $name;
				}
				else
				{
					$order->name = '<b>Товар был удален</b>';
				}
			}
			preg_match('#(?<=bill\[)[a-zA-Z0-9]{15}(?=\])#',$order->bill,$bill);
			$order->bill2 = $bill[0];
		}
		$this->data['orders'] = $orders;
		$this->data['subview'] = 'admin/orders';
		$this->load->view('admin/layout_main',$this->data);
	}
	
	public function getorder() {
		if(preg_match('/^[a-zA-Z0-9]{15}+$/',$this->uri->segment(4),$bill))
		{	
			$retname = $bill[0].'.txt';
			$savebill = $bill[0];
			$bill = 'bill['.$bill[0].']';
			$this->load->helper('download');
			$order = $this->order_model->get_by(array('bill' => $bill),TRUE);
			if(count($order)) 
			{
				$item = $this->goods_model->get($order->item_id);
				if($item->sell_method == 0)
				{
					$smbill = md5(config_item('encryption_key').$savebill).'.txt';
					$uppath = './http://next-themes.com/mtek/code/assets/uploads/orders/';
					force_download($retname, file_get_contents($uppath.$smbill));
				}
				elseif($item->sell_method == 1) 
				{
					$uppath = './http://next-themes.com/mtek/code/assets/uploads/'.preg_replace('/[^\p{L}\p{N}\s]/u','', md5(config_item('encryption_key').$item->goods.$item->name)).'/'.$item->goods;
					force_download($item->goods, file_get_contents($uppath));
				}
			}
		}
	}
}
?>