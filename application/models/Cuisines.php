<?php
/**
 * Modelo para los tipos de pagos
 *
 */
class Application_Model_Cuisines extends Zend_Db_Table_Abstract {
	protected $_name = 'cuisines';
	protected $_primary = 'id_cuisines';
	
	public function getCuisines() {
		return $this->fetchAll();
	}
}
	
	