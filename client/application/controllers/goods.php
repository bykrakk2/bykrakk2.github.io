<?php
class goods extends FE_Controller
{
    function __Construct()
    {
        parent::__construct();
        $this->load->model('goods_model');
        $this->load->model('categories_model');
        $this->data['categories'] = $this->categories_model->get();
    }
    public function index($id = NULL)
    {
        $per = config_item('ssb');
        $cat = $this->uri->segment(1);
        if ($cat == "category") {
            $trd = $this->uri->segment(4);
        } else {
            $trd = $this->uri->segment(3);
        }
        if (empty($trd)) {
            $trd = 1;
        }
        $curp = $trd - 1;
        if ($cat == "category") {
            $where = array(
                'category' => $this->uri->segment(2)
            );
        } else {
            $where = array(
                'onmain' => '1'
            );
        }
        $items = $this->goods_model->get_bynum($per, $curp, $where);
        $count               = $this->goods_model->get_count($where);
        if (!empty($items)):
            foreach ($items as $key => $item) {
                if ($item->sell_method == 0) {
                    $filename = preg_replace('/[^\p{L}\p{N}\s]/u', '', md5(config_item('encryption_key') . $item->name));
                    $uppath   = './assets/uploads/' . preg_replace('/[^\p{L}\p{N}\s]/u', '', md5(config_item('encryption_key') . $filename . $item->name)) . '/';
                    $data     = file($uppath . $filename);
                    if (empty($data)) {
                        $item->count = '0';
                    } else {
                        $item->count = count($data);
                        $item->goods = "";
                    }
                } elseif ($item->sell_method == 1) {
                    $item->count = 'Файл';
                    $item->goods = "";
                } elseif ($item->sell_method == 2) {
                    $filename = preg_replace('/[^\p{L}\p{N}\s]/u', '', md5(config_item('encryption_key') . $item->name));
                    $uppath   = './assets/uploads/' . preg_replace('/[^\p{L}\p{N}\s]/u', '', md5(config_item('encryption_key') . $filename . $item->name)) . '/';
                    $data     = file_get_contents($uppath . $filename);
                    $data     = explode("[sep]", $data);
                    if (empty($data)) {
						$item->count = '0';
                    } else {
                        $item->count = count($data);
                        $item->goods = "";
                    }
                }
				if ($item->del == 1 and $item->count == 0) {
					unset($items[$key]); $count = $count-1;
				}
            }
        endif;
		$this->data['count'] = $count;
        $this->data['items'] = $items;
        if ($cat == "category") {
            $this->data['pagination'] = $this->pagination($count, $curp, '/catalog/' . $this->uri->segment(2) . '/p/', 4, $per);
        } else {
            $this->data['pagination'] = $this->pagination($count, $curp, '/goods/p/', 3, $per);
        }
        $this->data['subview'] = 'items';
		$this->data['title'] = 'Главная';
        $this->load->view('main_layout', $this->data);
    }
    private function pagination($count, $page, $backurl, $k, $per)
    {
        $this->load->library('pagination');
        $ord_per_page               = $per;
        $maxpage                    = ceil($count / $ord_per_page);
        $config['base_url']         = $backurl;
        $config['total_rows']       = $maxpage;
        $config['per_page']         = 1;
        $config['uri_segment']      = $k;
        $config['use_page_numbers'] = TRUE;
        $config['num_links']        = 2;
        $config['first_link']       = 'В начало';
        $config['first_tag_open']   = '<li>';
        $config['first_tag_close']  = '</li>';
        $config['last_link']        = 'В конец';
        $config['last_tag_open']    = '<li>';
        $config['last_tag_close']   = '</li>';
        $config['full_tag_open']    = '<ul class="pagination">';
        $config['full_tag_close']   = '</ul>';
        $config['num_tag_open']     = '<li>';
        $config['num_tag_close']    = '</li>';
        $config['cur_tag_open']     = '<li class="active"><a>';
        $config['cur_tag_close']    = '</a></li>';
        $config['prev_tag_open']    = '<li>';
        $config['prev_tag_close']   = '</li>';
        $config['next_tag_open']    = '<li>';
        $config['next_tag_close']   = '</li>';
        $this->pagination->initialize($config);
        
        return $this->pagination->create_links();
    }
}
?>