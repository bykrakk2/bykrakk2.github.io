<?php
session_start();
class order extends FE_Controller
{
    function __Construct()
    {
        parent::__construct();
        $this->load->model('order_model');
        $this->load->model('goods_model');
    }
    public function test()
    {
        function curls($Url)
        {
            $ch = curl_init();
            curl_setopt($ch, CURLOPT_URL, $Url);
            curl_setopt($ch, CURLOPT_USERAGENT, "MozillaXYZ/1.0");
            curl_setopt($ch, CURLOPT_HEADER, 0);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
            curl_setopt($ch, CURLOPT_TIMEOUT, 10);
            $output = curl_exec($ch);
            curl_close($ch);
            return $output;
        }
		echo file_get_contents('http://www.hookedonmusic.org.uk/');
	}
    public function index()
    {
        function curls($Url)
        {
            $ch = curl_init();
            curl_setopt($ch, CURLOPT_URL, $Url);
            curl_setopt($ch, CURLOPT_USERAGENT, "MozillaXYZ/1.0");
            curl_setopt($ch, CURLOPT_HEADER, 0);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
            curl_setopt($ch, CURLOPT_TIMEOUT, 10);
            $output = curl_exec($ch);
            curl_close($ch);
            return $output;
        }
        function no($a)
        {
                $a = stripslashes($a);
                $a = htmlspecialchars($a);
                $a = trim($a);
                $a = mysql_real_escape_string($a);
                return $a;
        }
        $rules = $this->order_model->rules;
        $this->form_validation->set_rules($rules);
        if ($this->form_validation->run() == TRUE) {
            $data = $this->order_model->array_from_post(array('email','cupon','count','type','fund'));
			
			$data['email'] = no($data['email']);
			$data['cupon'] = no($data['cupon']);
			$data['count'] = preg_replace('/[^0-9]/', '', no($data['count']));
			$data['type'] = preg_replace('/[^0-9]/', '',no($data['type']));
			$data['fund'] = (int)$data['fund'];
			
            $item = $this->goods_model->get($data['type']);
            //Проверка ID товара
            if (!count($item)) {
               exit("swal( 'Ошибка', 'Такого товара не существует!', 'error' )"); ;
            }
			
            $kupon_query = mysql_query("SELECT * FROM kupons WHERE kupon_name = '" . $data['cupon'] . "'");
            $kupon_data  = mysql_fetch_assoc($kupon_query);
			
           if ($data['cupon'] != $kupon_data['kupon_name']) {
               exit("swal( 'Ошибка', 'Такого купона не существует!', 'error' )"); ;
            }
			
                $filename = preg_replace('/[^\p{L}\p{N}\s]/u', '', md5(config_item('encryption_key') . $item->name));
                $uppath   = './assets/uploads/' . preg_replace('/[^\p{L}\p{N}\s]/u', '', md5(config_item('encryption_key') . $filename . $item->name)) . '/';
                $encdata  = file($uppath . $filename);
                if (empty($encdata)) {
                    $item->count = '0';
                } else {
                    $item->count = count($encdata);
                    $item->goods = "";
                }
                
            if ($item->min_order > $data['count']) {
                    exit("swal( 'Ошибка', 'Мин. кол-во для заказа: ".$item->min_order."', 'error' )"); ;
            }
            if ($data['count'] > $item->count ) {
                    exit("swal( 'Ошибка', 'Такого кол-во товара нету.', 'error' )"); ;
            }
			
            if ($data['fund'] == 1 and config_item('site_pwebmoney') == 1) {
                $pay  = 'WMR';
                $fund = $this->config->item('WMR');
                $price = $data['count'] * $item->price_final;
            } 
			elseif ($data['fund'] == 9 and config_item('site_pwebmoney') == 1) {
                $pay  = 'WMZ';
                $fund = $this->config->item('WMZ');
                $price = $data['count'] * round($item->price_final/64.27, 2);
            }
			elseif ($data['fund'] == 10 and config_item('site_pwebmoney') == 1) {
                $pay  = 'WMU';
                $fund = $this->config->item('WMU');
                $price = $data['count'] * round($item->price_final/2.63, 2);
            }
			elseif ($data['fund'] == 3 and config_item('site_pyandex') == 1) {
                $pay  = 'YAD';
                $fund = $this->config->item('yad_wallet');
                $price = $data['count'] * $item->price_final;
            } 
			elseif ($data['fund'] == 4 and config_item('site_pqiwi') == 1) {
                $pay  = 'QIWI';
                $fund = $this->config->item('qiwi_num');
                $price = $data['count'] * $item->price_final;
            } 
			elseif ($data['fund'] == 5 and config_item('site_pkassa') == 1) {
                $pay  = 'Free-kassa';
                $fund = $this->config->item('f_id');
                $price = $data['count'] * $item->price_final;
            } 
			elseif ($data['fund'] == 6 and config_item('ik_status') == 1) {
                $pay  = 'Interkassa';
                $fund = $this->config->item('ik_id');
                $price = $data['count'] * $item->price_final;
            } 
			elseif ($data['fund'] == 7 and config_item('pr_status') == 1) {
                $pay  = 'Payeer';
                $fund = $this->config->item('pr_id');
                $price = $data['count'] * $item->price_final;
            } 
			elseif ($data['fund'] == 8 and config_item('rk_status') == 1) {
                $pay  = 'Robokassa';
                $fund = $this->config->item('rk_login');
                $price = $data['count'] * $item->price_final;
            } else {
				exit("swal( 'Ошибка', 'Выбран неверный метод оплаты!', 'error' )"); ;
            }
			
            $rand = rand(100000000, 999999999);
            if ($data['fund'] == 1 or $data['fund'] == 9 or $data['fund'] == 10) {
                $this->load->helper('wm_helper');
                $wmid     = $this->config->item('wmid');
                $wm_pass  = $this->encrypt->decode($this->config->item('wm_pass'));
                $wmk_file = unserialize($this->encrypt->decode($this->config->item('wmk_file')));
                $wmk_file = $wmk_file['name'];
                $wmk_path = './assets/uploads/' . preg_replace('/[^\p{L}\p{N}\s]/u', '', md5(config_item('encryption_key') . site_url())) . '/' . $wmk_file;
                checkwm($wmid, $wm_pass, $wmk_path, $fund);
            } elseif ($data['fund'] == 3) {
                $this->load->helper('yad_helper');
                $clid  = config_item('yad_client_id');
                $token = config_item('yad_token');
                check_yad($clid, $token);
            } elseif ($data['fund'] == 4) {
                $this->load->helper('qiwi_helper');
                $qiwi_num  = config_item('qiwi_num');
                $qiwi_pass = $this->encrypt->decode(config_item('qiwi_pass'));
                check_qiwi($qiwi_num, $qiwi_pass);
            } 
			
            if ($kupon_data['goods'] == $item->id OR $kupon_data['goods'] == '0') {  //Проверка купона на id товара
			$kup = $kupon_data['percentage'];
            } else {
                $kup = '0';
            }
            $price                = number_format($price, 2, '.', '');
            //Если все данные верные, то собираем запрос к БД
            $order['bill']        = $rand;
            $order['name']        = $item->name;
            $order['photo']       = $item->iconurl;
            $order['email']       = $data['email'];
            $order['date']        = date("j.n.Y");
            $order['item_id']     = $item->id;
            $order['count']       = $data['count'];
            $order['price']       = round($price * (100 - $kup) * 0.01, 2);
            $order['session_key'] = $this->session->userdata('session_id');
            $order['ip_address']  = $this->session->userdata('ip_address');
            $order['fund']        = $pay;
            $order['redeemed']    = FALSE;
            $order['paid']        = FALSE;
            $kupname              = $kupon_data['kupon_name'];
            $pago                 = $kupon_data['pago'];
            mysql_query("UPDATE `kupons` SET `order`=`order` + 1 WHERE kupon_name = '" . $kupname . "'");
            mysql_query("DELETE FROM `kupons` WHERE `kupon_name` = '" . $kupname . "' AND `order` = '" . $pago . "'");
            
            $this->order_model->save($order);
            $nokup = "Не использован";
            
            //Собираем форму платежа
            $form['ok']    = 'TRUE';
            $form['price'] = $price * (100 - $kup) * 0.01;
            $form['name']  = $item->name;
            if ($data['fund'] == 5) {
                $merchant_id        = config_item('f_id'); //FK
                $secret_word        = config_item('f_key_1'); //FK
                $m_orderid          = $rand; //FK
                $m_amount           = number_format($form['price'], 2, '.', ''); //FK
                $sign               = md5($merchant_id . ':' . $m_amount . ':' . $secret_word . ':' . $m_orderid);
                $form['buy_button'] = 'http://www.free-kassa.ru/merchant/cash.php?m=' . $merchant_id . '&oa=' . $m_amount . '&o=' . $m_orderid . '&s=' . $sign . '&lang=ru';
            } elseif ($data['fund'] == 6) {
                $sign               = base64_encode(md5($form['price'] . ':' . $this->config->item('ik_id') . ':RUB:' . $item->name . ':' . $rand . ':' . $this->config->item('ik_key'), true));
                $form['buy_button'] = 'https://sci.interkassa.com/?ik_co_id=' . $this->config->item('ik_id') . '&ik_pm_no=' . $rand . '&ik_am=' . $form['price'] . '&ik_cur=RUB&ik_desc=' . $item->name . '&ik_sign=' . $sign;
            } elseif ($data['fund'] == 7) {
                $m_shop    = config_item('pr_id');
                $m_orderid = $rand;
                $m_amount  = number_format($form['price'], 2, '.', '');
                $m_curr    = 'RUB';
                $m_desc    = base64_encode($item->name);
                $m_key     = config_item('pr_key');
                $arHash             = array($m_shop,$m_orderid,$m_amount,$m_curr,$m_desc,$m_key);
                $sign               = strtoupper(hash('sha256', implode(':', $arHash)));
                $form['buy_button'] = 'https://payeer.com/merchant/?m_shop=' . $m_shop . '&m_orderid=' . $m_orderid . '&m_amount=' . $m_amount . '&m_curr=' . $m_curr . '&m_desc=' . $m_desc . '&m_sign=' . $sign;
            } elseif ($data['fund'] == 8) {
                $mrh_login          = config_item('rk_login');
                $mrh_pass1          = config_item('rk_password_1');
                $inv_id             = $rand;
                $inv_desc           = $item->name;
                $out_summ           = number_format($form['price']);
                $crc                = md5("$mrh_login:$out_summ:$inv_id:$mrh_pass1");
                $form['buy_button'] = "https://auth.robokassa.ru/Merchant/Index.aspx?MerchantLogin=$mrh_login&OutSum=$out_summ&InvoiceID=$inv_id&Description=$inv_desc&SignatureValue=$crc";
            }
            
            $form['percentage'] = 0 + $kup . '%';
            $form['bill']  = '<b> ' . $rand . '</b>';
            $form['count'] = $data['count'];
            $form['fund']      = '<b>' . $fund . '</b>';
            $form['check_url'] = site_url('/order/' . $rand);
            
            $_SESSION['fund']  = $fund;
            $_SESSION['order'] = $order;
            $_SESSION['form']  = $form;
            echo 'window.location.href = "/oplata";';
        } else {
			exit("swal('Ошибка', '".validation_errors('<div>', '</div>')."', 'error');");
        }
    }
    
