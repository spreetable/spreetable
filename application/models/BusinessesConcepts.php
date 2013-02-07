<?php
/**
 * Modelo para el concepto del negocio
 *
 */
class Application_Model_BusinessesConcepts extends Zend_Db_Table_Abstract {
	protected $_name = 'businesses_concepts';
	protected $_primary = 'id_businesses_concepts';
	/**
	 * Metodo para agregar el concepto o los conceptos a un negocio
	 * @param int $id_biz
	 * @param int $id_concept
	 */
	public function newBizConcept($id_biz, $id_concept) {
		$data = array(
					'id_businesses' => $id_biz,
					'id_concept' => $id_concept
				);
		$newconcept = $this->createRow();
		$newconcept->setFromArray($data);
		$newconcept->save();
	}
}