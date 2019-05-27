<?php
class templates_model extends MY_Model {
	protected $table_name = 'market_templates';
	protected $order_by = 'id';
	public $rules = array(
	'name' => array('field' => 'name', 'label' => 'Заголовок', 'rules' => 'trim|required|max_length[100]|xss_clean'),
	'price' => array('field' => 'price', 'label' => 'Альт. заголовок', 'rules' => 'trim|required|max_length[100]'),
	'bg' => array('field' => 'bg', 'label' => 'Текст', 'rules' => 'trim|required'),
	'icon' => array('field' => 'icon', 'label' => 'Текст', 'rules' => 'trim|required'),
	'descr' => array('field' => 'descr', 'label' => 'Текст', 'rules' => 'required'),
	'tpl_main' => array('field' => 'tpl_main', 'label' => 'Текст', 'rules' => 'required'),
	'tpl_item' => array('field' => 'tpl_item', 'label' => 'Текст', 'rules' => 'required'),
	'tpl_item_page' => array('field' => 'tpl_item_page', 'label' => 'Текст', 'rules' => 'required'),
	'tpl_items' => array('field' => 'tpl_items', 'label' => 'Текст', 'rules' => 'required'),
	'tpl_items_main' => array('field' => 'tpl_items_main', 'label' => 'Текст', 'rules' => 'required'),
	'tpl_page' => array('field' => 'tpl_page', 'label' => 'Текст', 'rules' => 'required'),
	'tpl_reviews' => array('field' => 'tpl_reviews', 'label' => 'Текст', 'rules' => 'required'),
	'tpl_reviews_form' => array('field' => 'tpl_reviews_form', 'label' => 'Текст', 'rules' => 'required'),
	'tpl_search' => array('field' => 'tpl_search', 'label' => 'Текст', 'rules' => 'required'),
	);
	
	public function get_new() {
		$templates = new stdClass();
		$templates->name = '';
		$templates->price = '';
		$templates->bg = '';
		$templates->icon = '';
		$templates->descr = '';
		$templates->tpl_main = '';
		$templates->tpl_item = '';
		$templates->tpl_item_page = '';
		$templates->tpl_items = '';
		$templates->tpl_items_main = '';
		$templates->tpl_page = '';
		$templates->tpl_reviews = '';
		$templates->tpl_reviews_form = '';
		$templates->tpl_search = '';
		return $templates;
	}
	public function get_nested() {
		$billing = $this->load->database('billing', TRUE, TRUE);
		$table = $billing->get('templates_model')->result();
		if(count($table))
		{
		foreach($table as $key=>$item) {
			$ret[] = array(
			'name' => $item->name,
			'price' => $item->price,
			'bg' => $item->bg,
			'icon' => $item->icon,
			'descr' => $item->descr,
			'tpl_main' => $item->tpl_main,
			'tpl_item' => $item->tpl_item,
			'tpl_item_page' => $item->tpl_item_page,
			'tpl_items' => $item->tpl_items,
			'tpl_items_main' => $item->tpl_items_main,
			'tpl_page' => $item->tpl_page,
			'tpl_reviews' => $item->tpl_reviews,
			'tpl_reviews_form' => $item->tpl_reviews_form,
			'tpl_search' => $item->tpl_search,
			);
		}
		}
		else
		{
			$ret = '';
		}
		return $ret;
	}
}
?>