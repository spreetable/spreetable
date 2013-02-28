<?php
class BizController extends Zend_Controller_Action {

    public function init() {
       $this->_helper->layout->setLayout('layoutbiz');
    }
    public function indexAction() {
    	$modelBusinesses = new Application_Model_Businesses_Businesses();
    	$this->view->businesses = $modelBusinesses->getBusineses();
    	/*$location = $this->_helper->Client->GetClientLocation();
    	if(isset($_COOKIE['city'])) {
    		setcookie('city', 'Tijuanartre', null, '/');
    		echo $_COOKIE['city'];
    	} else {
    		setcookie('city', 'Rosarito', null, '/');
    		echo $_COOKIE['city'];
    	}*/
    }
    /**
     * Action para dar de alta un negocio nuevo
     */
    public function newAction() {
    	$auth = Zend_Auth::getInstance();
    	if (!$auth->hasIdentity())
    		return $this->_redirect('/user/login');
    	$form = new Application_Form_Businesses_New();
    	$this->view->form = $form;
    	if($this->getRequest()->isPost()) {
    		if($form->isValid($this->_getAllParams())) {
    			var_dump($this->_getAllParams());exit;
    			$modelBusinesses = new Application_Model_Businesses_Businesses();
    			if($modelBusinesses->businessExist($form->getValue('name')) == true) {
    				echo 'Ya existe este negocio';
    			} else {
    				$modelBusinesses->newBiz($form->getValues());
    			}
    		}
    	}
    }
    /**
     * Action para solicitar el perfil de un negocio
     */
    public function singupAction() {
    	
    }
    /**
     * Action para las peticiones de las zonas
     */
    public function getzonesAction() {
    	if($this->_hasParam('term')) {
    		$this->_helper->layout()->disableLayout();
	    	$this->_helper->viewRenderer->setNoRender(true);
	    	$modelZones = new Application_Model_Zones();
	    	echo Zend_Json::encode($modelZones->getZonesAutocomplete($this->getRequest()->getQuery('term')));
    	}
    }
    /**
     * Action para las peticiones de autocomplete de negocios existentes
     */
    public function getbusinessesAction() {
    	if($this->_hasParam('term')) {
    		$this->_helper->layout()->disableLayout();
    		$this->_helper->viewRenderer->setNoRender(true);
    		$modelBusinesses = new Application_Model_Businesses_Businesses();
    		echo Zend_Json::encode($modelBusinesses->getBusinessesAutocomplete($this->getRequest()->getQuery('term')));
    	}
    }
    /**
     * Action para verificar si un negocio existe
     */
    public function existbusinessAction() {
    	$this->_helper->layout()->disableLayout();
    	$this->_helper->viewRenderer->setNoRender(true);
    	$name = $this->getRequest()->getPost('name');
    	$modelBusinesses = new Application_Model_Businesses_Businesses();
    	if($modelBusinesses->businessExist($name) == true) {
    		$this->_response->setBody(json_encode(array('status' => true)));
    	} else {
    		$this->_response->setBody(json_encode(array('status' => false)));
    	}
    }
}

