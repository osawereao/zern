<?php
/* ZERN™ Framework ~ an evolving, robust platform for rapid & efficient development of modem responsive applications and APIs;
 * Built by ODAO™ [www.osawere.com] using PHP, SQL, HTML, CSS, JS & derived technology.
 * © July 2019 | beta 1.0
 * ===================================================================================================================
 * Dependency » *
 * PHP | pdo::object ~ pdo class
 */

class oPDO {
	var $name;
	var $user;
	var $pass;
	var $host;
	var $userz;
	var $pdo;

	//****** CONSTRUCT [initiate database connection] ******//
	public function __construct($config='')
	{
		if(!empty($config) && is_array($config)){
			if(!empty($config['db_name'])){$this->name = $config['db_name'];}
			if(!empty($config['db_user'])){$this->user = $config['db_user'];}
			if(!empty($config['db_pass'])){$this->pass = $config['db_pass'];}
			if(!empty($config['db_host'])){$this->host = $config['db_host'];}
			if(!empty($config['db_userz'])){$this->userz = $config['db_userz'];}
			return $this->connect();
		}
		else {
			exit('Requires DB Config');
		}
	}//******** END ********//


	//****** CONNECT [create database connection] ******//
	private function connect()
	{
		$dsn = 'mysql:dbname=' . $this->name . ';host=' . $this->host;
		try {
			$connect = new PDO($dsn, $this->user, $this->pass);
		} catch (PDOException $e){
			if(!defined('oAPP_MODE') || oAPP_MODE == '' || oAPP_MODE == 'off'){
				exit('ZE503: Error Occurred');
			}
			else {
				exit('Connection Failed: ('.$e->getMessage().')');
			}
		}
		$this->pdo = $connect;
		return $this->pdo;
	}//******** END ********//


	//****** SQL RECORD [prepare SQL result] ******//
	private function record($stmt, $result, $query, $return)
	{
		if ($result === false) {
			return $this->errorSQL($stmt, $query);
		}
		else {
			if(is_array($result)){
				$output = array();
				if(count($result) == 1){
					$result = $result[0];
					if(is_array($return)){
						foreach($return as $column){
							if(array_key_exists($column, $result)){
								$output[$column] = $result[$column];
							}
						}
					}
					elseif(array_key_exists($return, $result)){
						$output[$return] = $result[$return];
					}
				}
				else {
					#ToDo
				}

				if(!empty($output)){return $output;}
			}
			else {
				#ToDo
			}

			return $result;
		}
	}//******** END ********//


	//****** SQL ERROR REPORTING [prepare & return SQL error] ******//
	private function errorSQL($stmt, $query, $report='oMSG')
	{
		$error = $stmt->errorInfo();
		$resp['oACT'] = 'F9';
		if($report == 'oMSG'){$resp['oERROR'] = $error[2];}
		else {$resp['oERROR'] = $error;}
		$resp['oQUERY'] = $query;
		return $resp;
	}//******** END ********//


	//****** SQL RESULT [return SQL result] ******//
	private function resultSQL($stmt, $query, $return)
	{
		if($return == 'oBOOL'){return true;}
		else {
			$record = $stmt->fetchAll(PDO::FETCH_ASSOC);
			if(empty($record)){return 'oNORECORD';}
			else {
				if($return == 'oNUMROW'){
					return $stmt->rowCount();
				}
				elseif($return == 'oRECORD'){
					if(is_array($record) && count($record) == 1){$record = $record[0];}
					return $record;
				}
				elseif($return == 'oRESULTSET'){
					return $record;
				}
				else {
					return $this->record($stmt, $record, $query, $return);
				}
			}
		}
	}//******** END ********//


	//****** SQL CONDITION [prepare SQL condition statement] ******//
	private function conditionSQL(array $filter, $operator='=')
	{
		if(!empty($filter) && !empty($operator)){
			$query = '';
			foreach ($filter as $key => $value) {
				if (!empty($filter[$key])) {
					$query .= " `" . $key . "` {$operator} '" . $value . "' AND";
				}
			}
			if(!empty($query)){
				$query = rtrim($query, ' AND');
			}
			return $query;
		}
		return false;
	}//******** END ********//


