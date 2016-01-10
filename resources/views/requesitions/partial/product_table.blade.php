<div class="panel panel-default">
	<div class="panel-body">
		<table class="table table-striped">
			<thead>
				<tr>
					<th width="10%">{{ trans('requesition_item.attributes.mix_no') }}</th>
					<th width="10%">{{ trans('requesition_item.attributes.product_code' )}}</th>
					<th width="10%">{{ trans('requesition_item.attributes.location_name') }}</th>
					<th>{{ trans('requesition_item.attributes.product_description') }}</th>
					<th width="10">{{ trans('requesition_item.attributes.unit') }}</th>
					<th width="10%">{{ trans('requesition_item.attributes.qty') }}</th>
					<th width="20%">{{ trans('requesition_item.attributes.remark') }}</th>
				</tr>
			</thead>
			<tbody>
				@forelse($items as $item)
				
				<tr>
					<td>{{ $item->mix_no }}</td>
					<td>
						{{ $item->product_code }}
					</td>
					<td>{{ $item->location_name }}</td>
					<td>{!! $item->product_description !!}</td>
					<td>{{ $item->product->unit->name }}</td>
					<td>
						{{ $item->qty }}
					</td>
					<td>{{ $item->remark }}</td>
				</tr>

				@empty

				<tr>
					<td class="text-center text-danger" colspan="8">
						{{ trans('requesition_item.label.empty_data') }}
					</td>
				</tr>

				@endforelse
			</tbody>
		</table>
	</div>
</div>