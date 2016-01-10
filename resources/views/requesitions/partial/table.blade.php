<table id="dataTables" class="table table-striped">
	<thead>
		<tr>
			<th width="10%">{{ trans('requesition.attributes.created_at') }}</th>
			<th width="10%">{{ trans('requesition.attributes.document_no' )}}</th>
			<th width="10%">{{ trans('requesition.attributes.site_id') }}</th>
			<th width="10%">{{ trans('requesition.attributes.site_name') }}</th>
			<th width="10%">{{ trans('requesition.attributes.receive_date') }}</th>
			<th width="10%">{{ trans('requesition.attributes.receive_company_name') }}</th>
			<th width="10%">{{ trans('requesition.attributes.receive_contact_name') }}</th>
			<th width="10%">{{ trans('requesition.attributes.receive_phone') }}</th>
			<th width="5%">{{ trans('requesition.attributes.status') }}</th>
		</tr>
	</thead>
	<tbody>
		@forelse($requesitions as $requesition)
		
			<tr>
				<td>{{ $requesition->created_at->format('d/m/Y H:i') }}</td>
				<td>
					<a href="/requisitions/{{ $requesition->id }}">
						{{ $requesition->document_no }}
					</a>
				</td>
				<td>{{ $requesition->site_id }}</td>
				<td>{{ $requesition->site_name }}</td>
				<td>{{ $requesition->receive_date->format('d/m/Y H:i') }}</td>
				<td>{{ $requesition->receive_company_name }}</td>
				<td>{{ $requesition->receive_contact_name }}</td>
				<td>{{ $requesition->receive_phone }}</td>
				<td>{!! $requesition->statusHtml() !!}</td>
			</tr>

		@empty

			<tr>
				<td class="text-center text-danger" colspan="9">
					{{ trans('requesition.label.empty_data') }}
				</td>
			</tr>

		@endforelse
	</tbody>
</table>