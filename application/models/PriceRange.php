<?php
/**
 * Modelo para los rangos de precios
 *
 */
class Application_Model_PriceRange extends Zend_Db_Table_Abstract {
	protected $_name = 'price_range';
	protected $_primary = 'id_price_range';
	
	public function getPriceRange() {
		return $this->fetchAll();
	}
}