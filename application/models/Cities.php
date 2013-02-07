<?php
/**
 * Modelo para las ciudades
 *
 */
class Application_Model_Cities extends Zend_Db_Table_Abstract {
	protected $_name = 'cities';
	protected $_primary = 'id_cities';
	
	public function getCities() {
		return $this->fetchAll();
	}
}
	
	