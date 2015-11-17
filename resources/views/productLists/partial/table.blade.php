<table class="table table-striped">
	<thead>
		<tr>
			<th width="10%" class="text-center">{{ trans('product_list.attributes.mix_no') }}</th>
			<th width="10%">{{ trans('product_list.attributes.code') }}</th>
			<th width="30%">{{ trans('product_list.attributes.description') }}</th>
			<th width="10%">{{ trans('product_list.attributes.on_hand') }}</th>
			<th width="10%">{{ trans('product_list.attributes.on_stock') }}</th>
			<th width="10%">{{ trans('product_list.attributes.on_order') }}</th>
			<th width="10%" class="text-center">{{ trans('product_list.attributes.updated_at') }}</th>
		</tr>
	</thead>
	<tbody>
		@forelse($products as $product)
			<tr>
				<td class="text-center">{{ $product->mix_no }}</td>
				<td>{{ $product->code }}</td>
				<td>{{ $product->description }}</td>
				<td>{{ $product->on_hand }}</td>
				<td>{{ $product->on_stock }}</td>
				<td>{{ $product->on_order }}</td>
				<td class="text-center">{{ $product->updated_at->format('d/m/Y H:i')  }}</td>
			</tr>
		@empty
			<tr>
				<td colspan="7" class="text-danger text-center">
					{{ trans('product.label.empty_data') }}
				</td>
			</tr>
		@endforelse
	</tbody>
</table>