<div class="panel panel-default">
	<div class="panel-body hidden-print">
	  	<div class="btn-group" role="group" aria-label="...">
			<a class="btn btn-warning btn-sm" href="/receives">
				<i class="fa fa-chevron-left"></i>
				{{ trans('receive.buttons.back_to_receive') }}
			</a>
		</div>
		<div class="btn-group pull-right" role="group" aria-label="...">
			<a class="btn btn-success btn-sm" id="invoicePrint">
    			<i class="fa fa-print"></i> Print
			</a>
			<div class="btn-group">
			  	<button type="button" 
			  		class="btn btn-default btn-sm dropdown-toggle" 
		  			data-toggle="dropdown" 
		  			aria-expanded="false">
		  			<i class="fa fa-cog"></i>
				    Action <span class="caret"></span>
			  	</button>
			  	<ul class="dropdown-menu dropdown-menu-right">
			    	<li>
			    		<a href="/receives/{{ $receive->id }}/edit">
			    			<i class="fa fa-edit"></i>
			    			{{ trans('receive.buttons.update') }}
		    			</a>
		    		</li>
			  		@if($receive->status == \App\Receive::PADDING)
			  			<li class="divider"></li>
				    	<li>
				    		<a href="/receives/status-success/{{ $receive->id }}">
				    			<i class="fa fa-flag fa-lg"></i>
				    			{{ trans('receive.buttons.process_success') }}
			    			</a>
			    		</li>
			    	@endif

			    	@if($receive->status == \App\Receive::CREATE)
			  			<li class="divider"></li>
				    	<li>
						   	{!! Form::open([
						   		'id' => 'process_padding',
						   		'method' => 'post',
						   		'url' => "/receives/status-padding/{$receive->id}",
						   		'class' => 'form-confirm',
						   		'data-title-confirm' => trans('receive.message_alert.review_confirm'),
						   		'data-message-cancel' => trans('receive.message_alert.review_cancel'),
						   		'data-confirm-ok' => trans('main.confirm_button.ok'),
						   		'data-confirm-cancel' => trans('main.confirm_button.cancel')
						   	]) !!}

					   		<a href id="process_padding">
					   			<i class="fa fa-flag fa-lg"></i> 
					   			{{ trans('receive.buttons.process_padding') }}</a>

						   	{!! Form::close() !!}
			    		</li>
			    	@endif
			  	</ul>
			</div>

			@if($receive->status == \App\Receive::CREATE)
	    		<a class="btn btn-info btn-sm" href="/receives/add-products/{{ $receive->id }}">
	    			<i class="fa fa-plus"></i> {{ trans('receive.buttons.add_product') }}
				</a>
			@endif
		</div>
	</div>
</div>