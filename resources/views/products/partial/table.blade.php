<table class="table table-striped">
	<thead>
		<tr>
			<th width="10%" class="text-center">Mix No</th>
			<th width="10%" class="text-center">Product Code</th>
			<th width="30%" class="text-center">Description</th>
			<th width="10%" class="text-center">On Hand</th>
			<th width="10%" class="text-center">On Stock</th>
			<th width="10%" class="text-center">On Oder</th>
			<th width="5%" class="text-center">Status</th>
			<th width="5%" class="text-center"></th>
			<th width="5%" class="text-center"></th>
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
				<td class="text-center">
					<a 
						href="/products/{{ $product->id }}/edit"
						class="btn btn-warning btn-xs"
						>
						<span class="fa fa-pencil"></span>
					</a>
				</td>
				<td class="text-center">
					<form
						method="POST"
						action="/products/{{ $product->id }}">

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
				<td colspan="7" class="text-danger text-center">
					{{ trans('product.label.empty_data') }}
				</td>
			</tr>
		@endforelse
	</tbody>
</table>