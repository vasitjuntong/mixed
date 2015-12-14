<table class="table table-striped" id="dataTable">
	<thead>
		<tr>
			<th width="6%">
                {!! link_to_sortable(trans('receive.attributes.created_at'), 'receives__created_at') !!}
            </th>
			<th width="6%">
                {!! link_to_sortable(trans('receive.attributes.document_no'), 'receives__document_no') !!}
            </th>
			<th width="7%">
                {!! link_to_sortable(trans('receive.attributes.po_no'), 'receives__po_no') !!}
            </th>
			<th width="8%">
                {!! link_to_sortable(trans('receive.attributes.ref_no'), 'receives__ref_no') !!}
            </th>
			<th width="5%">
                {!! link_to_sortable(trans('receive_item.attributes.mix_no'), 'receive_items__mix_no') !!}
            </th>
			<th width="10%">
                {!! link_to_sortable(trans('receive_item.attributes.product_code'), 'receive_items__product_code') !!}
            </th>
			<th width="24%">
                {!! link_to_sortable(trans('receive_item.attributes.product_description'), 'receive_items__product_description') !!}
            </th>
			<th width="6%">
                {!! link_to_sortable(trans('receive_item.attributes.qty'), 'receive_items__qty') !!}
            </th>
			<th width="6%">
                {!! link_to_sortable(trans('receive_item.attributes.location_name'), 'locations__name') !!}
            </th>
			<th width="8%">
                {!! link_to_sortable(trans('receive.attributes.create_by'), 'users__name') !!}
            </th>
			<th width="5%">
                {{ trans('receive_item.attributes.remark') }}
            </th>
			<th width="9%">
                {!! link_to_sortable(trans('receive_item.attributes.status'), 'receive_items__status') !!}
            </th>
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

<span class="text-center block">{!! $receiveItems->appends($filter)->render() !!}</span>