<?php
/**
 * Modelo para los usuarios
 *
 */
class Application_Model_Users extends Zend_Db_Table_Abstract {
	protected $_name = 'users';
	protected $_primary = 'id_users';
	/**
	 * Metodo para guardar un nuevo usuario
	 * @param array $data
	 * return int $id_user
	 */
	public function newUser($data) {
		$data = array_merge(
					$data,
					array(
						'password' => sha1($data['pass']),
						'status' => 'active'
					)
				);
		$newuser = $this->createRow();
		$newuser->setFromArray($data);
		$id_user = $newuser->save();
		//Agregar tipo de cocina favorita
		return $id_user;
	}
	/**
	 * Metodo para verificar si existe o no un email
	 * @param string $name
	 * return true|false
	 */
	public function emailExist($email) {
		$select = $this->select()->where("email = '$email'");
		if($this->fetchRow($select)) {
			return true;
		} else {
			return false;
		}
	}
	public function getIdUserByEmail($email) {
		$select = $this->select()->where("email = '$email'");
		if($this->fetchRow($select)) {
			return $this->fetchRow($select)->id_users;
		}
		
	}
}