<?php
/**
 * Modelo para los negocios
 *
 */
class Application_Model_Businesses extends Zend_Db_Table_Abstract {
	protected $_name = 'businesses';
	protected $_primary = 'id_businesses';
	
	public function getBusineses() {
		$select = $this->select();
		return $this->fetchAll($select);
	}
	/**
	 * Metodo para obtener un array de los negocios para el autocompletado
	 * @param string $term
	 * @return array
	 */
	public function getBusinessesAutocomplete($term) {
		$select = $this->select()->where('name LIKE ?',"%$term%");
		$zones = array();
		foreach ( $this->fetchAll($select) as $zone) {
			$zones[] = $zone->name;
		}
		return $zones;
	}
	/**
	 * Metodo para guardar un nuevo negocio
	 * @param array $data
	 * return int $id_business
	 */
	public function newBiz($data) {
		$auth = Zend_Auth::getInstance();
		$id_user = $auth->getIdentity();
		if($data['bizzone']) {
			$modelZones = new Application_Model_Zones();
			$id_zone = $modelZones->zoneExist($data['bizzone']);
			$data = array_merge($data, array('id_zone' => $id_zone));
		}
		$newbusiness = $this->createRow();
		$newbusiness->setFromArray($data);
		$id_biz = $newbusiness->save();
		//Notificacion de nuevo negocio registrado
		$newbiz = new Application_Model_NewBusinesses();
		$newbiz->newBizNotification($id_biz, $id_user);
		//Agrega el horario del negocio en caso de existir
		$schedule = new Application_Model_BusinessesSchedules();
		$schedule->newBizschedule($id_biz, $data);
		//Agregar el concepto del negocio actualmente solo 1
		if($data['bizconcepts']) {
			$concepts = new Application_Model_BusinessesConcepts();
			$concepts->newBizConcept($id_biz, $data['bizconcepts']);
		}
		//Agrega los tipos de pago
		if($data['bizpaymenttype']) {
			$paymenttype = new Application_Model_BusinessesPaymentType();
			$paymenttype->newBizPaymentType($id_biz, $data['bizpaymenttype']);
		}
		//Agregar los servicios del negocio
		if($data['bizservices']) {
			$service = new Application_Model_BusinessesServices();
			$service->newBizServices($id_biz, $data['bizservices']);
		}
		//Agregar el tipo de comida del negocio en caso de ser restaurante
		if($data['bizcuisines']) {
			$cuisine = new Application_Model_BusinessesCuisines();
			$cuisine->newBizCuisine($id_biz, $data['bizcuisines']);
		}
		//Agrega la imagen principal del negcio en caso de existir
		if($data['bizimage']) {
			$modelBusinessesImage = new Application_Model_BusinessesImages();
			$imageData = array(
					'image' => $data['bizimage'],
					'id_gallery' => 1,
					'id_businesses' => $id_biz
					);
			$modelBusinessesImage->save($imageData);
		}
		return $id_biz;
	}
	/**
	 * Metodo para verificar si existe o no un negocio
	 * @param string $name
	 * return true|false
	 */
	public function businessExist($name) {
		$select = $this->select()->where("name = '$name'");
		if($this->fetchRow($select)) {
			return true;
		} else {
			return false;
		}
	}
}
	
	