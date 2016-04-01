<?php namespace App;

class TrainStation {

	protected $id;

	/**
	 * @param string $id Station ID used by the WMATA API
	 */
	public function __construct($id){
		$this->id = $id;
	}

	public function get_trains(){

		$api_data = $this->get_api_data();

		if ($api_data){
			return $this->create_train_objects($api_data);
		}

	}

	///////////////
	// Protected //
	///////////////

	/**
	 * Get train station information from the WMATA API
	 * @return array|null
	 */
	protected function get_api_data(){

		$base_url = 'https://api.wmata.com/StationPrediction.svc/json/GetPrediction/';
		$id = $this->id;

		$query = http_build_query([
			'api_key' => getenv('WMATA_API_KEY')
		]);

		$request_url = "$base_url$id?$query";

		$response = file_get_contents($request_url);

		if ($response){
			return json_decode($response);
		}

	}

	protected function create_train_objects($api_data){

		if (!isset($api_data->Trains)){
			return false;
		}

		$trains_data = $api_data->Trains;

		$train_objects = [];

		if ($trains_data && is_array($trains_data)){

			foreach ($trains_data as $train_data){

				$train = new Train($train_data);

				$train_objects[] = $train;

			}

		}

		return $train_objects;

	}

}
