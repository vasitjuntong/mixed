<table class="table table-striped">
	<thead>
		<tr>
			<th width="5%" class="text-center">#</th>
			<th>{{ trans('location.attributes.name') }}</td>
			<th width="20%">{{ trans('location.attributes.created_at') }}</td>
			<th width="20%">{{ trans('location.attributes.updated_at') }}</td>
			<th width="5%" class="text-center">{{ trans('main.button.update') }}</td>
			<th width="5%" class="text-center">{{ trans('main.button.delete') }}</td>
		</tr>
	</thead>
	<tbody>
		@forelse($locations as $location)
			<tr>
				<td>#</td>
				<td>{{ $location->name }}</td>
				<td>{{ $location->created_at->format('d / m / Y H:i') }}</td>
				<td>{{ $location->updated_at->format('d / m / Y H:i') }}</td>
				<td class="text-center">
					<a href="/locations/{{ $location->id }}/edit" 
						class="btn btn-warning btn-xs">
						<span class="fa fa-edit"></span>
					</a>
				</td>
				<td class="text-center">
					<form 	method="POST" 
							action="/locations/{{ $location->id }}"
							data-message-confirm="{{ trans('location.message_alert.delete_confirm') }}"
							data-message-cancel="{{ trans('location.message_alert.cancel_message') }}"
							data-title-confirm="{{ trans('location.label.name') }}"
							data-confirm-ok="{{ trans('main.confirm_button.ok') }}"
							data-confirm-cancel="{{ trans('main.confirm_button.cancel') }}">
						
						{{ method_field('delete') }}
						{{ csrf_field() }}

						<button type="submit"
								class="btn btn-danger btn-xs">
							<span class="fa fa-trash-o"></span>
						</button>

					</form>
				</td>
			</tr>
		@empty
			<tr>
				<td colspan="6" class="text-center text-danger">{{ trans('location.label.empty_data') }}</td>
			</tr>
		@endforelse
	</tbody>
</table>