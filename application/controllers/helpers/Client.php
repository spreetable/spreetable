<?php
class ActionHelper_Client extends Zend_Controller_Action_Helper_Abstract {
	public function init() {
	}
	/**
	 * Optiene la localizacion de el usuario
	 * @return mixed
	 */
	public function getClientLocation() {
		$client = new Zend_Http_Client('http://freegeoip.net/json/'.$this->getClientIp());
		$location = json_decode($client->request()->getRawBody());
		return $location;
	}
	/**
	 * Optiene la ip del usuario
	 * @return string
	 */
	public function getClientIp() {
		$ipaddress = '';
		if (getenv('HTTP_CLIENT_IP'))
			$ipaddress = getenv('HTTP_CLIENT_IP');
		else if(getenv('HTTP_X_FORWARDED_FOR'))
			$ipaddress = getenv('HTTP_X_FORWARDED_FOR');
		else if(getenv('HTTP_X_FORWARDED'))
			$ipaddress = getenv('HTTP_X_FORWARDED');
		else if(getenv('HTTP_FORWARDED_FOR'))
			$ipaddress = getenv('HTTP_FORWARDED_FOR');
		else if(getenv('HTTP_FORWARDED'))
			$ipaddress = getenv('HTTP_FORWARDED');
		else if(getenv('REMOTE_ADDR'))
			$ipaddress = getenv('REMOTE_ADDR');
		else
			$ipaddress = 'UNKNOWN';
		return $ipaddress;
	}
}