<div class="modal fade" id="modal-create">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
				<h4 class="modal-title">{{ trans('user.label.update') }} {{ trans('user.label.name') }}</h4>
			</div>
			<div class="modal-body">
				{!!
					Form::model($user, [
						'url' => "/users/{$user->id}",
					])
				 !!}

				 {{ method_field('PATCH') }}

				 @include('users.partial.form')

				 <div class="form-group">
				 	<button class="btn btn-success btn-sm">
				 		<i class="fa fa-edit"></i>
				 		{{ trans('user.buttons.update') }}
				 	</button>
				 </div>

				 {!! Form::close() !!}
			</div>
		</div>
	</div>
</div>

<script src="/js/libs/form-create.js"></script>