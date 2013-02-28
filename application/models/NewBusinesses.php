<?php
/**
 * Modelo para los nuevos negocios
 *
 */
class Application_Model_New_Businesses extends Zend_Db_Table_Abstract {
	protected $_name = 'new_businesses';
	protected $_primary = 'id_new_businesses';
	/**
	 * Metodo para agregar una notificacion de negocio nuevo para su revision
	 * @param int $id_biz
	 * @param int $id_user
	 */
	public function  newBizNotification($id_biz, $id_user) {
		$data = array(
				'id_user' => $id_user,
				'id_businesses' => $id_biz
		);
		$newBiz = $this->createRow();
		$newBiz->setFromArray($data);
		$newBiz->save();
	}
}