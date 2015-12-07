<div id="name" class="form-group">

	<label class="control-label" for="name">{{ trans('user.attributes.name') }}</label>
	{!! Form::text('name', null, [
		'class' => 'form-control',
		'autocomplate' => 'off',
	]) !!}	 		

</div>

<div id="email" class="form-group">

	<label class="control-label" for="email">{{ trans('user.attributes.email') }}</label>
	{!! Form::text('email', null, [
		'class' => 'form-control',
		'autocomplate' => 'off',
	]) !!}	 		

</div>

<div id="password" class="form-group">

	<label class="control-label" for="password">{{ trans('user.attributes.password') }}</label>
	{!! Form::password('password', [
		'class' => 'form-control'
	]) !!}	 		

</div>