<?php
/**ZERN™ Framework ~ an evolving, robust platform for rapid & efficient development of modem responsive applications and APIs;
 * Built by ODAO™ [www.osawere.com] using PHP, SQL, HTML, CSS, JS & derived technology.
 * © July 2019 | beta 1.0
 * ===================================================================================================================
 * Dependency » ~
 * PHP | dbobj::zaid ~ database's data handler class
 **/

class zDBObj {
	private $db;
	private $table;


	//========== CONSTRUCT ==========//
	public function __construct($table){
		global $zernDB;
		if(!empty($zernDB) && is_object($zernDB)){
			$this->db = $zernDB;
			$this->table = $table;
		}
		return;
	}


	//========== READ [all or with conditions] ==========//
	public function read($column='*', $condition='NO_COND', $return='oRECORD'){
		if(!empty($column)){
			return $this->db->selectSQL($column, $this->table, $condition, 'NO_LIMIT', $return);
		}
		return false;
	}


	//========== READ [by puid] ==========//
	public function readPUID($puid, $column='*', $return='oRECORD'){
		if(!empty($puid) && !empty($column)){
			$condition['PUID'] = $puid;
			return $this->db->selectSQL($column, $this->table, $condition, 1, $return);
		}
		return false;
	}

}
?>