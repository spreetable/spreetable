<?php
/**
 * Modelo para las comidas favoritas de los usuarios
 *
 */
class Application_Model_UsersFavoriteCuisines extends Zend_Db_Table_Abstract {
	protected $_name = 'users_favorite_cuisines';
	protected $_primary = 'id_users_favorite_cuisines';
	/**
	 * Metodo para agregar o editar los tipos de comida del usuario
	 * @param array|int $cuisines
	 */
	public function newFavoriteCuisines($idUser, $cuisines) {
		$this->cleanFavoriteCuisines($idUser);
		foreach($cuisines as $cuisine) {
			$data = array(
					'id_user' => $idUser,
					'id_cuisine' => $cuisine
			);
			$favorite = $this->createRow();
			$favorite->setFromArray($data);
			$favorite->save();
		}
	}
	/**
	 * Metodo para limpiar las comidas favoritas de un usuario
	 * @param int $idUser
	 */
	public function cleanFavoriteCuisines($idUser) {
		$this->delete("id_user =  $idUser");
	}
}