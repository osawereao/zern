<?php
/* ZERN™ Framework ~ an evolving, robust platform for rapid & efficient development of modem responsive applications and APIs;
 * Built by ODAO™ [www.osawere.com] using PHP, SQL, HTML, CSS, JS & derived technology.
 * © July 2019 | beta 1.0
 * ===================================================================================================================
 * Dependency » ~
 * PHP | data::zern ~ data handling
 */

class oData {
	public $totalRow;
	private $data;

	//****** CLASS CONSTRUCT  ******//
	public function __construct($data=''){
		if(!empty($data)){
			$this->data = $data;
			$this->set($data);
		}
		else {
			$this->data = '';
		}
		return;
	}


	//****** SET/POPULATE OBJECT PROPERTY [INFORMATION] ******//
	public function set($data){
		if(is_array($data)){
			/*when data has multiple rows per column*/
			if(isArrayMulti($data)){
				$this->totalRow = count($data);
				foreach ($data as $key => $values){
					if(is_array($values)){
						foreach ($values as $label => $value){
							if(empty($this->$label)){$this->$label = array();}
							$this->$label[$key] = $value;
						}
					}
					else {
						#/*THIS CASE SHOULD NEVER EXIST, as all single dimention arrays are treated below*/
						die('CLASS ERROR: DATA [#EN901]');
					}
				}
			}
			/*when data has multiple a single row*/
			else {
				$this->totalRow = 1;
				foreach ($data as $label => $value){
					if(is_array($value)){
						/*THIS CASE SHOULD NEVER EXIST, as all multi-dimentional arrays are treated above*/
						die('CLASS ERROR: DATA [#EN902]');
					}
					else {
						$this->$label = $value;
					}
				}
			}
		}
	} //****** END ******//


	//****** CHECK OBJECT for records ******//
	public function hasRecord(){
		if(empty($this->data) || empty($this->totalRow) || $this->totalRow == 0){return false;}
		return true;
	}

	//****** FIND [oDATA] KEY IN ARRAY & RETURN AS [Array of Rows] $data[] ******//
	public function toRow(array $data)
	{
		$row = '';
		if(!empty($data)){
			if(isset($data['oDATA'])){$row = $data['oDATA'];}
		}
		return $row;
	} //****** END ******//


	//****** GET PROPERTY INFORMATION ******//
	public function obtain($property, $seprator=' ')
	{
		if(!empty($property)){
			if(!is_array($property) && isset($this->$property)){return $this->$property;}
			elseif(is_array($property)){
				$resolve = '';
				foreach ($property as $column){
					if(isset($this->$column)){$resolve .= $this->$column.$seprator;}
				}
				if(!empty($resolve)){
					$resolve = rtrim($resolve, $seprator);
					return $resolve;
				}
			}
		}
		return false;
	} //****** END ******//


	//****** GET COLUMN INFORMATION, from ARRAY ******//
	public function filter($column, array $data)
	{
		if(!empty($column) && !empty($data)){
			if(isset($data[$column])){return $data[$column];}
		}
		return false;
	} //****** END ******//
}
?>