	//****** SQL COLUMN [prepare SQL column statement] ******//
	private function columnSQL($column)
	{
		if(!empty($column)){
			$query = '';

			#prepare column(s)
			$coln = '';
			if (is_array($column)) {
				foreach ($column as $col) {
					$coln .= '`' . $col . "`, ";
				}
				$coln = rtrim($coln, ', ');
			} elseif (is_string($column)) {
				$coln = $column;
			}

			$query = $coln;
			return $query;
		}
		return false;
	}//******** END ********//


	//****** SQL GUID [prepare SQL insert GID statement] ******//
	public function insertGID($table)
	{
		if($table == 'oUSERZ_TABLE'){$table = $this->userz;}
		if(!empty($table)){
			$puid = randomiz('oPUID'); $ruid = randomiz('oRUID');
			$query = "INSERT INTO `{$table}` SET `PUID` = '{$puid}', `RUID` = '{$ruid}'";
			$o['oSQL'] = $query; $o['RUID'] = $ruid; $o['PUID'] = $puid;
			return $o;
		}
		return false;
	}//******** END ********//


	//-------------- Select record using Bind ---------------
	public function select($column, string $table, $condition, $limit, $return='oRECORD')
	{
		if($table == 'oUSERZ_TABLE'){$table = $this->userz;}
		if(!empty($table) && !empty($column) && !empty($condition)){
			$table = oInput::clean($table);

			#prepare column(s)
			$coln = $this->columnSQL($column);

			if(!empty($coln)){
				$pdo = $this->pdo;
				$query = "SELECT {$coln} FROM `{$table}`";

				#prepare condition
				if($condition != 'NO_COND'){
					$query .= " WHERE ";
					if(is_string($condition)){$query .= " {$condition}";}
					elseif(is_array($condition)){
						$param = ''; $datalist = array();
						foreach ($condition as $key => $value) {
							$param .= $key . ' = :' . $key . ' AND ';
							$datalist[':' . $key] = $value;
						}
						$param = rtrim($param, ' AND');
						$query .= " {$param}";
					}
				}

				#prepare limit
				if($limit != 'NO_LIMIT'){$query .= " LIMIT {$limit}";}

				$stmt = $pdo->prepare($query);
				$run = $stmt->execute($datalist);

				if ($run !== false) {
					if($return == 'oBOOL'){return true;}
					else {
						return $this->resultSQL($stmt, $query, $return);
					}
				}
				else {
					return $this->errorSQL($stmt, $query);
				}
				return $run;
			}
		}
		return false;
	}


	//****** RUN SQL [for query with resultset] ******//
	public function runSQL(string $query, $return='oRECORD')
	{
		if(!empty($query)){
			$pdo = $this->pdo;
			if(oText::in($query, 'oUSERZ_TABLE')){
				$query = oText::swap($query, 'oUSERZ_TABLE', $this->userz);
			}
			$stmt = $pdo->prepare($query);
			$run = $stmt->execute();
			if ($run !== false) {
				if($return == 'oBOOL'){return true;}
				elseif($return == 'oNUMROW'){
					return $stmt->rowCount();
				}
				else {
					$record = $stmt->fetchAll(PDO::FETCH_ASSOC);
					if(!empty($record)){
						if($return == 'oRECORD'){
							if(is_array($record) && count($record) == 1){$record = $record[0];}
							return $record;
						}
						elseif($return == 'oRECORDSET'){
							return $record;
						}
						else {
							return $this->record($stmt, $record, $query, $return);
						}
					}
					else {
						return 'oNORECORD';
					}
				}
			}
			else {
				return $this->errorSQL($stmt, $query);
			}
			return $run;
		}
		return false;
	}//******** END ********//


