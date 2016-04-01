<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;

class StatusBoard extends Controller {

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show(Request $request)
	{

		$train_stations = $request->get('train_stations');
		$bus_stops = $request->get('bus_stops');

		$items = [];

		if ($train_stations && is_array($train_stations)){

			foreach ($train_stations as $train_station_id){

				$station = new \App\TrainStation($train_station_id);

				$trains = $station->get_trains();

				if ($trains){
					foreach ($trains as $train){
						$items[] = $train;
					}
				}

			}

		}

		if ($bus_stops && is_array($bus_stops)){

			foreach ($bus_stops as $bus_stop_id){

				$stop = new \App\BusStop($bus_stop_id);

				$buses = $stop->get_buses();

				if ($buses){
					foreach ($buses as $bus){
						$items[] = $bus;
					}
				}

			}

		}

		$data['title'] = 'Status Board WMATA';
		$data['items'] = $items;

		return view('status-board', $data);

	}

}
