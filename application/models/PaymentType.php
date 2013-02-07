<?php
/**
 * Modelo para los tipos de pagos
 *
 */
class Application_Model_PaymentType extends Zend_Db_Table_Abstract {
	protected $_name = 'payment_type';
	protected $_primary = 'id_payment_type';
	
	public function getPaymentTypes() {
		return $this->fetchAll();
	}
}
	
	