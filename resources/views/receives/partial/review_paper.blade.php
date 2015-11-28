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
      	<h4>REQUISITION</h4>
	  	<h5><strong>IS5810-001</strong></h5>
		<strong>28th Oct 2015</strong>
  	</div>
</div>

<hr>
				
<div class="clearfix">
	<div class="pull-left"> 
		<h4>Information</h4> 
		<address> 
			<strong>{{ trans('receive.attributes.project_id') }} : </strong>{{ $receive->project_code }}<br>
			<strong>{{ trans('receive.attributes.document_no') }} : </strong>{{ $receive->document_no }}<br>
			<strong>{{ trans('receive.attributes.po_no') }} : </strong>{{ $receive->po_no }}<br>
			<strong>{{ trans('receive.attributes.ref_no') }} : </strong>{{ $receive->ref_no }}<br>
			<strong>{{ trans('receive.attributes.created_at') }} : </strong> {{ $receive->created_at->format('d M Y') }}
		</address> 
	</div>
	<div class="pull-right text-right">
		<h4>Receive By</h4> 
		<address>
			<strong>Mixed</strong>
			<br> 
			K. Suravee Viboonrid<br> 
			081-348-1889<br>
			Receve Date : 29 Oct 2015
        </address> 
	</div>
</div>