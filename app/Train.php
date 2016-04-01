<?php namespace App;

class Train extends Vehicle {

	public function get_type(){
		return "Train";
	}

	public function get_line_icon_url(){

		$line = $this->get_line();

		$icon_map = [
			'RD' => '/img/line-icons/red.svg',
			'OR' => '/img/line-icons/orange.svg',
			'YL' => '/img/line-icons/yellow.svg',
			'BL' => '/img/line-icons/blue.svg',
			'GR' => '/img/line-icons/green.svg',
			'SV' => '/img/line-icons/silver.svg'
		];

		if (isset($icon_map[$this->get_line()])){
			return $icon_map[$this->get_line()];
		}

	}

	public function get_type_icon(){

	}

	public function get_destination(){

		if (isset($this->data->DestinationName)){
			return $this->data->DestinationName;
		}

	}

	public function get_line(){

		if (isset($this->data->Line)){
			return $this->data->Line;
		}

	}

	public function get_location(){

		if (isset($this->data->LocationName)){
			return $this->data->LocationName;
		}

	}

	public function get_arrival(){

		if (isset($this->data->Min)){

			$arrival = $this->data->Min;

			if (is_numeric($arrival)){
				return $arrival . ' Mins';
			}

			else {
				return $arrival;
			}

		}

	}

}
