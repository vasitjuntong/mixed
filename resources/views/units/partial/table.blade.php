<table class="table table-bordered">
	<thead>
		<tr>
			<th width="5%" class="text-center">#</th>
			<th>{{ trans('unit.attributes.name') }}</td>
			<th width="20%" class="text-center">{{ trans('unit.attributes.created_at') }}</td>
			<th width="20%" class="text-center">{{ trans('unit.attributes.updated_at') }}</td>
			<th width="5%" class="text-center">{{ trans('main.button.update') }}</td>
			<th width="5%" class="text-center">{{ trans('main.button.delete') }}</td>
		</tr>
	</thead>
	<tbody>
		@forelse($units as $unit)
			<tr>
				<td>#</td>
				<td>{{ $unit->name }}</td>
				<td>{{ $unit->created_at->format('d / m / Y H:i') }}</td>
				<td>{{ $unit->updated_at->format('d / m / Y H:i') }}</td>
				<td>
					<a href="/units/{{ $unit->id }}/edit" 
						class="btn btn-warning btn-sm">
						{{ trans('main.button.update') }}
					</a>
				</td>
				<td>
					<form 	method="POST" 
							action="/units/{{ $unit->id }}"
							data-message-confirm="{{ trans('unit.message_alert.delete_confirm') }}"
							data-message-cancel="{{ trans('unit.message_alert.cancel_message') }}"
							data-title-confirm="{{ trans('unit.label.name') }}"
							data-confirm-ok="{{ trans('main.confirm_button.ok') }}"
							data-confirm-cancel="{{ trans('main.confirm_button.cancel') }}">
						
						{{ method_field('delete') }}
						{{ csrf_field() }}

						<button type="submit"
								class="btn btn-danger btn-sm">
							{{ trans('main.button.delete') }}
						</button>

					</form>
				</td>
			</tr>
		@empty
			<tr>
				<td colspan="6" class="text-center text-danger">{{ trans('unit.label.empty_data') }}</td>
			</tr>
		@endforelse
	</tbody>
</table>