<?php
class myorders extends FE_Controller
{
    function __Construct()
    {
        parent::__construct();
        $this->load->model('order_model');
    }
    
    public function index()
    {
        $this->data['info']    = '';
        if (isset($_POST['email'])) {
            
            $from    = 'admin@ice-shop.su';
            $to      = substr(htmlspecialchars(trim($_POST['email'])), 0, 50);
            $key     = md5(config_item('encryption_key') . $to . site_url());
            $token   = site_url() . '/myorders?key=' . $key . '&mail=' . $to;
            $this->load->library('email');
            $this->email->subject('Просмотр моих покупок на сайте '.site_url());
			$this->email->from('bot@ice-shop.su', 'TOP-CMS A+');
            $this->email->to($to); 
            $this->email->message("Для просмотра своих покупок на сайте " . site_url() . " перейдите по <a href='" . $token . "'>ссылке</a>.");	
            $this->email->send();
            $this->data['info'] = '<script type="text/javascript">swal("Отлично!", "На ваш mail успешно отправлено письмо с ссылкой для просмотра ваших покупок .", "success")</script>';
        }
        if (empty($_GET['key']) || empty($_GET['mail'])) {
            $this->data['orders'] = '';
        } else {
            $b = md5(config_item('encryption_key') . $_GET['mail'] . site_url());
            if ($_GET['key'] == $b) {
                $orders               = $this->order_model->get_by(array(
                    'email' => $_GET['mail'],
                    'paid' => 1
                ));
                $orders               = is_array($orders) ? $orders : array(
                    $orders
                );
                $this->data['orders'] = $orders;
            } else {
                $this->data['info'] = '<script type="text/javascript">swal("Ошибка", "Ваш код не совпадает с адресом почты", "warning")</script>';
            }
        }
		        $this->data['subview'] = 'myorders';
				$this->data['title'] = 'Мои покупки';
        $this->load->view('myorders', $this->data);
    }
}
?>