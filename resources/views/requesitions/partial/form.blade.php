<div class="row">
	<div class="col-sm-12 col-md-6">
		<div class="row">
			<div class="col-sm-12 col-md-6">
				<div id="project_id" class="form-group {{ $errors->has('project_id') ? 'has-error':'' }} ">
					<label for="project_id" class="control-label">
						{{ trans('requesition.attributes.project_id') }}
                        <i class="text-danger"> *</i>
					</label>

					{!! Form::select('project_id', $projects, null, [
						'class' => 'form-control chosen-select',
						'placeholder' => trans('requesition.attributes.project_id'),
					]) !!}

					@if($errors->has('project_id'))
						<span id="helpBlock2" class="help-block text-error">
							{{ $errors->first('project_id') }}
						</span>
					@endif
				</div>
			</div>

			<div class="col-sm-12 col-md-6">
				<div id="site_id" class="form-group {{ $errors->has('site_id') ? 'has-error':'' }} ">
					<label for="site_id" class="control-label">
						{{ trans('requesition.attributes.site_id') }}
                        <i class="text-danger"> *</i>
					</label>

					{!! Form::text('site_id', null, [
						'class' => 'form-control input-sm',
						'placeholder' => trans('requesition.attributes.site_id'),
					]) !!}

					@if($errors->has('site_id'))
						<span id="helpBlock2" class="help-block text-error">
							{{ $errors->first('site_id') }}
						</span>
					@endif
				</div>
			</div>

			<div class="col-sm-12 col-md-6">
				<div id="site_name" class="form-group {{ $errors->has('site_name') ? 'has-error':'' }} ">
					<label for="site_name" class="control-label">
						{{ trans('requesition.attributes.site_name') }}
                        <i class="text-danger"> *</i>
					</label>

					{!! Form::text('site_name', null, [
						'class' => 'form-control input-sm',
						'placeholder' => trans('requesition.attributes.site_name'),
					]) !!}

					@if($errors->has('site_name'))
						<span id="helpBlock2" class="help-block text-error">
							{{ $errors->first('site_name') }}
						</span>
					@endif
				</div>
			</div>
		</div>
	</div>
	<div class="col-sm-12 col-md-6">
		<div class="row">
			<div class="col-sm-12 col-md-6">
				<div id="receive_company_name" 
					 class="form-group {{ $errors->has('receive_company_name') ? 'has-error':'' }} ">
					<label for="receive_company_name" class="control-label">
						{{ trans('requesition.attributes.receive_company_name') }}
                        <i class="text-danger"> *</i>
					</label>

					{!! Form::text('receive_company_name', null, [
						'class' => 'form-control input-sm',
						'placeholder' => trans('requesition.attributes.receive_company_name'),
					]) !!}

					@if($errors->has('receive_company_name'))
						<span id="helpBlock2" class="help-block text-error">
							{{ $errors->first('receive_company_name') }}
						</span>
					@endif
				</div>
			</div>

			<div class="col-sm-12 col-md-6">
				<div 	id="receive_contact_name" 
						class="form-group {{ $errors->has('receive_contact_name') ? 'has-error':'' }} ">

					<label for="receive_contact_name" class="control-label">
						{{ trans('requesition.attributes.receive_contact_name') }}
                        <i class="text-danger"> *</i>
					</label>

					{!! Form::text('receive_contact_name', null, [
						'class' => 'form-control input-sm',
						'placeholder' => trans('requesition.attributes.receive_contact_name'),
					]) !!}

					@if($errors->has('receive_contact_name'))
						<span id="helpBlock2" class="help-block text-error">
							{{ $errors->first('receive_contact_name') }}
						</span>
					@endif
				</div>
			</div>

			<div class="col-sm-12 col-md-6">
				<div 	id="receive_phone" 
						class="form-group {{ $errors->has('receive_phone') ? 'has-error':'' }} ">
						
					<label for="receive_phone" class="control-label">
						{{ trans('requesition.attributes.receive_phone') }}
                        <i class="text-danger"> *</i>
					</label>

					{!! Form::text('receive_phone', null, [
						'class' => 'form-control input-sm',
						'placeholder' => trans('requesition.attributes.receive_phone'),
					]) !!}

					@if($errors->has('receive_phone'))
						<span id="helpBlock2" class="help-block text-error">
							{{ $errors->first('receive_phone') }}
						</span>
					@endif
				</div>
			</div>

			<div class="col-sm-12 col-md-6">
				<div 	id="receive_date" 
						class="form-group {{ $errors->has('receive_date') ? 'has-error':'' }} ">
						
					<label for="receive_date" class="control-label">
						{{ trans('requesition.attributes.receive_date') }}
                        <i class="text-danger"> *</i>
					</label>

					<div class='input-group date'>
						{!! Form::text('receive_date', null, [
							'class' => 'form-control input-sm',
							'id' => 'datetimepicker',
						]) !!}
						<span class="input-group-addon">
			                <span class="glyphicon glyphicon-calendar"></span>
			            </span>
		            </div>

					@if($errors->has('receive_date'))
						<span id="helpBlock2" class="help-block text-error">
							{{ $errors->first('receive_date') }}
						</span>
					@endif
				</div>
			</div>
		</div>
	</div>
</div>