<div class="clearfix">
	<div class="pull-left">
		<span class="img-demo">
			<img src="/img/logo.jpg" />
		</span>
	  	<div class="pull-left m-left-sm">
		<h3 class="m-bottom-xs m-top-xs">Mixed System</h3>
	    <span class="text-muted">1 Soi Inthamara 41, Dindeang, Dindeang, Bangkok 10400 </span></div>
	</div>
	<div class="pull-right">
      	<h4>{{ trans('receive.label.name') }}</h4>
	  	<h5><strong>{{ $receive->document_no }}</strong></h5>
		<strong>{{ $receive->created_at->format('jS M Y') }}</strong>
  	</div>
</div>

<hr>
				
<div class="clearfix">
	<div class="pull-left"> 
		<h4>Information</h4> 
		<address> 
			<strong>{{ trans('receive.attributes.project_id') }} : </strong>{{ $receive->project_code }}<br>
			<strong>{{ trans('receive.attributes.po_no') }} : </strong>{{ $receive->po_no }}<br>
			<strong>{{ trans('receive.attributes.ref_no') }} : </strong>{{ $receive->ref_no }}<br>
		</address> 
	</div>
	<div class="pull-right text-right">
		<h4>{{ trans('receive.attributes.create_by') }}</h4> 
		<address>
			<strong>{{ trans('main.app_name') }}</strong>
			<br>
			{{ $receive->user->name }}
        </address> 
	</div>
</div>