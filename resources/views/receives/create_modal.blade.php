<div class="modal fade" id="modal-create" tabindex="-1" role="dialog" aria-labelledby="modal-create">
  	<div class="modal-dialog" role="document">
    	<div class="modal-content">
      		<div class="modal-header">
				{{ csrf_field()}}
				{!! Form::open([
					'method' 	=> 'post',
					'url' 		=> '/receives',
				]) !!}

					@include('receives.partial.form')
		            
		           <div class="row">
			           	<div class="col-md-12"> 
			      			<button type="submit" class="btn btn-success btn-sm">
			      				{{ trans('main.button.create') }}
			      			</button>
			            </div>
		           </div>
				{!! Form::close() !!}
			</div>
		</div><!-- /panel -->
	</div>
</div>

<link href="/css/chosen/chosen.min.css" rel="stylesheet">
<script src="/js/libs/form-create.js"></script>
<script type="text/javascript" src="/js/chosen.jquery.min.js"></script>

<script>
	$(function(){
		$('.chosen-select').chosen({
			search_contains: true
		});
	});
</script>