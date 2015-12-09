<table class="table table-striped">
	<thead>
		<tr>
			<th width="20%">{{ trans('user.attributes.name') }}</td>
			<th>{{ trans('user.attributes.email') }}</td>
			<th width="10">{{ trans('user.attributes.role') }}</td>
			<th width="15%">{{ trans('user.attributes.created_at') }}</td>
			<th width="15%">{{ trans('user.attributes.updated_at') }}</td>
			<th class="text-center" width="5%">{{ trans('user.label.update') }}</td>
			<th class="text-center" width="5%">{{ trans('user.label.delete') }}</td>
		</tr>
	</thead>
	<tbody>
		@forelse($users as $user)
			<tr>
				<td>{{ $user->name }}</td>
				<td>{{ $user->email }}</td>
				<td>
					<a href="/users/assign-role/{{ $user->id }}">
						{{ $user->roles->count() }}
					</a>
				</td>
				<td>{{ $user->created_at->format('d / m / Y H:i') }}</td>
				<td>{{ $user->updated_at->format('d / m / Y H:i') }}</td>
				<td class="text-center">
					<a id="user-update" class="btn btn-warning btn-xs" href="/users/{{ $user->id }}/edit">
						<i class="fa fa-edit"></i>
					</a>
				</td>
				<td class="text-center">
					<form 	method="POST" 
							action="/users/{{ $user->id }}"
							data-message-confirm="{{ trans('user.message_alert.delete_confirm') }}"
							data-message-cancel="{{ trans('user.message_alert.cancel_message') }}"
							data-title-confirm="{{ trans('user.label.name') }}"
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
				<td colspan="6" class="text-center text-danger">{{ trans('user.label.empty_data') }}</td>
			</tr>
		@endforelse
	</tbody>
</table>