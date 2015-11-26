<table class="table table-striped">
	<thead>
		<tr>
			<th width="10%">{{ trans('receive_item.attributes.mix_no') }}</th>
			<th width="10%">{{ trans('receive_item.attributes.product_code' )}}</th>
			<th width="10%">{{ trans('receive_item.attributes.location_name') }}</th>
			<th>{{ trans('receive_item.attributes.product_description') }}</th>
			<th width="10%">{{ trans('receive_item.attributes.qty') }}</th>
			<th width="20%">{{ trans('receive_item.attributes.remark') }}</th>
		</tr>
	</thead>
	<tbody>
		@forelse($receiveItems as $receiveItem)
		
		<tr>
			<td>{{ $receiveItem->mix_no }}</td>
			<td>
				{{ $receiveItem->product_code }}
			</td>
			<td>{{ $receiveItem->location_name }}</td>
			<td>{!! $receiveItem->product_description !!}</td>
			<td>{{ $receiveItem->qty }}</td>
			<td>{{ $receiveItem->remark }}</td>
		</tr>

		@empty

		<tr>
			<td class="text-center text-danger" colspan="8">
				{{ trans('receive_item.label.empty_data') }}
			</td>
		</tr>

		@endforelse
	</tbody>
</table>