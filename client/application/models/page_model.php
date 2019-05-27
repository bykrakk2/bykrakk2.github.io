<?php
class page_model extends MY_Model {
	protected $table_name = 'pages';
	protected $order_by = 'order';
	public $rules = array(
	'email' => array('field' => 'title', 'label' => 'Заголовок', 'rules' => 'trim|required|max_length[100]|xss_clean'),
	'slug' => array('field' => 'slug', 'label' => 'Альт. заголовок', 'rules' => 'trim|required|max_length[100]|url_title|callback__unique_slug|xss_clean'),
	'body' => array('field' => 'body', 'label' => 'Текст', 'rules' => 'trim|required'),
	'loader' => array('field' => 'loader', 'label' => 'Каркас', 'rules' => 'trim'),
	'tpl' => array('field' => 'tpl', 'label' => 'Шаблон', 'rules' => 'trim'),
	);
	
	public function get_new() {
		$page = new stdClass();
		$page->title = '';
		$page->slug = '';
		$page->loader = '0';
		$page->body = '';
		$page->tpl = '';
		return $page;
	}
	public function get_nested() {
		$table = $this->db->get('pages')->result();
		if(count($table))
		{
		foreach($table as $key=>$item) {
			$ret[] = array(
			'title' => $item->title,
			'slug' => $item->slug,
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