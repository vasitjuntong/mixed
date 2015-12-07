<div class="modal fade" id="modal-create">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
				<h4 class="modal-title">Create User</h4>
			</div>
			<div class="modal-body">
				{!!
					Form::open([
						'url' => '/users',
					])
				 !!}

				 @include('users.partial.form')

				 <div class="form-group">
				 	<button class="btn btn-success">
				 		{{ trans('user.buttons.create') }}
				 	</button>
				 </div>

				 {!! Form::close() !!}
			</div>
		</div>
	</div>
</div>

<script src="/js/libs/form-create.js"></script>