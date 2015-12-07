<table class="table table-striped">
	<thead>
		<tr>
			<th width="20%">{{ trans('user.attributes.name') }}</td>
			<th>{{ trans('user.attributes.email') }}</td>
			<th width="10">{{ trans('user.attributes.role') }}</td>
			<th width="15%">{{ trans('user.attributes.created_at') }}</td>
			<th width="15%">{{ trans('user.attributes.updated_at') }}</td>
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
			</tr>
		@empty
			<tr>
				<td colspan="6" class="text-center text-danger">{{ trans('user.label.empty_data') }}</td>
			</tr>
		@endforelse
	</tbody>
</table>