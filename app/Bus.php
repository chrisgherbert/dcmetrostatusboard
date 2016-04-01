<?php namespace App;

class Bus extends Vehicle {

	public function get_line_icon_url(){
		return false;
	}

	public function get_type(){
		return "Bus";
	}

	public function get_type_icon(){
		return "this should be an icon";
	}

	public function get_destination(){

		if (isset($this->data->DirectionText)){
			return $this->data->DirectionText;
		}

	}

	public function get_line(){

		if (isset($this->data->RouteID)){
			return $this->data->RouteID;
		}

	}

	public function get_location(){

		if (isset($this->data->StopName)){
			return $this->data->StopName;
		}

	}

	public function get_arrival(){

		if (isset($this->data->Minutes)){

			$arrival = $this->data->Minutes;

			if (is_numeric($arrival)){
				return $arrival . ' Mins';
			}

			else {
				return $arrival;
			}

		}

	}

}
