<table class="table table-striped" id="dataTable">
	<thead>
		<tr>
			<th width="6%">{{ trans('receive.attributes.created_at') }}</th>
			<th width="6%">{{ trans('receive.attributes.document_no') }}</th>
			<th width="7%">{{ trans('receive.attributes.po_no') }}</th>
			<th width="8%">{{ trans('receive.attributes.ref_no') }}</th>
			<th width="5%">{{ trans('receive_item.attributes.mix_no') }}</th>
			<th width="10%">{{ trans('receive_item.attributes.product_code') }}</th>
			<th width="24%">{{ trans('receive_item.attributes.product_description') }}</th>
			<th width="6%">{{ trans('receive_item.attributes.qty') }}</th>
			<th width="6%">{{ trans('receive_item.attributes.location_name') }}</th>
			<th width="8%">{{ trans('receive.attributes.create_by') }}</th>
			<th width="5%">{{ trans('receive_item.attributes.remark') }}</th>
			<th width="9%">{{ trans('receive_item.attributes.status') }}</th>
		</tr>
	</thead>
	<tbody>
		@forelse($receiveItems as $item)
			<tr>
				<td>{{ $item->receive->created_at->format('d/m/Y H:i') }}</td>
				<td>
					<a href="/receives/review/{{ $item->receive->id }}">
						{{ $item->document_no }}
					</a>
				</td>
				<td>{{ $item->receive->po_no }}</td>
				<td>{{ $item->receive->ref_no }}</td>
				<td>{{ $item->mix_no }}</td>
				<td>{{ $item->product_code }}</td>
				<td>{{ $item->product_description }}</td>
				<td>{{ $item->qty }}</td>
				<td>{{ $item->location_name }}</td>
				<td>{{ $item->receive->user->name }}</td>
				<td>{{ $item->remark }}</td>
				<td>{!! $item->statusHtml() !!}</td>
			</tr>
		@empty
			<tr>
				<td class="text-center text-danger" colspan="12">{{ trans('receive_item.label.empty_data') }}</td>
			</tr>
		@endforelse
	</tbody>
</table>