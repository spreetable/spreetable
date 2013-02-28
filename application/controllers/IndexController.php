<?php
class IndexController extends Zend_Controller_Action {

    public function init() {
        /* Initialize action controller here */
    }
    public function indexAction() {
    	$modelBusinesses = new Application_Model_Businesses_Businesses();
    	$this->view->businesses = $modelBusinesses->getBusineses();
    }
}