	//****** INSERT SQL [insert new record] ******//
	public function insertSQL(string $table, array $data)
	{
		if($table == 'oUSERZ_TABLE'){$table = $this->userz;}
		if (!empty($table) && !empty($data)) {
			$table = oInput::clean($table); #cleanup

			#prepare GID
			$puid = randomiz('oPUID');
			$ruid = randomiz('oRUID');
			$column = 'PUID, RUID, ';
			$param = ':PUID, :RUID, ';
			$datalist = array (':PUID' => $puid, ':RUID' => $ruid);

			#prepare query
			foreach ($data as $key => $value){
				#$query = ", `" . $key . "` = '" . $value . "'";  #[Changed to BIND PARAMETERS]
				$column .= $key.', ';
				$param .= ':'.$key . ', ';
				$datalist[':'.$key] = $value;
			}
			$column = oText::trimEdge($column, ',');
			$param = oText::trimEdge($param, ',');

			$resp = array();

			$pdo = $this->pdo;
			$query = "INSERT INTO `{$table}` ({$column}) VALUES({$param})";
			$stmt = $pdo->prepare($query);
			$run = $stmt->execute($datalist);
			if($run !== false) {
				$resp['oACT'] = 'OK';
				$resp['oROWS'] = $stmt->rowCount();
				$resp['oID'] = $pdo->lastInsertId();
			}
			else {
				$resp['oACT'] = 'F9';
				$resp['oERROR'] = $stmt->errorInfo()[2];
			}
			return $resp;
		}
		return false;
	}//******** END ********//


	//****** CREATE RECORD ******//
	public function createSQL(string $table, array $data, $return='oBOOL')
	{
		if($table == 'oUSERZ_TABLE'){$table = $this->userz;}
		if (!empty($table) && !empty($data)) {
			$table = oInput::clean($table); #cleanup
			$insertGID = $this->insertGID($table); #prepare GID
			$query = $insertGID['oSQL'];
			foreach ($data as $key => $value){
				$query .= ", `".$key. "` = '" .$value."'";
				if(is_array($return) && in_array($key, (array)$return)){
					$row[$key] = $value;
				}
				elseif($return == $key){$row[$key] = $value;}
			}
			$result = $this->runSQL($query, $return);
			if(!isset($result['oERROR']) && $result !== false){
				if($return == 'oBOOL'){return true;}
				elseif($return == 'PUID' || $return == 'RUID'){return $insertGID[$return];}
				elseif(!empty($row)){
					if(in_array('PUID', (array)$return)){$row['PUID'] = $insertGID['PUID'];}
					if(in_array('RUID', (array)$return)){$row['RUID'] = $insertGID['RUID'];}
					return $row;
				}
			}
			return $result;
		}
		return false;
	}//******** END ********//


	//****** UPDATE RECORD ******//
	public function updateSQL(string $table, array $data, $condition, $limit=1, $return='oNUMROW') #return [oBOOL|oNUMROW]
	{
		if($table == 'oUSERZ_TABLE'){$table = $this->userz;}
		if (!empty($data) && !empty($table) && !empty($condition)) {
			$table = oInput::clean($table);
			$query = "UPDATE `{$table}` SET ";

			#data to be updated
			foreach ($data as $key => $value) {
				if (!empty($data[$key])) {
					$query .= "`{$key}` = '{$value}', ";
				}
			}
			$query = rtrim($query, ', ');

			#prepare condition
			if($condition != 'NO_COND'){
				$query .= " WHERE ";
				if(is_string($condition)){$query .= " {$condition}";}
				elseif(is_array($condition)){$query .= $this->conditionSQL($condition);}
			}

			#prepare limit
			if($limit != 'NO_LIMIT'){$query .= " LIMIT {$limit}";}

			#Run & Return query
			return $this->runSQL($query, $return);
		}
		return false;
	}//******** END ********//


	//****** DELETE RECORD ******//
	public function deleteSQL(string $table, $condition, $limit=1, $return='oNUMROW')
	{
		if($table == 'oUSERZ_TABLE'){$table = $this->userz;}
		if (!empty($table) && !empty($condition) && !empty($limit)) {
			$table = oInput::clean($table);
			$query = "DELETE FROM `{$table}`";

			#prepare condition
			if($condition != 'NO_COND'){
				$query .= " WHERE ";
				if(is_string($condition)){$query .= " {$condition}";}
				elseif(is_array($condition)){$query .= $this->conditionSQL($condition);}
			}

			#prepare limit
			if($limit != 'NO_LIMIT'){$query .= " LIMIT {$limit}";}

			#Run & Return query
			return $this->runSQL($query, $return);
		}
		return false;
	}//******** END ********//


