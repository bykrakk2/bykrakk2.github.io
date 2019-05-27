<?php
class good extends FE_Controller {
	function __Construct() {
        parent::__construct();
		$this->load->model('goods_model');
		$this->load->model('categories_model');
    }
	public function index($id=NULL)
	{
		$items = $this->goods_model->get($id);

		
      
		//var_dump($items);
		if (!empty($items)):

			$id ? $items=array($items): '' ;
		

				foreach($items as $item) 
				{
					if($item->sell_method == 0)
					{
						$filename = preg_replace('/[^\p{L}\p{N}\s]/u','', md5(config_item('encryption_key').$item->name));
						$uppath = './assets/uploads/'.preg_replace('/[^\p{L}\p{N}\s]/u','', md5(config_item('encryption_key').$filename.$item->name)).'/';
						$data = file($uppath.$filename);
						if(empty($data)) 
						{
							$item->count = '0';
						}
						else
						{
							$item->count = count($data);
							$item->goods = "";
						}
					}
					elseif($item->sell_method == 1)
					{
						$item->count = 'Файл';
						$item->goods = "";
					}			
					elseif($item->sell_method == 2)
					{
						$filename = preg_replace('/[^\p{L}\p{N}\s]/u','', md5(config_item('encryption_key').$item->name));
						$uppath = './assets/uploads/'.preg_replace('/[^\p{L}\p{N}\s]/u','', md5(config_item('encryption_key').$filename.$item->name)).'/';
						$data = file_get_contents($uppath.$filename);
						$data = explode("[sep]",$data);
						if(empty($data)) 
						{
							$item->count = '0';
						}
						else
						{
							$item->count = count($data);
							$item->goods = "";
						}
					}
				}

		endif;
		
		$ret = array();
		$WMR = $this->config->item('WMR');
		$WMZ = $this->config->item('WMZ');
		$YAD = $this->config->item('yad_wallet');
		$QIWI = $this->config->item('qiwi_num');
$Free = $this->config->item('f_id');
		
		if(!empty($WMR)) {
			$ret[] = array(
			'fundid' => '1',
			'fundname' => 'WMR'
			);
		}
		
		if(!empty($WMZ)) {
			$ret[] = array(
			'fundid' => '2',
			'fundname' => 'WMZ'
			);
		}
		
		if(!empty($YAD)) {
			$ret[] = array(
			'fundid' => '3',
			'fundname' => 'Яндекс.Деньги'
			);
		}		
		
		if(!empty($QIWI)) {
			$ret[] = array(
			'fundid' => '4',
			'fundname' => 'QIWI'
			);
		}
		if(!empty($Free)) {
			$ret[] = array(
			'fundid' => '5',
			'fundname' => 'Free-kassa'
			);
		}
		
		$this->data['funds'] = $ret;
		$this->data['items'] = $items;
		$this->data['title'] = $items[0]->name;
		$this->data['modals'] = get_modals($items);
		$this->data['subview'] = $id ? 'item' : 'items';
		$this->load->view('main_layout',$this->data);
		
	}
	
}
?>