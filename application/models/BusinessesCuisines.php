<?php
/**
 * Modelo para el tipo de comida de un negocio
 *
 */
class Application_Model_BusinessesCuisines extends Zend_Db_Table_Abstract {
	protected $_name = 'businesses_cuisines';
	protected $_primary = 'id_businesses_cuisines';
	/**
	 * Metodo para agregar el tipo de cocina de un restaurante
	 * @param unknown $id_biz
	 * @param unknown $id_cuisine
	 */
	public function newBizCuisine($id_biz, $id_cuisine) {
		$data = array(
				'id_businesses' => $id_biz,
				'id_cuisine' => $id_cuisine
		);
		$newcuisine = $this->createRow();
		$newcuisine->setFromArray($data);
		$newcuisine->save();
	}
}