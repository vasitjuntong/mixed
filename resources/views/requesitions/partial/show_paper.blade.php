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
	  <h5><strong>{{ $requesition->document_no }}</strong></h5>
		<strong>{{ $requesition->created_at->format('jS M Y') }}</strong>
  </div>
</div>

<hr>

<div class="clearfix">
	<div class="pull-left"> 
		<h4>Information</h4> 
		<address> 
			<strong>Project : </strong>{{ $requesition->project_code }}<br> 
			<span style="font-weight: 700">Site ID : </span>{{ $requesition->site_id }}<br>
			<span style="font-weight: 700">Site Name : </span>{{ $requesition->site_name }}<br>
			<strong>Requested Date : </strong>{{ $requesition->created_at->format('jS M Y') }}
		</address> 
	</div>
	<div class="pull-right text-right">
		<h4>Receive By</h4> 
		<address>
			<strong>{{ $requesition->receive_company_name }}</strong><br> 
			{{ $requesition->receive_contact_name }}<br> 
			{{ $requesition->receive_phone }}<br>
			Receve Date : {{ $requesition->receive_date->format('jS M Y') }}
        </address> 
	</div>
</div>