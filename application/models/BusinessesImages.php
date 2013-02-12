<?php
/**
 * Modelo para los negocios
 *
 */
class Application_Model_BusinessesImages extends Zend_Db_Table_Abstract {
	protected $_name = 'businesses_images';
	protected $_primary = 'id_businesses_images';
	/**
	 * Metodo para guardar una nueva imagen de un negocio
	 * @param array $data
	 * @return true|false
	 */
	public function save($data) {
		$newimage = $this->createRow();
		$newimage->setFromArray($data);
		return $newimage->save();
	}
}