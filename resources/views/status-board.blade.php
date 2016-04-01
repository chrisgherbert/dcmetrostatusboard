<style>
	table {
		font-family: serif;
	}
	th, td {
		text-align: center;
	}
</style>

<table class="table table-striped" data-refresh-every-n-seconds="30">
	<thead>
		<tr>
			<th>Line</th>
			<th>Destination</th>
			<th>Station/Stop</th>
			<th>Arrival Time</th>
		</tr>
	</thead>
	<tbody>
		@foreach ($items as $item)
			<tr>
				<td>
					@if ($item->get_line_icon_url())
						<img src="{{ $item->get_line_icon_url() }}" width="40" height="40">
					@else
						{{ $item->get_line() }}
					@endif
				</td>
				<td>
					{{ $item->get_destination() }}
				</td>
				<td>
					{{ $item->get_location() }}
				</td>
				<td>
					{{ $item->get_arrival() }}
				</td>
			</tr>
		@endforeach
	</tbody>
</table>

