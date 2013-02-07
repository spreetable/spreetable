<?php
/**
 * Modelo para los servicios que ofrece el negocio
 *
 */
class Application_Model_Services extends Zend_Db_Table_Abstract {
	protected $_name = 'services';
	protected $_primary = 'id_services';
	
	public function getServices() {
		return $this->fetchAll();
	}
}
	
	