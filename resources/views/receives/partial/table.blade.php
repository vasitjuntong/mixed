<table class="table table-striped">
	<thead>
		<tr>
			<th width="10%">{{ trans('receive.attributes.created_at') }}</th>
			<th width="10%">{{ trans('receive.attributes.document_no' )}}</th>
			<th width="10%">{{ trans('receive.attributes.po_no') }}</th>
			<th width="10%">{{ trans('receive.attributes.ref_no') }}</th>
			<th width="10%">{{ trans('receive.attributes.stock') }}</th>
			<th width="10%">{{ trans('receive.attributes.create_by') }}</th>
			<th width="20%">{{ trans('receive.attributes.remark') }}</th>
			<th width="10%">{{ trans('receive.attributes.status') }}</th>
			<th width="10%" class="text-center">{{ trans('receive.attributes.success_status') }}</th>
		</tr>
	</thead>
	<tbody>
		@forelse($receives as $receive)
		
			<tr>
				<td>{{ $receive->created_at->format('d/m/Y H:i') }}</td>
				<td>
					<a href="/receives/add-products/{{ $receive->id }}">
						{{ $receive->document_no }}
					</a>
				</td>
				<td>{{ $receive->po_no }}</td>
				<td>{{ $receive->ref_no }}</td>
				<td>{{ $receive->stock }}</td>
				<td>{{ $receive->create_by }}</td>
				<td>{{ $receive->remark }}</td>
				<td>{!! $receive->statusHtml() !!}</td>
				<td class="text-center">
					<a href="/receives/status-success/{{ $receive->id }}" class="btn btn-success btn-xs">
						<span class="fa fa-download"></span>
					</a>
				</td>
			</tr>

		@empty

			<tr>
				<td class="text-center text-danger" colspan="8">
					{{ trans('receive.label.empty_data') }}
				</td>
			</tr>

		@endforelse
	</tbody>
</table>