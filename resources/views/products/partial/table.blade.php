<table class="table table-striped">
	<thead>
		<tr>
			<th width="10%" class="text-center">{{ trans('product.attributes.mix_no') }}</th>
			<th width="10%">{{ trans('product.attributes.code') }}</th>
			<th width="30%">{{ trans('product.attributes.description') }}</th>
			<th width="10%">{{ trans('product.attributes.unit_id') }}</th>
			<th width="10%">{{ trans('product.attributes.created_at') }}</th>
			<th width="10%">{{ trans('product.attributes.updated_at') }}</th>
			<th width="5%" class="text-center">{{ trans('product.label.update') }}</th>
			<th width="5%" class="text-center">{{ trans('product.label.delete') }}</th>
		</tr>
	</thead>
	<tbody>
		@forelse($products as $product)
			<tr>
				<td class="text-center">{{ $product->mix_no }}</td>
				<td>{{ $product->code }}</td>
				<td>{{ $product->description }}</td>
				<td>{{ $product->unit->name }}</td>
				<td>{{ $product->created_at->format('d/m/Y H:i') }}</td>
				<td>{{ $product->updated_at->format('d/m/Y H:i')  }}</td>
				<td class="text-center">
					<a 
						href="/products/{{ $product->id }}/edit"
						class="btn btn-warning btn-xs"
						>
						<span class="fa fa-edit"></span>
					</a>
				</td>
				<td class="text-center">
					<form
						method="POST"
						action="/products/{{ $product->id }}"
						data-message-confirm="{{ trans('product.message_alert.delete_confirm') }}"
						data-message-cancel="{{ trans('product.message_alert.cancel_message') }}"
						data-title-confirm="{{ trans('product.label.name') }}"
						data-confirm-ok="{{ trans('main.confirm_button.ok') }}"
						data-confirm-cancel="{{ trans('main.confirm_button.cancel') }}">

						{{ csrf_field() }}
						{{ method_field('delete') }}

						<button 
							class="btn btn-danger btn-xs">
							<span class="fa fa-trash-o"></span>
						</button>
					</form>
				</td>
			</tr>
		@empty
			<tr>
				<td colspan="8" class="text-danger text-center">
					{{ trans('product.label.empty_data') }}
				</td>
			</tr>
		@endforelse
	</tbody>
</table>