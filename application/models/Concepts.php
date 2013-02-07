<?php
/**
 * Modelo para los conceptos de negocio
 *
 */
class Application_Model_Concepts extends Zend_Db_Table_Abstract {
	protected $_name = 'concepts';
	protected $_primary = 'id_concepts';
	
	public function getConcepts() {
		return $this->fetchAll();
	}
}
	
	