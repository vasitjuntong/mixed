<table class="table table-striped">
	<thead>
		<tr>
			<th width="10%">Mix No</th>
			<th width="10%">Product Code</th>
			<th width="30%">Description</th>
			<th width="10%">On Hand</th>
			<th width="10%">On Stock</th>
			<th width="10%">On Oder</th>
			<th width="15%">Status</th>
		</tr>
	</thead>
	<tbody>
		@forelse($products as $product)
			<tr>
				<td>{{ $product->mix_no }}</td>
				<td>{{ $product->code }}</td>
				<td>{{ $product->description }}</td>
				<td></td>
				<td></td>
				<td></td>
				<td></td>
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