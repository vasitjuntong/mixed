<table class="table table-striped" id="dataTables">
	<thead>
		<tr>
			<th width="15%">{{ trans('receive.attributes.created_at') }}</th>
			<th width="15%">{{ trans('receive.attributes.document_no' )}}</th>
			<th width="10%">{{ trans('receive.attributes.po_no') }}</th>
			<th width="15%">{{ trans('receive.attributes.ref_no') }}</th>
			<th width="10%">{{ trans('receive.attributes.project_id') }}</th>
			<th width="10%">{{ trans('receive.attributes.create_by') }}</th>
			<th>{{ trans('receive.attributes.remark') }}</th>
			<th width="5%">{{ trans('receive.attributes.status') }}</th>
		</tr>
	</thead>
	<tbody>
		@forelse($receives as $receive)
		
			<tr>
				<td>{{ $receive->created_at->format('d/m/Y H:i') }}</td>
				<td>
					<a href="/receives/review/{{ $receive->id }}">
						{{ $receive->document_no }}
					</a>
				</td>
				<td>{{ $receive->po_no }}</td>
				<td>{{ $receive->ref_no }}</td>
				<td>{{ $receive->project->code }}</td>
				<td>{{ $receive->user->name }}</td>
				<td>{{ $receive->remark }}</td>
				<td>{!! $receive->statusHtml() !!}</td>
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