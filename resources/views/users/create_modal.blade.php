<div class="modal fade" id="modal-create">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
				<h4 class="modal-title">{{ trans('user.label.create') }} {{ trans('user.label.name') }}</h4>
			</div>
			<div class="modal-body">
				{!!
					Form::open([
						'url' => '/users',
					])
				 !!}

				 @include('users.partial.form')

				 <div class="form-group">
				 	<button 
						id="user-create"
				 		class="btn btn-success btn-sm">
				 		<i class="fa fa-plus"></i>
				 		{{ trans('user.buttons.create') }}
				 	</button>
				 </div>

				 {!! Form::close() !!}
			</div>
		</div>
	</div>
</div>

<script src="/js/libs/form-create.js"></script>