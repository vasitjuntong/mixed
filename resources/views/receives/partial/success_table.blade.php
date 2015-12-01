<div class="panel panel-default">
	<div class="panel-body">
		<table class="table table-striped">
			<thead>
				<tr>
					<th class="text-center" width="5%">
						<label class="label-checkbox">
							<input type="checkbox" id="chk_all">
							<span class="custom-checkbox"></span>
						</label>
					</th>
					<th width="10%">{{ trans('receive_item.attributes.mix_no') }}</th>
					<th width="10%">{{ trans('receive_item.attributes.product_code' )}}</th>
					<th width="10%">{{ trans('receive_item.attributes.location_name') }}</th>
					<th>{{ trans('receive_item.attributes.product_description') }}</th>
					<th width="10%">{{ trans('receive_item.attributes.qty') }}</th>
					<th width="20%">{{ trans('receive_item.attributes.remark') }}</th>
					<th width="10%">{{ trans('receive_item.attributes.status') }}</th>
				</tr>
			</thead>
			<tbody>
				@forelse($receiveItems as $item)
				
				<tr>
					<td class="text-center">
						<label class="label-checkbox">
							<input type="checkbox" 
								id="checkbox_products"
								name="products[]"
								value="{{ $item->id }}">
							<span class="custom-checkbox"></span>
						</label>
					</td>
					<td>{{ $item->mix_no }}</td>
					<td>
						{{ $item->product_code }}
					</td>
					<td>{{ $item->location_name }}</td>
					<td>{!! $item->product_description !!}</td>
					<td>{{ $item->qty }}</td>
					<td>{{ $item->remark }}</td>
					<td>{!! $item->statusHtml() !!}</td>
				</tr>

				@empty

				<tr>
					<td class="text-center text-danger" colspan="8">
						{{ trans('receive_item.label.empty_data') }}
					</td>
				</tr>

				@endforelse
			</tbody>
		</table>

		<span class="text-center block">{!! $receiveItems->render() !!}</span>
	</div>
</div>