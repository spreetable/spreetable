<?php
class Application_Form_UserLogin extends Zend_Form {
	/**
	 * Formulario para iniciar sesion
	 */
	public function init() {
		$email = new Zend_Form_Element_Text('email', array(
				'label' => 'Correo electronico',
				'required' => true
		));
		$password = new Zend_Form_Element_Password('password', array(
				'label' => 'Password',
				'required' => true
		));
		$submit = new Zend_Form_Element_Submit('Entrar');
		$this->addElements(array($email, $password, $submit));
	}
}