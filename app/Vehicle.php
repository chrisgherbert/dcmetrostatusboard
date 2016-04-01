<?php namespace App;

abstract class Vehicle {

	protected $data;

	public function __construct($data){
		$this->data = $data;
	}

	abstract public function get_type();
	abstract public function get_type_icon();
	abstract public function get_line();
	abstract public function get_destination();
	abstract public function get_location();
	abstract public function get_arrival();

	public function get_line_color(){

		$colors_map = array(
			'RD' => '#92113E', // Red Line
			'OR' => '#C27246', // Orange Line
			'SV' => '#898E8C', // Silver Line
			'BL' => '#41728A', // Blue Line
			'YL' => '#DAC463', // Yellow Line
			'GR' => '#009967' // Green Line
		);

		$line = $this->get_line();

		if (isset($colors_map[$line])){
			return $colors_map[$line];
		}
		// Fallback color
		else {
			return '#D6D9D0';
		}

	}

	/**
	 * Checks if the vehicle is arriving in two minutes or less
	 * @return boolean True if arriving in two minutes or less
	 */
	public function is_arriving_soon(){

		$arrival = $this->get_arrival();

		if ($arrival == null){
			return false;
		}
		else if ($arrival == 'Arr' || $arrival < 2){
			return true;
		}
		else {
			return false;
		}

	}

	protected function get_caution_icon_url(){
		return '/img/caution-icon.svg';
	}

}
