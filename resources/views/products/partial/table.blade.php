<table class="table table-striped">
	<thead>
		<tr>
			<th width="10%" class="text-center">Mix No</th>
			<th width="10%" class="text-center">Product Code</th>
			<th width="30%" class="text-center">Description</th>
			<th width="10%" class="text-center">On Hand</th>
			<th width="10%" class="text-center">On Stock</th>
			<th width="10%" class="text-center">On Oder</th>
			<th width="15%" class="text-center">Status</th>
		</tr>
	</thead>
	<tbody>
		@forelse($products as $product)
			<tr>
				<td class="text-center">{{ $product->mix_no }}</td>
				<td class="text-center">{{ $product->code }}</td>
				<td class="text-center">{{ $product->description }}</td>
				<td class="text-center"></td>
				<td class="text-center"></td>
				<td class="text-center"></td>
				<td class="text-center"></td>
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