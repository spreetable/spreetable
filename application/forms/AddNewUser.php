<?php
class Application_Form_AddNewUser extends Zend_Form {
	/**
	 * Formulario para agregar un nuevo usuario
	 */
	public function init() {
		//Campos requeridos
		$email = new Zend_Form_Element_Text('email', array(
				'label' => 'Correo electronico',
				'required' => true
		));
		$name = new Zend_Form_Element_Text('name', array(
				'label' => 'Nombre',
				'required' => true
		));
		$lastname = new Zend_Form_Element_Text('last_name', array(
				'label' => 'Apellidos',
				'required' => true
		));
		$pass = new Zend_Form_Element_Password('pass', array(
				'label' => 'Password',
				'required' => true
		));
		$pass->addDecorator('HtmlTag', array(
				'tag' => 'div',
				'class' => 'otherOptions',
				'openOnly' => true,
				'placement' => Zend_Form_Decorator_Abstract::APPEND
		));
		//Campos opcionales
		$gender = new Zend_Form_Element_Select('gender', array(
				'label' => 'Sexo'
		));
		$gender->addMultiOption('male', 'Hombre');
		$gender->addMultiOption('female', 'Mujer');
		$bio = new Zend_Form_Element_Textarea('bio', array(
				'label' => 'Cuentanos acerca de ti',
				'rows' => '5',
				'cols' => '19'
		));
		$cuisines = new Zend_Form_Element_MultiCheckbox('cuisines', array(
				'label' => 'Que tipo de comida te gusta?'
		));
		$modelCuisines = new Application_Model_Cuisines();
		$Cuisines = $modelCuisines->getCuisines();
		foreach ($Cuisines as $cuisine) {
			$cuisines->addMultiOption($cuisine->id_cuisines, $cuisine->cuisine);
		}
		$profilepicture = new Zend_Form_Element_File('profilepicture ');
		$profilepicture->setLabel('Selecciona una imagen: ')
		->setDestination(realpath(APPLICATION_PATH . "/../public/assets/img/user/profile/"));
		$profilepicture->addValidator('Count', false, 1);
		$profilepicture->addValidator('Extension', true, 'jpg, png');
		$profilepicture->addDecorator('HtmlTag', array(
    			'tag' => 'div',
    			'class' => 'otherOptions',
    			'closeOnly' => true,
    			'placement' => Zend_Form_Decorator_Abstract::APPEND
    	));
		$submit = new Zend_Form_Element_Submit('Guardar');
		$this->addElements(array(
				$email,
				$name,
				$lastname,
				$pass,
				$gender,
				$bio,
				$cuisines,
				$profilepicture,
				$submit
		));
	}
}