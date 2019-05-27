<?php
class FT_Controller extends MY_Controller {
	function __Construct() {
        parent::__construct();
    }

    function cut_string($string, $length = 200)
	{
	    if ($length && strlen($string) > $length)
	    {
	        $str = strip_tags($string);
	        $str = rtrim($str, strstr($str, "\r\n"));
	        $str = substr($str, 0, $length);
	        $pos = strrpos($str, ' ');
	        return substr($str, 0, $pos).'…';
	    }
	    return $string;
	}
}
?>