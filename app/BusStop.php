<?php namespace App;

class BusStop {

	protected $id;

	public function __construct($id){
		$this->id = $id;
	}

	public function get_buses(){

		$api_data = $this->get_api_data();

		if ($api_data){
			return $this->create_bus_objects($api_data);
		}

	}

	///////////////
	// Protected //
	///////////////

	protected function get_api_data(){

		$base_url = 'https://api.wmata.com/NextBusService.svc/json/jPredictions';

		$query = http_build_query([
			'api_key' => getenv('WMATA_API_KEY'),
			'StopID' => $this->id
		]);

		$request_url = "$base_url?$query";

		$response = file_get_contents($request_url);

		if ($response){
			return json_decode($response);
		}

	}

	protected function create_bus_objects($api_data){

		if (!isset($api_data->Predictions)){
			return false;
		}

		$stop_name = $api_data->StopName;
		$buses_data = $api_data->Predictions;

		$bus_objects = [];

		if ($buses_data && is_array($buses_data)){

			foreach ($buses_data as $bus_data){

				$bus_data->StopName = $stop_name;

				$bus = new Bus($bus_data);

				$bus_objects[] = $bus;

			}

		}

		return $bus_objects;

	}

}
