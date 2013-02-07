<?php
/**
 * Modelo para los tipos de negocios
 *
 */
class Application_Model_TypesBusinesses extends Zend_Db_Table_Abstract {
	protected $_name = 'types_businesses';
	protected $_primary = 'id_types_businesses';
	
	public function getTypesBusinesses() {
		return $this->fetchAll();
	}
}
	
	