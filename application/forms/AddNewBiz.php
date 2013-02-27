<?php
class Application_Form_AddNewBiz extends Zend_Form {
	/**
	 * Formulario para agregar un nuevo negocio
	 */
	public function init() {
		$name = new Zend_Form_Element_Text('name', array(
				'label' => 'Nombre',
				'required' => true
		));
		$description = new Zend_Form_Element_Textarea('description', array(
				'label' => 'Describe el lugar',
				'rows' => '5',
				'cols' => '19'
		));
		$phone = new Zend_Form_Element_Text('phone', array(
				'label' => 'Telefono'
		));
		$facebook = new Zend_Form_Element_Text('facebook', array(
				'label' => 'Facebook'
		));
		$twitter = new Zend_Form_Element_Text('twitter', array(
				'label' => 'Twitter'
		));
		$googleplus = new Zend_Form_Element_Text('googleplus', array(
				'label' => 'GooglePlus'
		));
		$youtube = new Zend_Form_Element_Text('youtube', array(
				'label' => 'Youtube'
		));
		$webiste = new Zend_Form_Element_Text('website', array(
				'label' => 'Sitio web'
		));
		$capacity = new Zend_Form_Element_Text('capacity', array(
				'label' => '¿Cuantas personas caben?'
		));
		$anniversary = new Zend_Form_Element_Text('annyversary_date', array(
				'label' => '¿Cual es el aniversario del lugar?'
		));
		$coordinates = new Zend_Form_Element_Text('coordinates', array(
				'hidden' => true
		));
		$coordinates->addDecorator('HtmlTag', array(
    			'tag' => 'div',
    			'class' => 'otherOptions',
    			'openOnly' => true,
    			'placement' => Zend_Form_Decorator_Abstract::APPEND
    	));
		$address = new Zend_Form_Element_Text('address', array(
				'label' => 'Direccion'
		));
		//Rango de precios
		$pricerangeinitial = new Zend_Form_Element_Select('id_initial_price_range', array(
				'label' => 'Precios desde'
		));
		$pricerangefinal = new Zend_Form_Element_Select('id_final_price_range', array(
				'label' => 'Hasta'
		));
		$modelPriceRange = new Application_Model_PriceRange();
		$priceRange = $modelPriceRange->getPriceRange();
		$pricerangeinitial->addMultiOption('', '');
		$pricerangefinal->addMultiOption('', '');
		foreach ($priceRange as $price) {
			$pricerangeinitial->addMultiOption($price->id_price_range, $price->price);
			$pricerangefinal->addMultiOption($price->id_price_range, $price->price);
		}
		/*Horario del negocio */
		$modelSchedules = new Application_Model_BusinessesSchedules();
		$schedules = $modelSchedules->getSchedule();
		//Lunes
		$monopened = new Zend_Form_Element_Select('monopened', array(
				'label' => 'Lunes: ',
				'class' => 'mon',
				'placeholder' => 'Desde'
		));
		foreach ($schedules as $schedule) {
			$monopened->addMultiOption($schedule, $schedule);
		}
		$monclosed = new Zend_Form_Element_Select('monclosed', array(
				'class' => 'mon',
				'placeholder' => 'Hasta'
		));
		foreach ($schedules as $schedule) {
			$monclosed->addMultiOption($schedule, $schedule);
		}
		$monclosed->removeDecorator('Label');
		//Martes
		$tuesopened = new Zend_Form_Element_Select('tuesopened', array(
				'label' => 'Martes: ',
				'class' => 'tues',
				'placeholder' => 'Desde'
		));
		foreach ($schedules as $schedule) {
			$tuesopened->addMultiOption($schedule, $schedule);
		}
		$tuesclosed = new Zend_Form_Element_Select('tuesclosed', array(
				'class' => 'tues',
				'placeholder' => 'Hasta'
		));
		foreach ($schedules as $schedule) {
			$tuesclosed->addMultiOption($schedule, $schedule);
		}
		$tuesclosed->removeDecorator('Label');
		//Miercoles
		$wedopened = new Zend_Form_Element_Select('wedopened', array(
				'label' => 'Miercoles: ',
				'class' => 'wed',
				'placeholder' => 'Desde'
		));
		foreach ($schedules as $schedule) {
			$wedopened->addMultiOption($schedule, $schedule);
		}
		$wedclosed = new Zend_Form_Element_Select('wedclosed', array(
				'class' => 'mon',
				'placeholder' => 'Hasta'
		));
		foreach ($schedules as $schedule) {
			$wedclosed->addMultiOption($schedule, $schedule);
		}
		$wedclosed->removeDecorator('Label');
		//Jueves
		$thuopened = new Zend_Form_Element_Select('thuopened', array(
				'label' => 'Jueves: ',
				'class' => 'thu',
				'placeholder' => 'Desde'
		));
		foreach ($schedules as $schedule) {
			$thuopened->addMultiOption($schedule, $schedule);
		}
		$thuclosed = new Zend_Form_Element_Select('thuclosed', array(
				'class' => 'thu',
				'placeholder' => 'Hasta'
		));
		foreach ($schedules as $schedule) {
			$thuclosed->addMultiOption($schedule, $schedule);
		}
		$thuclosed->removeDecorator('Label');
		//Viernes
		$friopened = new Zend_Form_Element_Select('friopened', array(
				'label' => 'Viernes: ',
				'class' => 'fri',
				'placeholder' => 'Desde'
		));
		foreach ($schedules as $schedule) {
			$friopened->addMultiOption($schedule, $schedule);
		}
		$friclosed = new Zend_Form_Element_Select('friclosed', array(
				'class' => 'fri',
				'placeholder' => 'Hasta'
		));
		foreach ($schedules as $schedule) {
			$friclosed->addMultiOption($schedule, $schedule);
		}
		$friclosed->removeDecorator('Label');
		//Sabado
		$satopened = new Zend_Form_Element_Select('satopened', array(
				'label' => 'Sabado: ',
				'class' => 'sat',
				'placeholder' => 'Desde'
		));
		foreach ($schedules as $schedule) {
			$satopened->addMultiOption($schedule, $schedule);
		}
		$satclosed = new Zend_Form_Element_Select('satclosed', array(
				'class' => 'sat',
				'placeholder' => 'Hasta'
		));
		foreach ($schedules as $schedule) {
			$satclosed->addMultiOption($schedule, $schedule);
		}
		$satclosed->removeDecorator('Label');
		//Domingo
		$sunopened = new Zend_Form_Element_Select('sunopened', array(
				'label' => 'Domingo: ',
				'class' => 'sun',
				'placeholder' => 'Desde'
		));
		foreach ($schedules as $schedule) {
			$sunopened->addMultiOption($schedule, $schedule);
		}
		$sunclosed = new Zend_Form_Element_Select('sunclosed', array(
				'class' => 'sun',
				'placeholder' => 'Hasta'
		));
		foreach ($schedules as $schedule) {
			$sunclosed->addMultiOption($schedule, $schedule);
		}
		$sunclosed->removeDecorator('Label');
		/* Termina Horario de negocio */
		$businessestype = new Zend_Form_Element_Select('id_businesses_type', array(
				'label' => 'Tipo de negocio',
				'required' => true
				));
		$modelTypesBusinesses = new Application_Model_TypesBusinesses();
		$BusinessesTypes = $modelTypesBusinesses->getTypesBusinesses();
		foreach ($BusinessesTypes as $BusinessesType) {
			$businessestype->addMultiOption($BusinessesType->id_types_businesses, $BusinessesType->type);
		}
		$cities = new Zend_Form_Element_Select('id_city', array(
				'label' => 'Ciudad',
				'required' => true
				));
		$zone = new Zend_Form_Element_Text('bizzone', array(
				'label' => 'Zona'
		));
		$modelCities = new Application_Model_Cities();
		$Cities = $modelCities->getCities();
		foreach ($Cities as $city) {
			$cities->addMultiOption($city->id_cities, $city->name);
		}
		$paymenttype = new Zend_Form_Element_MultiCheckbox('bizpaymenttype', array(
				'label' => 'Tipos de pagos'
				));
		$modelPaymentType = new Application_Model_PaymentType();
		$paymentTypes = $modelPaymentType->getPaymentTypes();
		foreach ($paymentTypes as $type) {
			$paymenttype->addMultiOption($type->id_payment_type, $type->type);
		}
		$services = new Zend_Form_Element_MultiCheckbox('bizservices', array(
				'label' => 'Servicios que ofrece'
		));
		$modelServices = new Application_Model_Services();
		$Services = $modelServices->getServices();
		foreach ($Services as $service) {
			$services->addMultiOption($service->id_services, $service->service);
		}
		$cuisines = new Zend_Form_Element_Select('bizcuisines', array(
				'label' => 'Tipo de Cocina'
		));
		$modelCuisines = new Application_Model_Cuisines();
		$Cuisines = $modelCuisines->getCuisines();
		$cuisines->addMultiOption('', '');
		foreach ($Cuisines as $Cuisine) {
			$cuisines->addMultiOption($Cuisine->id_cuisines, $Cuisine->cuisine);
		}
		$concepts = new Zend_Form_Element_Select('bizconcepts', array(
				'label' => 'Concepto del negocio'
		));
		$modelConcepts = new Application_Model_Concepts();
		$Concepts = $modelConcepts->getConcepts();
		$concepts->addMultiOption('', '');
		foreach ($Concepts as $Concept) {
			$concepts->addMultiOption($Concept->id_concepts, $Concept->concept);
		}
		$image = new Zend_Form_Element_File('bizimage');
		$image->setLabel('Selecciona una imagen: ');
		$image->addValidator('Count', false, 1);
		$image->addValidator('Extension', true, 'jpg, png');
		$image->addDecorator('HtmlTag', array(
    			'tag' => 'div',
    			'class' => 'otherOptions',
    			'closeOnly' => true,
    			'placement' => Zend_Form_Decorator_Abstract::APPEND
    	));
		$submit = new Zend_Form_Element_Submit('Guardar');

		$this->addElements(array(
				//Campos obligatorios
				$name,
				$cities,
				$businessestype,
				$cuisines,
				$zone,
				$address,
				$coordinates,
				//Campos opcionales
				$concepts,
				$pricerangeinitial,
				$pricerangefinal,
				$paymenttype,
				$services,
				$capacity,
				$monopened,
				$monclosed,
				$tuesopened,
				$tuesclosed,
				$wedopened,
				$wedclosed,
				$thuopened,
				$thuclosed,
				$friopened,
				$friclosed,
				$satopened,
				$satclosed,
				$sunopened,
				$sunclosed,
				$phone,
				$facebook,
				$twitter,
				$googleplus,
				$youtube,
				$webiste,
				$anniversary,
				$image,
				$submit
				));
	}
}