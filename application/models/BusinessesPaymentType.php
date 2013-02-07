<?php
/**
 * Modelo para el tipo de pago de los negociosos
 *
 */
class Application_Model_BusinessesPaymentType extends Zend_Db_Table_Abstract {
	protected $_name = 'businesses_payment_type';
	protected $_primary = 'id_businesses_payment_type';
	/**
	 * Metodo para agregar los tipos de pago que acepta un negocio
	 * @param int $id_biz
	 * @param array $ids_payment_type
	 */
	public function newBizPaymentType($id_biz, $ids_payment_type) {
		foreach ($ids_payment_type as $id_payment_type) {
			$data = array(
				'id_payment_type' => $id_payment_type,
				'id_businesses' => $id_biz
			);
			$newpaymenttype = $this->createRow();
			$newpaymenttype->setFromArray($data);
			$newpaymenttype->save();
		}
	}
}