	//****** SELECT RECORD ******//
	public function selectSQL($column, string $table, $condition, $limit, $return='oRECORD')
	{
		if($table == 'oUSERZ_TABLE'){$table = $this->userz;}
		if (!empty($column) && !empty($table) && !empty($condition)) {
			$table = oInput::clean($table);

			#prepare column(s)
			$coln = $this->columnSQL($column);

			if(!empty($coln)){
				$query = "SELECT {$coln} FROM `{$table}`";

				#prepare condition
				if($condition != 'NO_COND'){
					$query .= " WHERE ";
					if(is_string($condition)){$query .= " {$condition}";}
					elseif(is_array($condition)){$query .= $this->conditionSQL($condition);}
				}

				#prepare limit
				if($limit != 'NO_LIMIT'){$query .= " LIMIT {$limit}";}

				#Run & Return query;
				return $this->runSQL($query, $return);
			}
		}
		return false;
	}//******** END ********//


	//****** READ RECORD ******//
	public function readSQL($column, string $table, $filterLabel, $filterValue, $limit, $return='oRECORD')
	{
		if($table == 'oUSERZ_TABLE'){$table = $this->userz;}
		if(!empty($column) && !empty($table) && !empty($filterLabel) && !empty($filterValue)){
			$condition ="`{$filterLabel}` = '{$filterValue}'";
			return $this->selectSQL($column, $table, $condition, $limit, $return);
		}
		return false;
	}//******** END ********//


	//****** DELETE ALL RECORD ******//
	public function removeAll(string $table, $limit='NO_LIMIT')
	{
		if($table == 'oUSERZ_TABLE'){$table = $this->userz;}
		if(!empty($table)){
			return $this->deleteSQL($table, 'NO_COND', $limit);
		}
		return false;
	}//******** END ********//


	//****** TRUNCATE ALL RECORD [just like delete all but reset table] ******//
	public function expunge(string $table)
	{
		if($table == 'oUSERZ_TABLE'){$table = $this->userz;}
		if (!empty($table)) {
			$name = oInput::clean($table);
			$query = "TRUNCATE `{$table}`";
			$pdo = $this->pdo;
			$o = $pdo->exec($query);
			if($o === false && $o != 0){
				return $this->errorSQL($pdo, $query);
			}
			return true;
		}
		return false;
	}//******** END ********//


	//****** CREATE DATABASE ******//
	public function createDB($database, $subtle = 'YEAP')
	{
		if(!empty($database) && !is_array($database)){
			$name = (string)$database;
			$name = oInput::clean($name);
			if($subtle != 'YEAP'){
				$query = "CREATE DATABASE `{$database}`";
			} else {
				$query = "CREATE DATABASE IF NOT EXISTS `{$database}`";
			}
			$pdo = $this->pdo;
			$o = $pdo->exec($query);
			if($o === false){return $this->errorSQL($pdo, $query);}
			return true;
		}
		return false;
	}//******** END ********//


	//****** DROP DATABASE ******//
	public function deleteDB(string $database, $subtle = 'YEAP')
	{
		if(!empty($database)){
			$name = oInput::clean($database);
			if ($subtle != 'YEAP') {
				$query = "DROP DATABASE `{$database}`";
			} else {
				$query = "DROP DATABASE IF EXISTS `{$database}`";
			}
			$pdo = $this->pdo;
			$o = $pdo->exec($query);
			if($o === false){return $this->errorSQL($pdo, $query);}
			return true;
		}
		return false;
	}//******** END ********//


	//****** DISCONECT DATABASE ******//
	public function disconnect()
	{
		unset($this->name);
		unset($this->user);
		unset($this->pass);
		unset($this->host);
		unset($this->userz);
		unset($this->pdo);
		return;
	}//******** END ********//
}
?>