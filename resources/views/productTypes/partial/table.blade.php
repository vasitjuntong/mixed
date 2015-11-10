<table class="table table-bordered">
	<thead>
		<tr>
			<th width="5%" class="text-center">#</th>
			<th>{{ trans('product_type.attributes.name') }}</td>
			<th width="20%" class="text-center">{{ trans('product_type.attributes.created_at') }}</td>
			<th width="20%" class="text-center">{{ trans('product_type.attributes.updated_at') }}</td>
			<th width="5%" class="text-center">{{ trans('main.button.update') }}</td>
			<th width="5%" class="text-center">{{ trans('main.button.delete') }}</td>
		</tr>
	</thead>
	<tbody>
		@forelse($productTypes as $productType)
			<tr>
				<td>#</td>
				<td>{{ $productType->name }}</td>
				<td>{{ $productType->created_at->format('d / m / Y H:i') }}</td>
				<td>{{ $productType->updated_at->format('d / m / Y H:i') }}</td>
				<td>
					<a href="/product-types/{{ $productType->id }}/edit" 
						class="btn btn-warning btn-sm">
						{{ trans('main.button.update') }}
					</a>
				</td>
				<td>
					<form 	method="POST" 
							action="/product-types/{{ $productType->id }}"
							data-message-confirm="{{ trans('product_type.message_alert.delete_confirm') }}"
							data-message-cancel="{{ trans('product_type.message_alert.cancel_message') }}"
							data-title-confirm="{{ trans('product_type.label.name') }}"
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
				<td colspan="6" class="text-center text-danger">{{ trans('product_type.label.empty_data') }}</td>
			</tr>
		@endforelse
	</tbody>
</table>