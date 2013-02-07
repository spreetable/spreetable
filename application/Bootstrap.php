<?php

class Bootstrap extends Zend_Application_Bootstrap_Bootstrap {
	protected function _initControllerHelpers() {
		Zend_Controller_Action_HelperBroker::addPath(APPLICATION_PATH . '/controllers/helpers', 'ActionHelper');
	}
}

