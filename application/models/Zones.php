<?php
/**
 * Modelo para las zonas
 *
 */
class Application_Model_Zones extends Zend_Db_Table_Abstract {
	protected $_name = 'zones';
	protected $_primary = 'id_zones';
	/**
	 * Metodo para retornar zonas existentes para autocomplete
	 * @param string $term
	 * @return array
	 */
	public function getZonesAutocomplete($term) {
		$selct = $this->select()->where('name LIKE ?',"%$term%");
		$zones = array();
		foreach ( $this->fetchAll($selct) as $zone) {
			$zones[] = $zone->name;
		}
		return $zones;
	}
	/**
	 * Metodo para ver si existe una zona, si no existe la crea
	 * @param string $name
	 * @return int
	 */
	public function zoneExist($name) {
		$name = strtolower($name);
		$select = $this->select()->where("name = '$name'");
		$zone = $this->fetchRow($select);
		if($zone) {
			return $zone->id_zones;
		} else {
			$data = array(
					'name' => strtolower($name),
					'status' => 'active'
					);
			$newzone = $this->createRow();
			$newzone->setFromArray($data);
			return $newzone->save();
		}
	}
}
	
	