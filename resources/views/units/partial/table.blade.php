<table class="table table-striped">
	<thead>
		<tr>
			<th width="5%" class="text-center">#</th>
			<th>{{ trans('unit.attributes.name') }}</td>
			<th width="20%">{{ trans('unit.attributes.created_at') }}</td>
			<th width="20%">{{ trans('unit.attributes.updated_at') }}</td>
			<th width="5%" class="text-center">{{ trans('main.button.update') }}</td>
			<th width="5%" class="text-center">{{ trans('main.button.delete') }}</td>
		</tr>
	</thead>
	<tbody>
		<?php $i = 0; ?>
		@forelse($units as $unit)
			<tr>
				<td class="text-center">
					{{ $i + $units->firstItem() }}
				</td>
				<td>{{ $unit->name }}</td>
				<td>{{ $unit->created_at->format('d / m / Y H:i') }}</td>
				<td>{{ $unit->updated_at->format('d / m / Y H:i') }}</td>
				<td class="text-center">
					<a href="/units/{{ $unit->id }}/edit" 
						class="btn btn-warning btn-xs">
						<span class="fa fa-edit"></span>
					</a>
				</td>
				<td class="text-center">
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
								class="btn btn-danger btn-xs">
							<span class="fa fa-trash-o"></span>
						</button>

					</form>
				</td>
			</tr>
			<?php $i ++; ?>
		@empty
			<tr>
				<td colspan="6" class="text-center text-danger">{{ trans('unit.label.empty_data') }}</td>
			</tr>
		@endforelse
	</tbody>
</table>