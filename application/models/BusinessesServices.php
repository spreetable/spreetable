<?php
/**
 * Modelo para el tipo de servicios de un negocio
 *
 */
class Application_Model_BusinessesServices extends Zend_Db_Table_Abstract {
	protected $_name = 'businesses_services';
	protected $_primary = 'id_businesses_services';
	/**
	 * Metodo para agregar los servicios de un negocio
	 * @param int $id_biz
	 * @param array $ids_services
	 */
	public function newBizServices($id_biz, $ids_services) {
		foreach ($ids_services as $id_service) {
			$data = array(
					'id_service' => $id_service,
					'id_businesses' => $id_biz
			);
			$newservice = $this->createRow();
			$newservice->setFromArray($data);
			$newservice->save();
		}
	}
}