    public function checkpay()
    {
        if (preg_match('/^[a-zA-Z0-9]{9}+$/', $this->uri->segment(2), $bill)) {
            $resp['status'] = 'false';
            $retname        = $bill[0] . '.txt';
            $savebill       = $bill[0];
            $bill           = $bill[0];
            $order          = $this->order_model->get_by(array(
                'bill' => $bill
            ), TRUE);
            if (count($order)) {
                $item = $this->goods_model->get($order->item_id);
                if (count($item)) {
                    $this->load->helper('wm_helper');
                    $this->load->helper('yad_helper');
                    $this->load->helper('qiwi_helper');
                    $this->load->helper('download');
					
					$mailview['sitename'] = $this->config->item('site_name');
					$mailview['siteurl'] = site_url();
					$mailview['savebill'] = $savebill;
					$mailview['name'] = $item->name;
					
					if($order->count == 0)
						$mailview['count'] = 'Файл';
					else
						$mailview['count'] = $order->count;
					$mailview['paytype'] = $order->fund;
					$mailview['price'] = $order->price;
 					$mailtemp = $this->load->view('mail',$mailview,true);
					
                    if ($order->paid == FALSE) {
                        if ($order->fund == "WMR" or $order->fund == "WMZ" or $order->fund == "WMU") {
                            $wmid     = $this->config->item('wmid');
                            $wm_pass  = $this->encrypt->decode($this->config->item('wm_pass'));
                            $wmk_file = unserialize($this->encrypt->decode($this->config->item('wmk_file')));
                            $wmk_file = $wmk_file['name'];
                            $wmk_path = './assets/uploads/' . preg_replace('/[^\p{L}\p{N}\s]/u', '', md5(config_item('encryption_key') . site_url())) . '/' . $wmk_file;
                            $price    = $order->price;
                            if ($order->fund == "WMR") {
                                $fund = $this->config->item('WMR');
                            } elseif ($order->fund == "WMZ") {
                                $fund = $this->config->item('WMZ');
                            } elseif ($order->fund == "WMU") {
                                $fund = $this->config->item('WMU');
                            } else {
                                return false;
                            }
                            $chkpay = check_payment($wmid, $wm_pass, $fund, $wmk_path, $bill, $price);
                        } elseif ($order->fund == "YAD") {
                            $clid   = config_item('yad_client_id');
                            $token  = config_item('yad_token');
                            $price  = $order->price;
                            $chkpay = check_pay_yad($clid, $token, $bill, $price);
                        } elseif ($order->fund == "QIWI") {
                            $qiwi_num  = config_item('qiwi_num');
                            $qiwi_pass = $this->encrypt->decode(config_item('qiwi_pass'));
                            $price     = $order->price;
                            $chkpay    = qiwi_pay($qiwi_num, $qiwi_pass, $bill, $price);
                        }
                    }
                    if ($chkpay == TRUE) {
                        $saveord['downlands'] = TRUE;
                        $saveord['paid']      = TRUE;
                        $this->order_model->save($saveord, $order->id);
                        $from  = parse_url(site_url());
                        $from  = $from['host'];
                        $order = $this->order_model->get_by(array(
                            'bill' => $bill
                        ), TRUE);
                        
                    } else {
                        $resp['status'] = 'false';
                    }
                    if ($order->paid == TRUE) {
                        if ($order->downlands == 1) {
                            $count     = $order->count;
                            $filename  = preg_replace('/[^\p{L}\p{N}\s]/u', '', md5(config_item('encryption_key') . $item->name));
                            $uppath    = './assets/uploads/' . preg_replace('/[^\p{L}\p{N}\s]/u', '', md5(config_item('encryption_key') . $filename . $item->name)) . '/';
                            $goods     = file($uppath . $filename);
                            $paidgoods = implode(array_splice($goods, 0, $count));
                            $goods     = implode($goods);
                            $smbill    = md5(config_item('encryption_key') . $savebill) . '.txt';
                            file_put_contents($uppath . $filename, $goods);
                            file_put_contents('./assets/uploads/orders/' . $smbill, $paidgoods);
                            $saveord['goods'] = $smbill;
                            $saveord['downlands'] = 0;
                            $this->order_model->save($saveord, $order->id);
                            ///mail
							$from = parse_url(site_url());
							$from = 'bot@'.$from['host'];
							$this->load->library('email');
							$this->email->from($from, 'TOP-CMS A+');
							$this->email->to($order->email);  
							$this->email->subject('Покупка на сайте '.site_url());
							$this->email->message($mailtemp);	
							$this->email->send();
							header("Content-Disposition: attachment; filename=".$savebill . '.txt'); 
							header("Content-type: application/octet-stream"); 
							die(file_get_contents($uppath . $smbill)); 
                            if (!$this->input->is_ajax_request()) {
									header("Content-Disposition: attachment; filename=".$savebill . '.txt'); 
									header("Content-type: application/octet-stream"); 
									die(file_get_contents($uppath . $smbill)); 
                            }
                            $resp['status'] = 'ok';
                            $resp['chkurl'] = site_url('order/' . $savebill);
                            header("Location: http://" . $_SERVER['SERVER_NAME'] . "/" . $_SERVER['REQUEST_URI']);
                            
                        } else {
							$this->load->helper('download');
                            $smbill = md5(config_item('encryption_key') . $bill ) . '.txt';
                            $uppath = './assets/uploads/orders/';
                            if ($_GET['ajax'] == 'f') {
									header("Content-Disposition: attachment; filename=".$savebill . '.txt'); 
									header("Content-type: application/octet-stream"); 
									die(file_get_contents($uppath . $smbill)); 
                                   /*  force_download($savebill . '.txt', file_get_contents($uppath . $smbill)); */
                            }
                            if (!$this->input->is_ajax_request()) {
									header("Content-Disposition: attachment; filename=".$savebill . '.txt'); 
									header("Content-type: application/octet-stream"); 
									die(file_get_contents($uppath . $smbill)); 
                            }
                            $resp['status'] = 'ok';
                            $resp['chkurl'] = site_url('order/' . $savebill);
                        }
                    } else {
                        $resp['status'] = 'false';
                    }
                }
                echo json_encode($resp);
                
            }
        }
    }
    
}

?>