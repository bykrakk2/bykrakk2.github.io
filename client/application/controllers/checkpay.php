<?php
class checkpay extends FE_Controller
{
    function __Construct()
    {
        parent::__construct();
    }
    public function index($id = NULL)
    {
        function getIP()
        {
            if (isset($_SERVER['HTTP_X_REAL_IP']))
                return $_SERVER['HTTP_X_REAL_IP'];
            return $_SERVER['REMOTE_ADDR'];
        }
        if (!in_array(getIP(), array(
            '136.243.38.147',
            '136.243.38.149',
            '136.243.38.150',
            '136.243.38.151',
            '136.243.38.189'
        ))) {
            die("hacking attempt!");
        }
        $secr2  = config_item('f_key_2');
        $keyer1 = md5($_REQUEST['MERCHANT_ID'] . ':' . $_REQUEST['AMOUNT'] . ':' . $secr2 . ':' . $_REQUEST['MERCHANT_ORDER_ID']);
        $keyer2 = $_REQUEST['SIGN'];
        if ($keyer1 == $keyer2) {
            mysql_query("UPDATE orders SET `paid`='1' WHERE bill='" . $_REQUEST['MERCHANT_ORDER_ID'] . "'");
            mysql_query("UPDATE orders SET `downlands`='1' WHERE bill='" . $_REQUEST['MERCHANT_ORDER_ID'] . "'");
        }
        die('YES');
    }
    public function ik()
    {
        function getIP()
        {
            if (isset($_SERVER['HTTP_X_REAL_IP']))
                return $_SERVER['HTTP_X_REAL_IP'];
            return $_SERVER['REMOTE_ADDR'];
        }
        if (!in_array(getIP(), array(
            '151.80.190.97',
            '151.80.190.98',
            '151.80.190.99',
            '151.80.190.100',
            '151.80.190.101',
            '151.80.190.102',
            '151.80.190.103',
            '151.80.190.104'
        ))) {
            die("hacking attempt!");
        }
        $data   = $_REQUEST;
        $ikSign = $data['ik_sign'];
        unset($data['ik_sign']);
        ksort($data, SORT_STRING);
		if ($data['ik_pw_via'] == 'test_interkassa_test_xts') {
			$key = config_item('ik_test');
		} else {
			$key = config_item('ik_key');
		}
        array_push($data, $key);
        $signStr = implode(':', $data);
        $sign    = base64_encode(md5($signStr, true));
        if ($ikSign == $sign) {
            mysql_query("UPDATE orders SET `paid`='1' WHERE bill='" . $_REQUEST['ik_pm_no'] . "'");
            mysql_query("UPDATE orders SET `downlands`='1' WHERE bill='" . $_REQUEST['ik_pm_no'] . "'");
            echo '200 OK';
        }
    }
    public function payeer()
    {
        if ($_SERVER['REMOTE_ADDR'] != '37.59.221.230')
            return;
        
        if (isset($_POST['m_operation_id']) && isset($_POST['m_sign'])) {
            $m_key     = config_item('pr_key');
            $arHash    = array(
                $_POST['m_operation_id'],
                $_POST['m_operation_ps'],
                $_POST['m_operation_date'],
                $_POST['m_operation_pay_date'],
                $_POST['m_shop'],
                $_POST['m_orderid'],
                $_POST['m_amount'],
                $_POST['m_curr'],
                $_POST['m_desc'],
                $_POST['m_status'],
                $m_key
            );
            $sign_hash = strtoupper(hash('sha256', implode(':', $arHash)));
            if ($_POST['m_sign'] == $sign_hash && $_POST['m_status'] == 'success') {
                echo $_POST['m_orderid'] . '|success';
                mysql_query("UPDATE orders SET `paid`='1' WHERE bill='" . $_POST['m_orderid'] . "'");
                mysql_query("UPDATE orders SET `downlands`='1' WHERE bill='" . $_POST['m_orderid'] . "'");
            }
            echo $_POST['m_orderid'] . '|error';
        }
    }
    public function rk()
    {
		if (empty($_REQUEST)) {
			exit('Error');
		}
        $mrh_pass2 = config_item('rk_password_2');
        $crc = strtoupper($_REQUEST["SignatureValue"]);
		$inv_id = $_REQUEST["inv_id"];
		$out_summ = $_REQUEST["OutSum"];
        $my_crc = strtoupper(md5("$out_summ:$inv_id:$mrh_pass2"));
        if ($my_crc == $crc){
			echo "OK$inv_id\n";
            mysql_query("UPDATE orders SET `paid`='1' WHERE bill='" . $inv_id . "'");
            mysql_query("UPDATE orders SET `downlands`='1' WHERE bill='" . $inv_id . "'");
			} else {
				echo "bad sign\n";
				exit(); 
			}
        

    }

}
?>