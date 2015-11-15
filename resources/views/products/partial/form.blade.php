<div class="row">
	<div class="col-md-3">
		<div class="form-group {{ $errors->has('mix_no') ? 'has-error' : '' }}">

			<label for="mixno1" class="control-label">
				{{ trans('product.attributes.mix_no') }}
			</label>
			<input 
					type="text"
					name="mix_no",
					class="form-control" 
					id="mixno"
					placeholder="{{ trans('product.attributes.mix_no') }}"
					value="{{ old('mix_no') ? old('mix_no') : ((isset($product) AND $product != null) ? $product->mix_no : '')  }}">

			@if($errors->has('mix_no'))
				<span id="helpBlock2" class="help-block text-error">
					{{ $errors->first('mix_no') }}
				</span>
			@endif
		</div>
	</div>
	    
	<div class="col-md-3">  
		<div class="form-group {{ $errors->has('code') ? 'has-error' : '' }}">

			<label for="productcode1" class="control-label">
				{{ trans('product.attributes.code') }}
			</label>
			<input 	type="text" 
					name="code"
					class="form-control" 
					id="productcode" 
					placeholder="{{ trans('product.attributes.code') }}"
					value="{{ old('code') ? old('code') : ((isset($product) AND $product != null) ? $product->code : '')  }}">
			@if($errors->has('code'))
				<span id="helpBlock2" class="help-block text-error">
					{{ $errors->first('code') }}
				</span>
			@endif

		</div><!-- /form-group -->
	</div>

	<div class="col-md-3">
		<div class="form-group {{ $errors->has('product_type_id') ? 'has-error' : '' }}">

			<label for="type1" class="control-label">
				{{ trans('product.attributes.product_type_id') }}
			</label>
			<select name="product_type_id" class="form-control chzn-select">

				<option value="">
					{{ trans('main.label.select') }}
				</option>

				@foreach($productTypes as $id => $name)

					<option 
						value="{{ $id }}" 
						{{ old('product_type_id') == $id? 'selected': 
							(isset($product) AND $product->product_type_id == $id)? 'selected':'' }}
						>
						{{ $name }}
					</option>
				@endforeach
			</select>
			@if($errors->has('product_type_id'))
				<span id="helpBlock2" class="help-block text-error">
					{{ $errors->first('product_type_id') }}
				</span>
			@endif

	    </div>
	</div>

	<div class="col-md-3">
		<div class="form-group {{ $errors->has('unit_id') ? 'has-error' : '' }}">

			<label for="type1" class="control-label">
				{{ trans('product.attributes.unit_id') }}
			</label>
			<select class="form-control chzn-select" name="unit_id">

				<option value="">
					{{ trans('main.label.select') }}
				</option>

				@foreach($units as $id => $name)
					<option 
						value="{{ $id }}"
						{{ old('unit_id') == $id? 'selected': 
							(isset($product) AND $product->unit_id == $id)? 'selected':'' }}
						>
						{{ $name }}
					</option>
				@endforeach
			</select>
			@if($errors->has('unit_id'))
				<span id="helpBlock2" class="help-block text-error">
					{{ $errors->first('unit_id') }}
				</span>
			@endif

	    </div>
	</div>
</div>
<div class="row">
	<div class="col-md-3">	
	    <div class="form-group {{ $errors->has('stock_min')? 'has-error':'' }}">

			<label class="control-label">
				{{ trans('product.attributes.stock_min') }}
			</label>
			<input 
					type="number"
					name="stock_min"
					placeholder="Enter your Minimum ..." 
					class="form-control"
					value="{{ old('stock_min') ? old('stock_min') : ((isset($product) AND $product != null) ? $product->stock_min : '')  }}"
					>

			@if($errors->has('stock_min'))
				<span id="helpBlock2" class="help-block text-error">
					{{ $errors->first('stock_min') }}
				</span>
			@endif
	    </div>
	</div>

	<div class="col-md-3"> 
		<div class="form-group">
			<label class="control-label">
				{{ trans('product.attributes.pic_name') }}
			</label>
			<div class="upload-file">
				<input type="file" name="file" id="upload-demo" class="upload-demo">
				<label data-title="Select file" for="upload-demo">
					<span data-title="No file selected..."></span>
				</label>
			</div>
		</div>
	</div>

	<div class="col-md-3"> 
		<div class="form-group">
			<label class="control-label">
				{{ trans('product.attributes.use_serial_no') }}
			</label>
			<input type="hidden" name="serial_no" value="{{ App\Product::USE_SERIAL_NO}}">
			<label class="label-checkbox">
				<input 
						type="checkbox" 
						name="serial_no" 
						value="{{ App\Product::UNUSE_SERIAL_NO}}"
						{{ old('serial_no') == 1? 'checked': 
							(isset($product) AND $product->serial_no == 1)? 'checked':'' }}
						>
				<span class="custom-checkbox"></span>
				{{ trans('product.attributes.use_serial_no') }}
			</label>
			@if($errors->has('serial_no'))
				<span id="helpBlock2" class="help-block text-error">
					{{ $errors->first('serial_no') }}
				</span>
			@endif
		 </div>
	</div>
</div>
<div class="row"> 
	<div class="col-md-12">
		<div class="form-group {{ $errors->has('description') ? 'has-error' : '' }}">

			<label for="Description1" class="control-label">
				{{ trans('product.attributes.description') }}
			</label>

		  	<textarea class="form-control" name="description">{{ old('description') ? old('description') : ((isset($product) AND $product != null) ? $product->description : '')  }}</textarea>

			@if($errors->has('description'))
				<span id="helpBlock2" class="help-block text-error">
					{{ $errors->first('description') }}
				</span>
			@endif

		</div>
	</div>
</div>