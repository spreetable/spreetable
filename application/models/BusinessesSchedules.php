<?php
/**
 * Modelo para el horario de los negocios
 *
 */
class Application_Model_BusinessesSchedules extends Zend_Db_Table_Abstract {
	protected $_name = 'businesses_schedules';
	protected $_primary = 'id_businesses_schedules';
	/**
	 * Metodo para guardar el horario de un negocio
	 * @param int $id_biz
	 * @param array $schedule
	 */
	public function newBizschedule($id_biz, $schedule) {
		$data = array(
					'id_businesses' => $id_biz,
					'monday' => $schedule['monopened'].'-'.$schedule['monclosed'],
					'tuesday' => $schedule['tuesopened'].'-'.$schedule['tuesclosed'],
					'wednesday' => $schedule['wedopened'].'-'.$schedule['wedclosed'],
					'thursday' => $schedule['thuopened'].'-'.$schedule['thuclosed'],
					'friday' => $schedule['friopened'].'-'.$schedule['friclosed'],
					'saturday' => $schedule['satopened'].'-'.$schedule['satclosed'],
					'sunday' => $schedule['sunopened'].'-'.$schedule['sunclosed'],
				);
		$newschedule = $this->createRow();
		$newschedule->setFromArray($data);
		$newschedule->save();
	}
	/**
	 * Metodo para retornar un array con las horas para el horario de los negocios
	 * @return array
	 */
	public function getSchedule() {
		$schedule = array(
						'',
						'cerrado',
						'05:00am',
						'05:30am',
						'06:00am',
						'06:30am',
						'07:00am',
						'07:30am',
						'08:00am',
						'08:30am',
						'09:00am',
						'09:30am',
						'10:00am',
						'10:30am',
						'11:00am',
						'11:30am',
						'12:00pm',
						'12:30pm',
						'01:00pm',
						'01:30pm',
						'02:00pm',
						'02:30pm',
						'03:00pm',
						'03:30pm',
						'04:00pm',
						'04:30pm',
						'05:00pm',
						'05:30pm',
						'06:00pm',
						'06:30pm',
						'07:00pm',
						'07:30pm',
						'08:00pm',
						'08:30pm',
						'09:00pm',
						'09:30pm',
						'10:00pm',
						'10:30pm',
						'11:00pm',
						'11:30pm',
						'12:00am',
						'01:00am',
						'01:30am',
						'02:00am',
						'02:30am',
						'03:00am',
						'03:30am',
						'04:00am',
						'04:30am'					
				);
		return $schedule;
	}
}