<table class="table table-striped">
	<thead>
		<tr>
			<th width="10%">{{ trans('requesition.attributes.created_at') }}</th>
			<th width="10%">{{ trans('requesition.attributes.document_no' )}}</th>
			<th width="10%">{{ trans('requesition.attributes.po_no') }}</th>
			<th width="10%">{{ trans('requesition.attributes.ref_no') }}</th>
			<th width="10%">{{ trans('requesition.attributes.project_id') }}</th>
			<th width="10%">{{ trans('requesition.attributes.create_by') }}</th>
			<th>{{ trans('requesition.attributes.remark') }}</th>
			<th width="5%">{{ trans('requesition.attributes.status') }}</th>
			{{-- <th width="10%" class="text-center">{{ trans('requesition.attributes.success_status') }}</th> --}}
		</tr>
	</thead>
	<tbody>
		@forelse($requesitions as $requesition)
		
			<tr>
				<td>{{ $requesition->created_at->format('d/m/Y H:i') }}</td>
				<td>
					<a href="/requesitions/review/{{ $requesition->id }}">
						{{ $requesition->document_no }}
					</a>
				</td>
				<td>{{ $requesition->po_no }}</td>
				<td>{{ $requesition->ref_no }}</td>
				<td>{{ $requesition->project->code }}</td>
				<td>{{ $requesition->user->name }}</td>
				<td>{{ $requesition->remark }}</td>
				<td>{!! $requesition->statusHtml() !!}</td>
			</tr>

		@empty

			<tr>
				<td class="text-center text-danger" colspan="8">
					{{ trans('requesition.label.empty_data') }}
				</td>
			</tr>

		@endforelse
	</tbody>
</table>