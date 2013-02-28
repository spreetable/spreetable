<?php
class UserController extends Zend_Controller_Action {

    public function init() {
    }
    /**
     * Action para registrar un nuevo usuario
     */
    public function newAction() {
    	$auth = Zend_Auth::getInstance();
    	if ($auth->hasIdentity())
    		return $this->_redirect('/user/login');
    	$form = new Application_Form_Users_New();
    	$this->view->form = $form;
    	if($this->getRequest()->isPost()) {
    		if($form->isValid($this->_getAllParams())) {
    			$modelUser = new Application_Model_Users_Users();
    			if($modelUser->emailExist($form->getValue('email')) == true) {
    				echo 'Ya hay un usario registrado con este correo';
    			} elseif (strlen($form->getValue('pass')) < 6 ) {
    				echo 'La contraseña debe de tener al menos 6 letras';
    			} elseif (filter_var($form->getValue('email'), FILTER_VALIDATE_EMAIL) == false) {
    				echo 'Tiene que ser un correo valido';
    			} else {
    				$idUser = $modelUser->newUser($form->getValues());
    				if($form->getValue('cuisines')) {
    					$modelFavoriteCuisines = new Application_Model_Users_Favorite_Cuisines();
    					$modelFavoriteCuisines->newFavoriteCuisines($idUser, $form->getValue('cuisines'));
    				}
    			}
    		}
    	}
    }
    /**
     * Action para login de usuario
     */
    public function loginAction() {
    	$auth = Zend_Auth::getInstance();
    	if ($auth->hasIdentity()) {
    		return $this->_redirect('/');
    	}
    	$auth = Zend_Auth::getInstance();
    	$form =  new Application_Form_Users_Login();
    	if($this->getRequest()->isPost()) {
    		if($form->isValid($this->_getAllParams())) {
    			$modelUser = new Application_Model_Users_Users();
    			$idUser = $modelUser->getIdUserByEmail($form->getValue('email'));
    			$authAdapter = new Zend_Auth_Adapter_DbTable();
    			$authAdapter
    			->setTableName('users')
    			->setIdentityColumn('id_users')
    			->setCredentialColumn('password');
    			$authAdapter
    			->setIdentity($idUser)
    			->setCredential(sha1($form->getValue('password')));
    			$auth = Zend_Auth::getInstance();
    			$credential = $auth->authenticate($authAdapter);
    			if($credential->isValid()) {
    				return $this->_redirect('/');
    			} else {
    				echo 'Usuario o password erroneo';
    			}
    		}
    	}
    	$this->view->form = $form;
    }
    /**
     * Action para desloguearse
     */
    public function logoutAction() {
    	Zend_Auth::getInstance()->clearIdentity();
    	return $this->_redirect('/');
    }
}