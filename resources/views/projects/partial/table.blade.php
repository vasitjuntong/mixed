<table class="table table-striped">
	<thead>
		<tr>
			<th width="5%" class="text-center">#</th>
			<th>{{ trans('project.attributes.code') }}</td>
			<th width="20%">{{ trans('project.attributes.created_at') }}</td>
			<th width="20%">{{ trans('project.attributes.updated_at') }}</td>
			<th width="5%" class="text-center">{{ trans('main.button.update') }}</td>
			<th width="5%" class="text-center">{{ trans('main.button.delete') }}</td>
		</tr>
	</thead>
	<tbody>
		@forelse($projects as $project)
			<tr>
				<td class="text-center">#</td>
				<td>{{ $project->code }}</td>
				<td>{{ $project->created_at->format('d / m / Y H:i') }}</td>
				<td>{{ $project->updated_at->format('d / m / Y H:i') }}</td>
				<td class="text-center">
					<a href="/projects/{{ $project->id }}/edit" 
						class="btn btn-warning btn-xs">
						<span class="fa fa-edit"></span>
					</a>
				</td>
				<td class="text-center">
					<form 	method="POST" 
							action="/projects/{{ $project->id }}"
							data-message-confirm="{{ trans('project.message_alert.delete_confirm') }}"
							data-message-cancel="{{ trans('project.message_alert.cancel_message') }}"
							data-title-confirm="{{ trans('project.label.name') }}"
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
				<td colspan="6" class="text-danger text-center">{{ trans('project.label.empty_data') }}</td>
			</tr>

		@endforelse
	</tbody>
</table>