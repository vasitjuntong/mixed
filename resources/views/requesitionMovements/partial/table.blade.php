<table class="table table-striped" id="dataTable">
	<thead>
		<tr>
			<th width="10%">
                {!! link_to_sortable(trans('requesition.attributes.created_at'), 'requesitions__created_at') !!}
            </th>
			<th width="10%">
                {!! link_to_sortable(trans('requesition.attributes.document_no'), 'requesitions__document_no') !!}
            </th>
			<th width="10%">
                {!! link_to_sortable(trans('requesition.attributes.site_name'), 'requesitions__site_name') !!}
            </th>
			<th width="10%">
                {!! link_to_sortable(trans('requesition.attributes.receive_date'), 'requesitions__receive_date') !!}
            </th>
			<th width="10%">
                {!! link_to_sortable(trans('requesition_item.attributes.mix_no'), 'requesition_items__mix_no') !!}
            </th>
			<th width="8%">
                {!! link_to_sortable(trans('requesition_item.attributes.product_code'), 'requesition_items__product_code') !!}
            </th>
			<th width="12%">
                {!! link_to_sortable(trans('requesition_item.attributes.product_description'), 'requesition_items__product_description') !!}
            </th>
			<th width="5%">
                {!! link_to_sortable(trans('requesition_item.attributes.qty'), 'requesition_items__qty') !!}
            </th>
			<th width="5%">
                {!! link_to_sortable(trans('requesition_item.attributes.location_name'), 'locations__name') !!}
            </th>
			<th width="10%">
                {!! link_to_sortable(trans('requesition.attributes.create_by'), 'users__name') !!}
            </th>
			<th width="5%">
                {{ trans('requesition_item.attributes.remark') }}
            </th>
			<th width="5%">
                {!! link_to_sortable(trans('requesition_item.attributes.status'), 'requesition_items__status') !!}
            </th>
		</tr>
	</thead>
	<tbody>
		@forelse($items as $item)
			<tr>
				<td>{{ $item->requesition->created_at->format('d/m/Y H:i') }}</td>
				<td>
					<a href="/requesitions/{{ $item->requesition->id }}">
						{{ $item->requesition->document_no }}
					</a>
				</td>
				<td>{{ $item->requesition->site_id }}</td>
				<td>{{ $item->requesition->site_name }}</td>
				<td>{{ $item->mix_no }}</td>
				<td>{{ $item->product_code }}</td>
				<td>{{ $item->product_description }}</td>
				<td>{{ $item->qty }}</td>
				<td>{{ $item->location_name }}</td>
				<td>{{ $item->requesition->user->name }}</td>
				<td>{{ $item->remark }}</td>
				<td>{!! $item->statusHtml() !!}</td>
			</tr>
		@empty
			<tr>
				<td class="text-center text-danger" colspan="12">{{ trans('requesition_item.label.empty_data') }}</td>
			</tr>
		@endforelse
	</tbody>
</table>

<span class="text-center block">{!! $items->appends($filter)->render() !!}</span>